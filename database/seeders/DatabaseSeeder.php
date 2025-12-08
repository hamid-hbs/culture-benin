<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
        ]);
        $this->call([
            LangueSeeder::class,
        ]);
        $this->call([
            TypeContenuSeeder::class,
        ]);
        $this->call([
            TypeMediaSeeder::class,
        ]);
        $this->call([
            RegionSeeder::class,
        ]);
        $this->call([
            UserSeeder::class,
        ]);
    }
}
