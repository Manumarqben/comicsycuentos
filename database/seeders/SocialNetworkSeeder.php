<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialNetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('social_networks')->insert(
            ['name' => 'twitter',] 
        );
        DB::table('social_networks')->insert(
            ['name' => 'facebook',] 
        );
    }
}
