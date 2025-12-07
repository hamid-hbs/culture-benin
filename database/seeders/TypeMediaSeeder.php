<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeMediaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('type_medias')->insert([
            ['nom' => 'Image', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Vidéo', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Audio', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Document PDF', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
