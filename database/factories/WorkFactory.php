<?php

namespace Database\Factories;

use App\Models\Age;
use App\Models\Author;
use App\Models\Chapter;
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
            // Se asignan géneros la obra
            $genres = Genre::inRandomOrder()->take(rand(1, 3))->get();
            $work->genres()->attach($genres);
        })
            ->afterCreating(function (Work $work) {
                // Se asignan usuarios que tienen en favoritos la obra
                $users = User::inRandomOrder()->take(rand(0, 5))->get();
                $work->usersFavorite()->attach($users);
            })
            ->afterCreating(function (Work $work) {
                // Se asignan usuarios que tienen marcada la obra con algún marcador
                $users = User::inRandomOrder()->take(rand(0, 5))->get();
                foreach ($users as $user) {
                    $marker = Marker::all()->random();
                    $work->usersMarkers()->attach([$user->id => ['marker_id' => $marker->id]]);
                }
            })
            ->afterCreating(function (Work $work) {
                // Se asignan capítulos a la obra
                $number = 1;
                // El state permite trabajar con la variable local desde el factory
                // El use (&$number) permite referenciar a la variable
                Chapter::factory(rand(0, 20))->state(function () use (&$number) {
                    return [
                        'number' => $number++,
                    ];
                })->create([
                    'work_id' => $work->id,
                ]);
            });
    }
}
