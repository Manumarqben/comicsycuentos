<?php

namespace Database\Seeders;

use App\Models\Age;
use App\Models\Author;
use App\Models\Genre;
use App\Models\State;
use App\Models\Type;
use App\Models\Work;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $work = Work::create([
            'title' => 'Don Quijote de la Mancha',
            'slug' => str('Don Quijote de la Mancha')->slug(),
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisietwrhywcing elit. Quod ipsum praesentium voluptas hic atque voluptatum, labore autem id earum minus similique, quia dignissimos itaque aspernatur nulla perferendis beatae eveniet qui!, Lorem ipsum dolor sit amet consectetur adipisietwrhywcing elit. Quod ipsum praesentium voluptas hic atque voluptatum, labore autem id earum minus similique, quia dignissimos itaque aspernatur nulla perferendis beatae eveniet qui!, Lorem ipsum dolor sit amet consectetur adipisietwrhywcing elit. Quod ipsum praesentium voluptas hic atque voluptatum, labore autem id earum minus similique, quia dignissimos itaque aspernatur nulla perferendis beatae eveniet qui!',
            'front_page' => 'https://m.media-amazon.com/images/I/41D4yBQJGrL._SY264_BO1,204,203,200_QL40_ML2_.jpg',
            'age_id' => Age::all()->random()->id,
            'state_id' => State::all()->random()->id,
            'type_id' => Type::all()->random()->id,
            'author_id' => Author::all()->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $genres = Genre::inRandomOrder()->take(rand(1, 3))->get();
        $work->genres()->attach($genres);

        $work = Work::create([
            'title' => 'El principito',
            'slug' => str('El principito')->slug(),
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisiciqaetyhng elit. Quod ipsum praeseqw7intium voluptas hic atque voluptatum, labore autem id earum minus similique, quia dignissimos itaque aspernatur nulla perferendis beatae eveniet qui!',
            'front_page' => 'https://www.sopadesapo.com//imagenes_grandes/9788419/978841947209.JPG',
            'age_id' => Age::all()->random()->id,
            'state_id' => State::all()->random()->id,
            'type_id' => Type::all()->random()->id,
            'author_id' => Author::all()->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $genres = Genre::inRandomOrder()->take(rand(1, 3))->get();
        $work->genres()->attach($genres);

        $work = Work::create([
            'title' => 'El nombre de la rosa',
            'slug' => str('El nombre de la rosa')->slug(),
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod ipsum praesenq45tgqeyutium voluptas hic atque voluptatum, labore autem id earum minus similique, quia dignissimos itaque aspernatur nulla perferendis beatae eveniet qui!',
            'front_page' => 'https://m.media-amazon.com/images/I/41oKDj3pd2L._SY346_.jpg',
            'age_id' => Age::all()->random()->id,
            'state_id' => State::all()->random()->id,
            'type_id' => Type::all()->random()->id,
            'author_id' => Author::all()->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $genres = Genre::inRandomOrder()->take(rand(1, 3))->get();
        $work->genres()->attach($genres);

        $work = Work::create([
            'title' => 'El Lazarillo de Tormes',
            'slug' => str('El Lazarillo de Tormes')->slug(),
            'synopsis' => 'Lorem ipsum dolor sit amet consectetqa46eutyur adipisicing elit. Quod ipsum praesentium voluptas hic atque voluptatqa5ertgum, labore autem id earum minus similique, quia dignissimos itaque aspernatur nulla perferendis beatae eveniet qui!',
            'front_page' => 'https://editorialverbum.es/wp-content/uploads/2016/11/El-Lazarillo-de-Tormes.jpg',
            'age_id' => Age::all()->random()->id,
            'state_id' => State::all()->random()->id,
            'type_id' => Type::all()->random()->id,
            'author_id' => Author::all()->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $genres = Genre::inRandomOrder()->take(rand(1, 3))->get();
        $work->genres()->attach($genres);

        $work = Work::create([
            'title' => 'Los viajes de Gulliver',
            'slug' => str('Los viajes de Gulliver')->slug(),
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod ipsum praesentium voluptas hic atque voluptatum, labore autem id earum minus similique, quia dignissimos itaque aspernatur nulla perferendis beatae eveniet qui!',
            'front_page' => 'https://m.media-amazon.com/images/I/51GiPzXx3SL._SY346_.jpg',
            'age_id' => Age::all()->random()->id,
            'state_id' => State::all()->random()->id,
            'type_id' => Type::all()->random()->id,
            'author_id' => Author::all()->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $genres = Genre::inRandomOrder()->take(rand(1, 3))->get();
        $work->genres()->attach($genres);

        Work::factory(20)->create();
    }
}
