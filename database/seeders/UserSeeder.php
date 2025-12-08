<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Premier utilisateur
        User::create([
            'nom' => 'COMLAN',
            'prenom' => 'Maurice',
            'email' => 'maurice.comlan@uac.bj',
            'mot_de_passe' => bcrypt('Eneam123'),
            'id_role' => 4, // admin
            'statut' => 'Actif',
        ]);

        // Deuxième utilisateur
        User::create([
            'nom' => 'BAWA SACCA',
            'prenom' => 'Hamid',
            'email' => 'hamidbawasacca@gmail.com',
            'mot_de_passe' => bcrypt('11111111'),
            'id_role' => 4, //admin
            'statut' => 'Actif',
        ]);
    }
}
