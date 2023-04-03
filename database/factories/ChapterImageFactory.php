<?php

namespace Database\Factories;

use App\Models\Chapter;
use App\Models\ChapterImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChapterImage>
 */
class ChapterImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChapterImage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url' => $this->faker->imageUrl(480, 640, 'page', true),
            'order' => $this->faker->unique()->randomNumber(),
            'chapter_id' => Chapter::inRandomOrder()->first()->id,
        ];
    }
}
