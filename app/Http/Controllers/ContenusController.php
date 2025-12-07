<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\TypeContenu;
use App\Models\Langue;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Commentaire;

class ContenusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $search = request('search');
        $query = Contenu::query();

        if ($search) {
            $query->where('titre', 'like', "%{$search}%")
                  ->orWhere('texte', 'like', "%{$search}%");
        }

        $contenus = $query->paginate(10);
        return view('contenus.index', compact('contenus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $auteurs = User::where('id_role', 1)->get(); 
        $moderateurs = User::where('id_role', 2)->get();
        $typecontenus = TypeContenu::all();
        $langues = Langue::all();
        $regions = Region::all();
        $contenusParents = Contenu::all();

        return view('contenus.create',(compact('auteurs',
        'moderateurs',
        'typecontenus',
        'langues',
        'regions',
        'contenusParents')));
        

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => 'required|string',
            'date_creation' => 'required|date',
            'statut' => 'required|string|max:50',
            'parent_id' => 'nullable|integer|exists:contenus,id',
            'date_validation' => 'nullable|date',
            'id_region' => 'required|integer|exists:regions,id',
            'id_langue' => 'required|integer|exists:langues,id',
            'id_moderateur' => 'nullable|integer|exists:users,id',
            'id_type_contenu' => 'required|integer|exists:type_contenus,id',
            'id_auteur' => 'required|integer|exists:users,id',
        ]);
        Contenu::create($validatedData);
        return redirect()->route('contenus.index')->with('success', 'Contenu created successfully.');   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $contenu = Contenu::findOrFail($id);
        return view('contenus.show', compact('contenu'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $auteurs = User::where('id_role', 1)->get(); 
        $moderateurs = User::where('id_role', 2)->get();
        $typecontenus = TypeContenu::all();
        $langues = Langue::all();
        $regions = Region::all();
        $contenusParents = Contenu::all();

        $contenu = Contenu::findOrFail($id);
        return view('contenus.edit', compact('contenu', 'auteurs', 'moderateurs', 'typecontenus', 'langues', 'regions', 'contenusParents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => 'required|string',
            'date_creation' => 'required|date',
            'statut' => 'required|string|max:50',
            'parent_id' => 'nullable|integer|exists:contenus,id',
            'date_validation' => 'nullable|date',
            'id_region' => 'required|integer|exists:regions,id',
            'id_langue' => 'required|integer|exists:langues,id',
            'id_moderateur' => 'nullable|integer|exists:users,id',
            'id_type_contenu' => 'required|integer|exists:type_contenus,id',
            'id_auteur' => 'required|integer|exists:users,id',
        ]);
        $contenu = Contenu::findOrFail($id);
        $contenu->update($validatedData);
        return redirect()->route('contenus.index')->with('success', 'Contenu updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $contenu = Contenu::findOrFail($id);
        $contenu->delete();
        return redirect()->route('contenus.index')->with('success', 'Contenu deleted successfully.');
    }


    /**
     * Get contents for home page with modal details
     */
    public function accueil()
    {
        // Récupérer les contenus avec leur UNIQUE média et le type de média
        $contenus = Contenu::with(['typecontenu', 'region', 'auteur', 'media.typemedia'])
            ->whereIn('statut', ['validé', 'Validé', 'VALIDE', 'approuvé', 'publié'])
            ->orderBy('date_creation', 'desc')
            ->take(8)
            ->get();
        
        // Si toujours vide, enlever la condition de statut temporairement
        if ($contenus->isEmpty()) {
            $contenus = Contenu::with(['typecontenu', 'region', 'auteur', 'media.typemedia'])
                ->orderBy('date_creation', 'desc')
                ->take(8)
                ->get();
        }
        
        return view('front.accueil', compact('contenus'));
    }

    /**
     * Get content details for content
     */
    public function details(string $id)
    {
        $contenu = Contenu::with(['auteur', 'moderateur', 'typecontenu', 'langue', 'region', 'parent', 'media.typemedia'])->findOrFail($id);
        
        // Vérifier si l'utilisateur est authentifié
        $user = auth()->user();
        $hasPaid = false;
        $paymentRequired = true;

        if ($user) {
            // Vérifier si l'utilisateur a déjà payé pour ce contenu
            $hasPaid = \App\Models\Payment::where('user_id', $user->id)
                ->where('contenu_id', $contenu->id)
                ->where('status', 'approved')
                ->exists();
        }

        // Si l'utilisateur n'a pas payé, on affiche seulement un aperçu
        if (!$hasPaid && $paymentRequired) {
            // Préparer les informations de base pour l'aperçu
            $mediaInfo = null;
            if ($contenu->media) {
                $mediaInfo = [
                    'chemin' => asset('storage/' . $contenu->media->chemin),
                    'description' => $contenu->media->description,
                    'type_media' => $contenu->media->typemedia->nom ?? 'Inconnu',
                    'is_video' => $contenu->hasVideo(),
                    'is_image' => $contenu->hasImage()
                ];
            }

            $commentaires = Commentaire::with('user')
                ->where('id_contenu', $id)
                ->orderBy('created_at', 'desc')
                ->paginate(5);
            
            return view('front.contenusdetails', compact('contenu', 'mediaInfo', 'commentaires', 'hasPaid'));
        }
        
        // Si l'utilisateur a payé, afficher le contenu complet
        // Préparer l'information du média (UN SEUL média)
        $mediaInfo = null;
        if ($contenu->media) {
            $mediaInfo = [
                'chemin' => asset('storage/' . $contenu->media->chemin),
                'description' => $contenu->media->description,
                'type_media' => $contenu->media->typemedia->nom ?? 'Inconnu',
                'is_video' => $contenu->hasVideo(),
                'is_image' => $contenu->hasImage()
            ];
        }

        $commentaires = Commentaire::with('user')
        ->where('id_contenu', $id)
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        
        return view('front.contenusdetails', compact('contenu', 'mediaInfo', 'commentaires', 'hasPaid'));
    }


    public function tous()
{
    $search = request('search');
    $query = Contenu::with(['typecontenu', 'region', 'auteur', 'media.typemedia']);

    if ($search) {
        $query->where('titre', 'like', "%{$search}%")
              ->orWhere('texte', 'like', "%{$search}%");
    }

    $contenus = $query->paginate(10);
    return view('front.contenustous', compact('contenus'));
}
    
}


