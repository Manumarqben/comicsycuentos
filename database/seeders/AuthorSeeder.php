<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('authors')->insert([
            'alias' => 'Author',
            'slug' => str('Author')->slug(),
            'biography' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum maiores at quo porro, animi et! Reprehenderit quisquam dolor, ab exercitationem fugit saepe vel asperiores odio natus corrupti unde accusantium consectetur!',
            'profile_photo_path' => 'https://mdbootstrap.com/img/new/standard/nature/184.jpg',
            'user_id' => User::where('name', 'author@gmail.com')->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
