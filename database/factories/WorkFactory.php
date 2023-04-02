<?php

namespace Database\Factories;

use App\Models\Age;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Marker;
use App\Models\State;
use App\Models\Type;
use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Work>
 */
class WorkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Work::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(3);

        return [
            'title' => $title,
            'slug' => str($title)->slug(),
            'synopsis' => $this->faker->paragraph(),
            'front_page' => $this->faker->imageUrl(480, 640, 'work', true),
            'age_id' =>  Age::all()->random()->id,
            'state_id' => State::all()->random()->id,
            'type_id' => Type::all()->random()->id,
            'author_id' => Author::all()->random()->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Work $work) {
            $genres = Genre::inRandomOrder()->take(rand(1, 3))->get();
            $work->genres()->attach($genres);
        })
        ->afterCreating(function (Work $work) {
            $users = User::inRandomOrder()->take(rand(0, 5))->get();
            $work->usersFavorite()->attach($users);
        })
        ->afterCreating(function (Work $work) {
            $users = User::inRandomOrder()->take(rand(0, 5))->get();
            foreach ($users as $user) {
                $marker = Marker::all()->random();
                $work->usersMarkers()->attach([$user->id => ['marker_id' => $marker->id]]);
            }
        });
    }
}
