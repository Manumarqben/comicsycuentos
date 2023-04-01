<?php

namespace Database\Seeders;

use App\Models\Author;
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
            'profile_photo_path' => 'https://upload.wikimedia.org/wikipedia/commons/0/09/Cervantes_J%C3%A1uregui.jpg',
            'user_id' => User::where('email', 'author@gmail.com')->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Author::factory(3)->create();
    }
}
