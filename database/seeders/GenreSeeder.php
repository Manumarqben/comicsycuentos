<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            'name' => 'acción', 
            'description' => 'Prevalecen altas dosis de adrenalina con una buena carga de movimiento, fugas, acrobacias, peleas, guerras, persecuciones y una lucha contra las dificultades que se presentan.',
        ]);
        DB::table('genres')->insert([
            'name' => 'romance', 
            'description' => 'Centradas en las aventuras o desventuras amorosas, pasionales o eróticas de los personajes.',
        ]);
        DB::table('genres')->insert([
            'name' => 'terror', 
            'description' => 'Contienen anécdotas aterradoras, siniestras o misteriosas, en las que suelen aparecer escenas grotescas, monstruos y entidades sobrenaturales.',
        ]);
    }
}
