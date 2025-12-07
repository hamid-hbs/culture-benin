<?php

namespace App\Http\Controllers;

use App\Models\Langue;
use Illuminate\Http\Request;
use Illuminate\View\View;


class LanguesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //affichage la liste des langues

        //$langues = Langue::all();
        
        $search = request('search');
        $query = Langue::query();

        if ($search) {
            $query->where('nom', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $langues = $query->paginate(10);
        return view('langues.index',compact('langues'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //afficher le formulaire permettant de créer une nouvelle langue
        return view('langues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //formulaire dans Action est traité par la méthode store
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:langues,code',
            'description' => 'nullable|string',
        ]);
        Langue::create($validated);
        return redirect()->route('langues.index')->with('success','Langue créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //afficher une langue donnée
        $langue = Langue::findOrFail($id);
        return view('langues.show',compact('langue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //afficher le formulaire permattant de modifier une langue
        $langue = Langue::findOrFail($id);
        return view('langues.edit',compact('langue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $langue = Langue::findOrFail($id);
        $validated = $request->validate([
            'code' => 'required|string|max:10',
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $langue->update($validated);
        return redirect()->route('langues.index')->with('success','Langue mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $langue = Langue::findOrFail($id);
        $langue->delete();
        return redirect()->route('langues.index')->with('success','Langue supprimée avec succès.');
    }
}
