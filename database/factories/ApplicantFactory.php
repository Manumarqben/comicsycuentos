<?php

namespace Database\Factories;

use App\Models\Applicant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Applicant>
 */
class ApplicantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Applicant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = User::whereNotIn('id', function ($query) {
            $query->select('user_id')->from('applicants');
        })->whereNotIn('id', function ($query) {
            $query->select('user_id')->from('authors');
        })->inRandomOrder()->first()->id;

        $alias = $this->faker->unique()->word();

        return [
            'alias' => $alias,
            'slug' => str($alias)->slug(),
            'user_id' => $user_id,
        ];
    }
}
