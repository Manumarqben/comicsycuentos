<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            'name' => 'publicando',
        ]);
        DB::table('states')->insert([
            'name' => 'finalizado',
        ]);
        DB::table('states')->insert([
            'name' => 'pausa',
        ]);
        DB::table('states')->insert([
            'name' => 'abandonado',
        ]);
    }
}
