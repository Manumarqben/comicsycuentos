<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenaltySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('penalties')->insert([
            'name' => 'leer',
            'description' => 'No puede acceder a leer las obras',
        ]);
        DB::table('penalties')->insert([
            'name' => 'publicar',
            'description' => 'No puede publicar',
        ]);
    }
}
