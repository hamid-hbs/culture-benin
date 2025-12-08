<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

           User::create([
             'nom' => 'Maurice',
             'prenom' => 'Comlan',
             'sexe' => 'Masculin',
             'date_naissance' => '1990-01-01',
             'email' => 'maurice.comlan@uac.bj',
             'mot_de_passe' => Hash::make('Eneam123'),
             'email_verified_at' => now(),
             'id_role' => 4, 
             'id_langue' => 3,
             'created_at' => now(),
             'updated_at' => now(),
         ]);

        User::create([
            'nom' => 'BAWA SACCA',
            'prenom' => 'Hamid',
            'sexe' => 'M',
            'date_naissance' => '2006-01-10',
            'email' => 'hamidbawasacca@gmail.com',
            'mot_de_passe' => Hash::make('11111111'),
            'email_verified_at' => now(),
            'id_role' => 4, 
            'id_langue' =>3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
