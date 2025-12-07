<?php

namespace App\Http\Controllers;
use App\Models\TypeContenu;

use Illuminate\Http\Request;


class TypeContenusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $search = request('search');
        $query = TypeContenu::query();

        if ($search) {
            $query->where('nom', 'like', "%{$search}%");
        }

        $typecontenus = $query->paginate(10);
        return view('typecontenus.index', compact('typecontenus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('typecontenus.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);
        TypeContenu::create($request->all());
        return redirect()->route('typecontenus.index')
                         ->with('success', 'Type de contenu créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $typecontenu = TypeContenu::findOrFail($id);
        return view('typecontenus.show', compact('typecontenu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $typecontenu = TypeContenu::findOrFail($id);
        return view('typecontenus.edit', compact('typecontenu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $typecontenu = TypeContenu::findOrFail($id);
        $typecontenu->update($request->all());

        return redirect()->route('typecontenus.index')
                         ->with('success', 'Type de contenu mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $typecontenu = TypeContenu::findOrFail($id);
        $typecontenu->delete();
    }
}
