<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;
use App\Models\Contenu;


// Charger FedaPay manuellement car l'autoloader PSR-4 ne le charge pas automatiquement
if (!class_exists(\FedaPay\FedaPay::class)) {
    require_once base_path('vendor/fedapay/fedapay-php/init.php');
}

class PaymentController extends Controller
{
    /**
     * Initialiser le paiement pour un contenu
     */
    public function initiate(Request $request, $contenuId)
    {
        // Vérifier que l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à ce contenu.');
        }

        $user = Auth::user();
        $contenu = Contenu::findOrFail($contenuId);

        // Vérifier si l'utilisateur a déjà payé pour ce contenu
        $existingPayment = Payment::where('user_id', $user->id)
            ->where('contenu_id', $contenu->id)
            ->where('status', 'approved')
            ->first();

        if ($existingPayment) {
            return redirect()->route('contenusdetails', $contenu->id)
                ->with('success', 'Vous avez déjà accès à ce contenu.');
        }

        // Configurer FedaPay
        \FedaPay\FedaPay::setApiKey(config('services.fedapay.api_key'));
        \FedaPay\FedaPay::setEnvironment(config('services.fedapay.environment'));

        try {
            // Récupérer ou créer le client FedaPay
            $customer = $this->getOrCreateCustomer($user);

            // Créer la transaction FedaPay
            $transaction = \FedaPay\Transaction::create([
                'description' => 'Paiement pour: ' . $contenu->titre,
                'amount' => 100,
                'currency' => [
                    'iso' => 'XOF'
                ],
                'callback_url' => route('payment.callback'),
                'customer' => [
                    'id' => $customer->id
                ]
            ]);

            // Enregistrer le paiement dans la base de données
            $payment = Payment::create([
                'user_id' => $user->id,
                'contenu_id' => $contenu->id,
                'transaction_id' => $transaction->id,
                'feda_customer_id' => $customer->id,
                'amount' => 100,
                'currency' => 'XOF',
                'status' => 'pending',
                'description' => 'Paiement pour: ' . $contenu->titre,
            ]);

            // Générer le token et récupérer l'URL de paiement
            $token = $transaction->generateToken();

            Log::info('Paiement FedaPay initié', [
                'payment_id' => $payment->id,
                'transaction_id' => $transaction->id,
                'user_id' => $user->id,
                'contenu_id' => $contenu->id,
                'payment_url' => $token->url
            ]);

            // Rediriger vers la page de paiement FedaPay
            return redirect($token->url);

        } catch (\Exception $e) {
            // Logger toutes les erreurs mais continuer vers FedaPay quand même
            Log::error('Erreur lors de l\'initiation du paiement', [
                'error_type' => get_class($e),
                'error_message' => $e->getMessage(),
                'contenu_id' => $contenuId,
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);

            // Tenter de créer une transaction sans customer_id si c'est l'erreur
            try {
                $transaction = \FedaPay\Transaction::create([
                    'description' => 'Paiement pour: ' . $contenu->titre,
                    'amount' => 100,
                    'currency' => [
                        'iso' => 'XOF'
                    ],
                    'callback_url' => route('payment.callback'),
                ]);

                // Enregistrer le paiement sans customer_id
                $payment = Payment::create([
                    'user_id' => $user->id,
                    'contenu_id' => $contenu->id,
                    'transaction_id' => $transaction->id,
                    'amount' => 100,
                    'currency' => 'XOF',
                    'status' => 'pending',
                    'description' => 'Paiement pour: ' . $contenu->titre . ' (sans profil client)',
                ]);

                $token = $transaction->generateToken();

                Log::info('Paiement FedaPay initié sans customer_id', [
                    'payment_id' => $payment->id,
                    'transaction_id' => $transaction->id,
                    'user_id' => $user->id,
                    'payment_url' => $token->url
                ]);

                return redirect($token->url);

            } catch (\Exception $fallbackError) {
                Log::error('Erreur finale - impossible de créer la transaction', [
                    'error' => $fallbackError->getMessage(),
                    'user_id' => $user->id,
                    'contenu_id' => $contenu->id
                ]);

                // Enregistrer l'échec
                Payment::create([
                    'user_id' => $user->id,
                    'contenu_id' => $contenu->id,
                    'amount' => 100,
                    'currency' => 'XOF',
                    'status' => 'failed',
                    'description' => 'Erreur système: ' . $fallbackError->getMessage(),
                ]);

                return redirect()->back()->with('error', 'Impossible d\'initialiser le paiement. Veuillez réessayer ou contacter le support.');
            }
        }
    }

    /**
     * Gérer le callback après le paiement
     */
    public function callback(Request $request)
    {
        // Configurer FedaPay
        \FedaPay\FedaPay::setApiKey(config('services.fedapay.api_key'));
        \FedaPay\FedaPay::setEnvironment(config('services.fedapay.environment'));

        // Récupérer l'ID de transaction depuis la requête
        $transactionId = $request->query('id');

        if (!$transactionId) {
            Log::warning('Callback FedaPay sans ID de transaction', [
                'request' => $request->all()
            ]);
            return redirect()->route('contenustous')->with('error', 'Transaction invalide.');
        }

        try {
            // Récupérer la transaction depuis FedaPay
            $transaction = \FedaPay\Transaction::retrieve($transactionId);

            // Récupérer le paiement correspondant dans la base de données
            $payment = Payment::where('transaction_id', $transactionId)->first();

            if (!$payment) {
                Log::error('Paiement introuvable pour la transaction', [
                    'transaction_id' => $transactionId
                ]);
                return redirect()->route('contenustous')->with('error', 'Paiement introuvable.');
            }

            // Vérifier le statut de la transaction
            if ($transaction->status === 'approved') {
                $payment->status = 'approved';
                $payment->payment_method = $transaction->mode ?? null;
                $payment->paid_at = now();
                $payment->save();

                Log::info('Paiement approuvé', [
                    'payment_id' => $payment->id,
                    'transaction_id' => $transactionId,
                    'user_id' => $payment->user_id
                ]);

                return redirect()->route('contenusdetails', $payment->contenu_id)
                    ->with('success', 'Paiement effectué avec succès ! Vous avez maintenant accès au contenu.');
            } elseif ($transaction->status === 'cancelled') {
                $payment->status = 'cancelled';
                $payment->save();

                Log::info('Paiement annulé', [
                    'payment_id' => $payment->id,
                    'transaction_id' => $transactionId
                ]);

                return redirect()->route('contenusdetails', $payment->contenu_id)
                    ->with('warning', 'Le paiement a été annulé.');
            } else {
                // Statut pending ou declined
                $payment->status = $transaction->status === 'declined' ? 'failed' : 'pending';
                $payment->save();

                Log::info('Statut de paiement mis à jour', [
                    'payment_id' => $payment->id,
                    'transaction_id' => $transactionId,
                    'status' => $payment->status
                ]);

                return redirect()->route('contenusdetails', $payment->contenu_id)
                    ->with('error', 'Le paiement n\'a pas abouti. Statut: ' . $transaction->status);
            }

        } catch (\FedaPay\Error\Base $e) {
            Log::error('Erreur FedaPay lors du callback', [
                'error' => $e->getMessage(),
                'transaction_id' => $transactionId
            ]);

            return redirect()->route('contenustous')->with('error', 'Erreur lors de la vérification du paiement.');

        } catch (\Exception $e) {
            Log::error('Erreur générique lors du callback', [
                'error' => $e->getMessage(),
                'transaction_id' => $transactionId
            ]);

            return redirect()->route('contenustous')->with('error', 'Une erreur est survenue.');
        }
    }

    /**
     * Récupérer ou créer un client FedaPay
     */
    private function getOrCreateCustomer($user)
    {
        // Vérifier si l'utilisateur a déjà un customer_id
        $existingPayment = Payment::where('user_id', $user->id)
            ->whereNotNull('feda_customer_id')
            ->first();

        if ($existingPayment && $existingPayment->feda_customer_id) {
            try {
                return \FedaPay\Customer::retrieve($existingPayment->feda_customer_id);
            } catch (\Exception $e) {
                Log::warning('FedaPay: Impossible de récupérer le client existant', [
                    'customer_id' => $existingPayment->feda_customer_id,
                    'error' => $e->getMessage()
                ]);
                // On ignore et on va essayer de créer un nouveau client FedaPay
            }
        }

        // Création du client FedaPay
        $customer = \FedaPay\Customer::create([
            'firstname' => $user->prenom ?? $user->name ?? 'Client',
            'lastname' => $user->nom ?? '',
            'email' => $user->email,
            'phone' => $user->phone, // doit être au format +229xxxxxxxxxx pour le Bénin
        ]);

        Log::info('Client FedaPay créé', [
            'customer_id' => $customer->id,
            'user_id' => $user->id
        ]);

        return $customer;
    }
}



