<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeContenuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('type_contenus')->insert([
            ['nom' => 'Article', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Vidéo', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Podcast', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Infographie', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Livre', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
