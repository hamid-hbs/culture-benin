<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('regions')->insert([
            [
                'nom' => 'Alibori',
                'description' => 'Département situé au nord-est du Bénin, frontalier du Niger.',
                'population' => 868000,
                'superficie' => 26242,
                'localisation' => 'Nord-Est',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Atacora',
                'description' => 'Zone montagneuse abritant les monts de l’Atacora.',
                'population' => 772000,
                'superficie' => 20199,
                'localisation' => 'Nord-Ouest',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Atlantique',
                'description' => 'Département côtier incluant Ouidah et Abomey-Calavi.',
                'population' => 1734000,
                'superficie' => 3233,
                'localisation' => 'Sud',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Borgou',
                'description' => 'Département central comprenant la ville de Parakou.',
                'population' => 1385000,
                'superficie' => 25956,
                'localisation' => 'Centre-Nord',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Collines',
                'description' => 'Département central avec des reliefs variés.',
                'population' => 930000,
                'superficie' => 13431,
                'localisation' => 'Centre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Couffo',
                'description' => 'Département agricole du sud-ouest.',
                'population' => 745000,
                'superficie' => 2404,
                'localisation' => 'Sud-Ouest',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Donga',
                'description' => 'Département situé dans la zone soudano-guinéenne.',
                'population' => 700000,
                'superficie' => 11395,
                'localisation' => 'Nord-Ouest',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Littoral',
                'description' => 'Département le plus petit abritant la ville de Cotonou.',
                'population' => 700000,
                'superficie' => 79,
                'localisation' => 'Sud',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Mono',
                'description' => 'Département côtier du sud-ouest.',
                'population' => 497000,
                'superficie' => 1605,
                'localisation' => 'Sud-Ouest',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Ouémé',
                'description' => 'Département abritant la ville de Porto-Novo.',
                'population' => 1117000,
                'superficie' => 1281,
                'localisation' => 'Sud-Est',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Plateau',
                'description' => 'Zone forestière située au sud-est.',
                'population' => 700000,
                'superficie' => 3264,
                'localisation' => 'Sud-Est',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Zou',
                'description' => 'Département abritant Abomey, ancienne capitale du Dahomey.',
                'population' => 1000000,
                'superficie' => 5165,
                'localisation' => 'Centre-Sud',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

