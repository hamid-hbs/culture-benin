<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\TypeMedia;;
use App\Models\Contenu;
class MediasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $search = request('search');
        $query = Media::with(['typemedia', 'contenu']);

        if ($search) {
            $query->where('chemin', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $medias = $query->paginate(10);
        $typemedias = TypeMedia::all();
        $contenus = Contenu::all();
        return view('medias.index', compact('medias', 'typemedias', 'contenus')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $typemedias = TypeMedia::all();
        $contenus = Contenu::all();
        
        return view('medias.create', compact('typemedias', 'contenus'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //    
        $validatedData = $request->validate([
            'chemin' => 'required|file|mimes:jpg,jpeg,png,gif,webp,mp4,webm,mov,mp3,pdf,doc,docx,zip|max:10240',
            'description' => 'nullable|string',
            'id_type_media' => 'required|integer|exists:type_medias,id',
            'id_contenu' => 'required|integer|exists:contenus,id',
        ]);

        // stocke le fichier et remplace la valeur par le chemin (string)
        if ($request->hasFile('chemin')) {
            $path = $request->file('chemin')->store('medias', 'public');
            $validatedData['chemin'] = $path; // string saved in DB
        }

        Media::create($validatedData);
        return redirect()->route('medias.index')->with('success', 'Media created successfully.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $media = Media::with(['typemedia', 'contenu'])->findOrFail($id);
        return view('medias.show', compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $typemedias = TypeMedia::all();
        $contenus = Contenu::all();
        $media = Media::findOrFail($id);
        return view('medias.edit', compact('media', 'typemedias', 'contenus'));    

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'chemin' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,mp4,webm,mov,mp3,pdf,doc,docx,zip|max:10240',
            'description' => 'nullable|string',
            'id_type_media' => 'required|integer|exists:type_medias,id',
            'id_contenu' => 'required|integer|exists:contenus,id',
        ]);
        $media = Media::findOrFail($id);
        $media->update($validatedData);
        return redirect()->route('medias.index')->with('success', 'Media updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $media = Media::findOrFail($id);
        $media->delete();
        return redirect()->route('medias.index')->with('success', 'Media deleted successfully.');
    }
}
