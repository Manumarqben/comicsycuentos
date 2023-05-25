<?php

namespace Database\Seeders;

use App\Models\Age;
use App\Models\AgeRange;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgeRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AgeRange::create([
            'name' => 'Infantil',
            'slug' => str('Infantil')->slug(),
            'age_min' => Age::where('year', 0)->first()->id,
            'age_max' => Age::where('year', 6)->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        AgeRange::create([
            'name' => 'Juvenil',
            'slug' => str('Juvenil')->slug(),
            'age_min' => Age::where('year', 9)->first()->id,
            'age_max' => Age::where('year', 16)->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        AgeRange::create([
            'name' => 'Adulto',
            'slug' => str('Adulto')->slug(),
            'age_min' => Age::where('year', 18)->first()->id,
            'age_max' => Age::where('year', 18)->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
