<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SocialNetworkSeeder::class,
            TypeSeeder::class,
            GenreSeeder::class,
            AgeSeeder::class,
            StateSeeder::class,
            MarkerSeeder::class,
            PenaltySeeder::class,
        ]);
    }
}
