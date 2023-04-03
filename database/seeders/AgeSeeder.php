<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ages')->insert([
            'year' => '0',
            'description' => 'Suitable for all age groups.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('ages')->insert([
            'year' => '6',
            'description' => "The works do not contain images that can scare young children.A very slight form of violence (in a comic context or in a children's environment) is acceptable.Do not read a foul language.",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('ages')->insert([
            'year' => '9',
            'description' => 'Its content can frighten younger children.The very soft forms of violence (implicit violence, not detailed or not realistic) are acceptable.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('ages')->insert([
            'year' => '12',
            'description' => 'The works show violence of a slightly more graphic nature towards fantasy characters or non -realistic violence towards human characters.There may be sexual insinuations or sexual postures, while any foul language is mild.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('ages')->insert([
            'year' => '16',
            'description' => 'The description of violence (or sexual activity) reaches a level similar to the one that would be expected in real life.Incorrect language use can be more extreme, while gambling and the use of tobacco, alcohol or illegal drugs may also be present.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('ages')->insert([
            'year' => '18',
            'description' => 'Recommended works for over 18 years.Violence reaches such a level that becomes a representation of brutal violence, murder for no apparent reason or violence towards defenseless characters.The use of illegal drugs and explicit sexual activity are also included.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
