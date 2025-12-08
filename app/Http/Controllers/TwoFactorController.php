<?php

namespace App\Http\Controllers;

use App\Notifications\TwoFactorCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class TwoFactorController extends Controller
{
    public function showVerifyForm()
    {
        if (!Auth::check() || !Auth::user()->two_factor_code) {
            return redirect()->route('login');
        }

        return view('auth.verify-2fa');
    }

    public function sendCode(Request $request)
    {
        $user = Auth::user();

        if (!$user->two_factor_code || now()->gt($user->two_factor_expires_at)) {
            // Générer un nouveau code si expiré ou inexistant
            $user->generateTwoFactorCode();
        }

        // Envoyer la notification
        $user->notify(new TwoFactorCodeNotification(
        $user->two_factor_code, 
        $user->two_factor_expires_at
        ));

        return back()->with('status', 'Un nouveau code de vérification a été envoyé à votre adresse email.');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'required|string|size:6',
        ]);

        $user = Auth::user();

        if (!$user->two_factor_code || !$user->two_factor_expires_at) {
            return redirect()->route('login')->withErrors([
                'two_factor_code' => 'Aucun code de vérification en attente.',
            ]);
        }

        if (now()->gt($user->two_factor_expires_at)) {
            $user->resetTwoFactorCode();
            Auth::logout();

            return redirect()->route('login')->withErrors([
                'two_factor_code' => 'Le code de vérification a expiré. Veuillez vous reconnecter.',
            ]);
        }

        if ($request->two_factor_code !== $user->two_factor_code) {
            return redirect()->back()->withErrors([
                'two_factor_code' => 'Le code de vérification est incorrect.',
            ]);
        }

        $user->resetTwoFactorCode();

        // Marquer l'utilisateur comme 2FA validé
        Session::put('user_2fa', Auth::id());

        
    }
}
