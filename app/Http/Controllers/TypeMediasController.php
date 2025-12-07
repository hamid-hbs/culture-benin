<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeMedia;

class TypeMediasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $search = request('search');
        $query = TypeMedia::query();
        if ($search) {
            $query->where('nom', 'like', "%{$search}%");
        }
        $typemedias = $query->paginate(10);
        return view('typemedias.index', compact('typemedias'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('typemedias.create');
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
        TypeMedia::create($request->all());
        return redirect()->route('typemedias.index')
                         ->with('success', 'Type de media créé avec succès.');  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $typemedia = TypeMedia::findOrFail($id);
        return view('typemedias.show', compact('typemedia'));   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $typemedia = TypeMedia::findOrFail($id);
        return view('typemedias.edit', compact('typemedia'));
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
        $typemedia = TypeMedia::findOrFail($id);
        $typemedia->update($request->all());
        return redirect()->route('typemedias.index')
                         ->with('success', 'Type de media mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $typemedia = TypeMedia::findOrFail($id);
        $typemedia->delete();
        return redirect()->route('typemedias.index')
                         ->with('success', 'Type de media supprimé avec succès.');
    }
}
