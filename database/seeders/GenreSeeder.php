<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genres')->insert([
            'name' => 'acción',
            'slug' => 'accion',
            'description' => 'High doses of adrenaline prevail with a good load of movement, leaks, acrobatics, fights, wars, persecutions and a fight against the difficulties that arise.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('genres')->insert([
            'name' => 'romance',
            'slug' => 'romance',
            'description' => 'Focused on love, passionate or erotic adventures or misadventures.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('genres')->insert([
            'name' => 'terror',
            'slug' => 'terror',
            'description' => 'They contain scary, sinister or mysterious anecdotes, in which grotesque scenes, monsters and supernatural entities usually appear.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
