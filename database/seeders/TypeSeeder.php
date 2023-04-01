<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types')->insert([
            'name' => 'Comic',
            'slug' => str('Comic')->slug(),
            'description' => 'Tell the story using a sequence of vignettes.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('types')->insert([
            'name' => 'Tale',
            'slug' => str('Tale')->slug(),
            'description' => 'Brief narration that tells the development and the end of a story, with the intervention of few characters, usually have a childish tone.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
