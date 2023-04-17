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
        Author::factory()->create([
            'alias' => 'Author',
            'slug' => str('Author')->slug(),
            'user_id' => User::where('email', 'author@gmail.com')->first()->id,
        ]);

        Author::factory(3)->create();
    }
}
