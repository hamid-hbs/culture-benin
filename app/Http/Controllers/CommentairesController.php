<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Commentaire;
use App\Models\Contenu;
use App\Models\User;


class CommentairesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Commentaire::query();

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('texte', 'like', "%{$search}%")
                  ->orWhere('note', 'like', "%{$search}%")
                  ->orWhere('date', 'like', "%{$search}%")
                  ->orWhere('id_user', 'like', "%{$search}%")
                  ->orWhere('id_contenu', 'like', "%{$search}%");
            });
        }

        $commentaires = $query->paginate(15);

        return view('commentaires.index', compact('commentaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contenus = Contenu::orderBy('titre')->get();
        $users = User::orderBy('nom')->orderBy('prenom')->get();
        return view('commentaires.create', compact('contenus', 'users'));
    }

    /**
     * Store a newly created resource in storage (pour admins ou création manuelle).
     */
    public function store(Request $request)
    {
        // Vérifier si l'utilisateur est admin
        $isAdmin = Auth::check() && (Auth::user()->role === 'admin'
    ); // Adapte selon ton modèle User (ex. champ 'role' ou méthode isAdmin())

        if ($isAdmin) {
            // Mode admin : validation complète avec champs manuels (auteur, etc.)
            $data = $request->validate([
                'auteur_nom'    => 'nullable|string|max:100',
                'auteur_prenom' => 'nullable|string|max:100',
                'auteur_email'  => 'nullable|email|max:191',
                'texte'         => 'required|string|max:2000', // Augmenté pour commentaires longs
                'statut'        => 'nullable|string|max:50|in:pending,approved,rejected',
                'id_contenu'    => 'nullable|exists:contenus,id',
                'id_media'      => 'nullable|exists:medias,id',
                'id_user'       => 'nullable|exists:users,id',
                'note'          => 'nullable|integer|min:0|max:5', // Harmonisé à 1-5 pour cohérence avec le formulaire
                'date'          => 'nullable|date',
            ]);

            $data['ip'] = $request->ip();
            $data['statut'] = $data['statut'] ?? 'pending'; // Par défaut en attente pour modération

            Commentaire::create($data);

            return redirect()->route('commentaires.index')->with('success', 'Commentaire créé.');
        } else {
            // Rediriger ou erreur si non-admin essaie d'accéder à cette route admin
            abort(403, 'Accès refusé. Cette fonctionnalité est réservée aux administrateurs.');
        }
    }

    /**
     * Store a user comment (nouvelle fonction pour les utilisateurs non-admin, via formulaire frontend).
     * Route à pointer : ex. Route::post('/commentaires/user-store', [CommentairesController::class, 'userStore'])->name('commentaires.userStore');
     */
    public function userStore(Request $request)
    {
        // Vérifier que l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour ajouter un commentaire.');
        }

        $user = Auth::user();

        // Validation simplifiée pour tous les utilisateurs
        $data = $request->validate([
            'texte'         => 'required|string|max:2000|min:5',
            'note'          => 'nullable|integer|min:1|max:5',
            'id_contenu'    => 'required|exists:contenus,id',
        ], [
            'texte.required' => 'Le commentaire est obligatoire.',
            'texte.min' => 'Le commentaire doit avoir au moins 5 caractères.',
            'id_contenu.required' => 'Le contenu est obligatoire.',
            'id_contenu.exists' => 'Ce contenu n\'existe pas.',
        ]);

        // Auto-remplir les champs
        $data['id_user'] = $user->id;
        $data['auteur_nom'] = $user->nom ?? 'Utilisateur';
        $data['auteur_prenom'] = $user->prenom ?? '';
        $data['auteur_email'] = $user->email ?? '';
        $data['statut'] = 'approved'; // Approuvé directement
        $data['ip'] = $request->ip();
        $data['date'] = now();

        try {
            // Créer le commentaire
            $commentaire = Commentaire::create($data);
            
            Log::info('Commentaire créé', ['id' => $commentaire->id, 'user_id' => $user->id]);

            return redirect()->back()->with('success', 'Votre commentaire a été ajouté avec succès!');
        } catch (\Exception $e) {
            Log::error('Erreur création commentaire', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout du commentaire.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $commentaire = Commentaire::with(['contenu', 'user'])->findOrFail($id);

        return view('commentaires.show', compact('commentaire'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users = User::orderBy('nom')->orderBy('prenom')->get();
        $commentaire = Commentaire::findOrFail($id);
        $contenus = Contenu::orderBy('titre')->get();
        return view('commentaires.edit', compact('commentaire', 'contenus', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $commentaire = Commentaire::findOrFail($id);

        // Vérifier autorisation (admin ou propriétaire)
        $isAuthorized = Auth::check();

        if (!$isAuthorized) {
            abort(403, 'Accès refusé.');
        }

        $data = $request->validate([
            'auteur_nom'    => 'nullable|string|max:100',
            'auteur_prenom' => 'nullable|string|max:100',
            'auteur_email'  => 'nullable|email|max:191',
            'texte'         => 'required|string|max:2000',
            'statut'        => 'nullable|string|max:50|in:pending,approved,rejected',
            'id_contenu'    => 'nullable|exists:contenus,id',
            'id_media'      => 'nullable|exists:medias,id',
            'id_user'       => 'nullable|exists:users,id',
            'note'          => 'nullable|integer|min:0|max:5', // Harmonisé
            'date'          => 'nullable|date',
        ]);

        $commentaire->update($data);

        return redirect()->route('commentaires.show', $commentaire->id)->with('success', 'Commentaire mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $commentaire = Commentaire::findOrFail($id);

        // Vérifier autorisation (admin ou propriétaire)
        $isAuthorized = Auth::check() && (Auth::user()->role === 'admin' || Auth::id() === $commentaire->id_user);

        if (!$isAuthorized) {
            abort(403, 'Accès refusé.');
        }

        $commentaire->delete();

        return redirect()->route('commentaires.index')->with('success', 'Commentaire supprimé.');
    }
}