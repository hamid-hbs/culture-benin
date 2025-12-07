<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Langue;



class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $search = request('search');        
        $query = User::with(['role', 'langue']);
        if ($search) {
            $query->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }
        $users = $query->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles =Role::all();
        $langues =Langue::all();
        $sexe=['M','F'];
        $statut = ['Actif', 'Inactif'];

        return view('users.create', compact('roles', 'langues', 'sexe', 'statut'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([         
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mot_de_passe' => 'required|string|min:8|confirmed',
            'sexe' => 'nullable|in:M,F',
            'date_naissance' => 'nullable|date',
            'statut' =>'nullable|in:Actif,Inactif',
            'photo' => 'nullable|image|max:2048',
            'id_role' => 'nullable|exists:roles,id',
            'id_langue' => 'nullable|exists:langues,id',                        
        ]);

        // handle photo upload
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $validatedData['photo'] = $path;
        }

        // hash the password (mot_de_passe) and map to the standard password column
        $hashed = bcrypt($validatedData['mot_de_passe']);
        $userData = [
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'email' => $validatedData['email'],
            'mot_de_passe' => $hashed,
            'sexe' => $validatedData['sexe'] ?? null,
            'date_naissance' => $validatedData['date_naissance'] ?? null,
            'date_inscription' => now(),
            'photo' => $validatedData['photo'] ?? null,
            'id_langue' => $validatedData['id_langue'] ?? null,
        ];

        $user = User::create($userData);

        return redirect()->route('users.show', $user->id)->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = User::with(['role', 'langue'])->findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::with(['role', 'langue'])->findOrFail($id);
        $roles = Role::all();
        $langues = Langue::all();
        return view('users.edit', compact('user', 'roles', 'langues'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = User::findOrFail($id);
        $validatedData = $request->validate([         
            'nom' => 'nullable|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,'.$user->id,
            'mot_de_passe' => 'nullable|string|min:8|confirmed',
            'sexe' => 'nullable|in:M,F',
            'date_naissance' => 'nullable|date',
            'photo' => 'nullable|image|max:2048',
            'statut' => 'nullable||in:Actif,Inactif', 
            'id_role' => 'nullable|exists:roles,id', 
            'id_langue' => 'nullable|exists:langues,id',                        
        ]);
        // handle photo upload
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $validatedData['photo'] = $path;
        }
        // hash the password (mot_de_passe) if provided
        if (!empty($validatedData['mot_de_passe'])) {
            $validatedData['password'] = bcrypt($validatedData['mot_de_passe']);
        } else {
            unset($validatedData['mot_de_passe']);
        }

        $user->update($validatedData);

        return redirect()->route('users.show', $user->id)->with('success', 'Utilisateur mis à jour avec succès.');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
