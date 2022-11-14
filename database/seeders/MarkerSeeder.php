<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('markers')->insert([
            'name' => 'siguiendo',
            'description' => 'La obra comenzara a tener un seguimiento',
        ]);
        DB::table('markers')->insert([
            'name' => 'finalizado',
            'description' => 'Has acabado la obra',
        ]);
        DB::table('markers')->insert([
            'name' => 'pendiente',
            'description' => 'Piensas leer la obra en un futuro',
        ]);
    }
}
