<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Author::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = User::doesntHave('author')
            ->doesntHave('applicant')
            ->inRandomOrder()->first()->id;

        $alias = $this->faker->unique()->word();

        return [
            'alias' => $alias,
            'slug' => str($alias)->slug(),
            'biography' => $this->faker->sentence(),
            'profile_photo_path' => $this->faker->imageUrl(200, 200, 'people', true),
            'user_id' => $user_id,
        ];
    }
}
