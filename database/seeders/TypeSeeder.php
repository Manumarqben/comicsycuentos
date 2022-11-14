<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'name' => 'comic',
            'description' => 'Cuenta la historia usando una secuencia de viñetas.',
        ]);
        DB::table('types')->insert([
            'name' => 'cuento',
            'description' => 'Narración breve que cuenta el desarrollo y el final de una historia, con la intervención de pocos personajes, suelen tener un tono infantil.',
        ]);
    }
}
