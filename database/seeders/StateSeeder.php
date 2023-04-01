<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('states')->insert([
            'name' => 'Publishing',
            'slug' => str('Publishing')->slug(),
            'description' => 'The work is incomplete and the author is working on it',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('states')->insert([
            'name' => 'Finished',
            'slug' => str('Finished')->slug(),
            'description' => 'The work has reached the point where it is considered to be complete',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('states')->insert([
            'name' => 'Hiatus',
            'slug' => str('Hiatus')->slug(),
            'description' => 'The work has been temporarily interrupted by the author',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('states')->insert([
            'name' => 'Discontinued',
            'slug' => str('Discontinued')->slug(),
            'description' => 'The author has stopped working in the work completely and has no plans to continue his production in the future',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
