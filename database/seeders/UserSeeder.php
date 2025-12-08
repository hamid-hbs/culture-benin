<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nom'              => 'COMLAN',
            'prenom'           => 'Maurice',
            'email'            => 'maurice.comlan@uac.bj',
            'mot_de_passe'     => Hash::make('Eneam123'), // mot de passe
            'sexe'             => 'M',
            'statut'           => 'Actif',
            'id_role'          => 4, // ADMIN
        ]);

        User::create([
            'nom'              => 'BAWA SACCA',
            'prenom'           => 'Hamid',
            'email'            => 'hamidbawasacca@gmail.com',
            'mot_de_passe'     => Hash::make('11111111'),
            'sexe'             => 'M',
            'statut'           => 'Actif',
            'id_role'          => 4, // role par défaut
        ]);
    }
}
