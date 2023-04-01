<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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
            'name' => 'adulto',
            'birthdate' => date('01-01-1990'),
            'email' => 'adulto@gmail.com',
            'password' => Hash::make('adulto'),
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
            'name' => 'applicant',
            'email' => 'applicant@gmail.com',
            'password' => Hash::make('applicant'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'author',
            'email' => 'author@gmail.com',
            'password' => Hash::make('author'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::factory(20)->create();
    }
}
