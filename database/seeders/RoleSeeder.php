<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::create(['nom' => 'Auteur']);
        Role::create(['nom' => 'Modérateur']);
        Role::create(['nom' => 'Lecteur']);
        Role::create(['nom' => 'Administrateur']);
    }
}
