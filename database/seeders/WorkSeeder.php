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
            'synopsis' => 'El ingenioso hidalgo don Quijote de la Mancha narra las aventuras de Alonso Quijano, un hidalgo pobre que de tanto leer novelas de caballería acaba enloqueciendo y creyendo ser un caballero andante, nombrándose a sí mismo como don Quijote de la Mancha',
            'front_page' => 'front_pages/don-quijote.jpg',
            'age_id' => Age::where('year', '9')->first()->id,
            'state_id' => State::where('slug', 'finished')->first()->id,
            'type_id' => Type::where('slug', 'tale')->first()->id,
            'author_id' => Author::where('slug', 'author')->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $genres = Genre::where('slug', 'action')
            ->orWhere('slug', 'romance')
            ->get();
        $work->genres()->attach($genres);

        $work = Work::create([
            'title' => 'El principito',
            'slug' => str('El principito')->slug(),
            'synopsis' => 'El principito es una narración corta del escritor francés Antoine de Saint-Exupéry. La historia se centra en un pequeño príncipe que realiza una travesía por el universo. En este viaje descubre la extraña forma en que los adultos ven la vida y comprende el valor del amor y la amistad.',
            'front_page' => 'front_pages/el-principito.jpeg',
            'age_id' => Age::where('year', '0')->first()->id,
            'state_id' => State::where('slug', 'finished')->first()->id,
            'type_id' => Type::where('slug', 'tale')->first()->id,
            'author_id' => Author::where('slug', 'author')->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $genres = Genre::where('slug', 'action')->get();
        $work->genres()->attach($genres);

        $work = Work::create([
            'title' => 'El nombre de la rosa',
            'slug' => str('El nombre de la rosa')->slug(),
            'synopsis' => 'Un monasterio medieval se ve plagado de atroces asesinatos y sólo un hombre puede juntar las piezas del rompecabezas.',
            'front_page' => 'front_pages/el-nombre.jpg',
            'age_id' => Age::where('year', '12')->first()->id,
            'state_id' => State::where('slug', 'finished')->first()->id,
            'type_id' => Type::where('slug', 'tale')->first()->id,
            'author_id' => Author::where('slug', 'author')->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $genres = Genre::where('slug', 'terror')->get();
        $work->genres()->attach($genres);

        $work = Work::create([
            'title' => 'El Lazarillo de Tormes',
            'slug' => str('El Lazarillo de Tormes')->slug(),
            'synopsis' => 'La novela cuenta la vida de un niño llamado Lázaro que al principio era inocente, pero se convirtió en pícaro para poder sobrevivir.',
            'front_page' => 'front_pages/el-lazarillo.jpg',
            'age_id' => Age::where('year', '6')->first()->id,
            'state_id' => State::where('slug', 'finished')->first()->id,
            'type_id' => Type::where('slug', 'tale')->first()->id,
            'author_id' => Author::where('slug', 'author')->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $genres = Genre::where('slug', 'action')
            ->orWhere('slug', 'romance')
            ->get();
        $work->genres()->attach($genres);

        $work = Work::create([
            'title' => 'Los viajes de Gulliver',
            'slug' => str('Los viajes de Gulliver')->slug(),
            'synopsis' => 'Gulliver es un apasionado de los viajes. En su afán por descubrir mundo, vivirá grandes aventuras que lo llevarán a lugares extraordinarios donde conocerá a los seres más insólitos: los minúsculos liliputienses, los gigantes de Brobdingnag, unos sabios insensatos que viven en una isla voladora y unos seres que, sin serlo, son de lo más humanos',
            'front_page' => 'front_pages/los-viajes.jpg',
            'age_id' => Age::where('year', '16')->first()->id,
            'state_id' => State::where('slug', 'finished')->first()->id,
            'type_id' => Type::where('slug', 'tale')->first()->id,
            'author_id' => Author::where('slug', 'author')->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $genres = Genre::where('slug', 'action')
            ->orWhere('slug', 'romance')
            ->orWhere('slug', 'terror')
            ->get();
        $work->genres()->attach($genres);

        $work = Work::create([
            'title' => 'Kama-sutra',
            'slug' => str('Kama-sutra')->slug(),
            'synopsis' => 'Un antiguo texto hinduista que trata sobre el comportamiento sexual humano; el cual destaca por las posturas corporales a realizar en su práctica',
            'front_page' => 'front_pages/kama-sutra.jpg',
            'age_id' => Age::where('year', '18')->first()->id,
            'state_id' => State::where('slug', 'finished')->first()->id,
            'type_id' => Type::where('slug', 'tale')->first()->id,
            'author_id' => Author::where('slug', 'author')->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $genres = Genre::where('slug', 'romance')->get();
        $work->genres()->attach($genres);

        Work::factory(20)->create();
    }
}
