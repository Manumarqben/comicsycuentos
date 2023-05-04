<?php

namespace Database\Factories;

use App\Models\Chapter;
use App\Models\ChapterImage;
use App\Models\ChapterText;
use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chapter>
 */
class ChapterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chapter::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->unique()->randomNumber(),
            'title' => $this->faker->sentence(),
            'type' => $this->faker->randomElement(['text', 'image']),
            'work_id' => Work::inRandomOrder()->first()->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Chapter $chapter) {
            // Se asignan usuarios que han votado el capítulo
            $users = User::inRandomOrder()->take(rand(0, 5))->get();
            foreach ($users as $user) {
                $vote = rand(0, 1);
                $user->votedChapters()->attach([$chapter->id => ['like' => $vote]]);
            }
        })->afterCreating(function (Chapter $chapter) {
            if ($chapter->type == 'image') {
                $order = 1;
                ChapterImage::factory(rand(1, 5))->state(function () use (&$order) {
                    return [
                        'order' => $order++,
                    ];
                })->create([
                    'chapter_id' => $chapter->id,
                ]);
            } elseif ($chapter->type == 'text') {
                ChapterText::factory()->create([
                    'chapter_id' => $chapter->id,
                ]);
            }
        });
    }
}
