<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('applicants')->insert([
            'alias' => 'Applicant',
            'slug' => str('Applicant')->slug(),
            'user_id' => User::where('email', 'applicant@gmail.com')->first()->id,
            'created_at' => now(),
        ]);
    }
}
