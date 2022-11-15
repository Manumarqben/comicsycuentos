<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'birthdate' => date('01-01-1990'),
            'email' => 'admin@comicsycuentos.com',
            'password' => Hash::make('admin'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'menor',
            'birthdate' => date('01-01-2019'),
            'email' => 'menor@gmail.com',
            'password' => Hash::make('menor'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'sinfecha',
            'email' => 'sinfecha@gmail.com',
            'password' => Hash::make('sinfecha'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'adulto',
            'birthdate' => date('01-01-1990'),
            'email' => 'adulto@gmail.com',
            'password' => Hash::make('adulto'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
