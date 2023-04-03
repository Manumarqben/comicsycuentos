<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('markers')->insert([
            'name' => 'Following',
            'slug' => str('Following')->slug(),
            'description' => 'The work will begin to follow up',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('markers')->insert([
            'name' => 'Finished',
            'slug' => str('Finished')->slug(),
            'description' => 'You have finished the work',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('markers')->insert([
            'name' => 'Pending',
            'slug' => str('Pending')->slug(),
            'description' => 'You plan to read the work in the future',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
