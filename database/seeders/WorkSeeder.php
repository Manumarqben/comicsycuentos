<?php

namespace Database\Seeders;

use App\Models\Age;
use App\Models\Author;
use App\Models\Chapter;
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

        $chapter = Chapter::create([
            'number' => 1,
            'title' => 'Capítulo primero',
            'type' => 'text',
            'work_id' => $work->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $contenido = "<h2><strong>Capítulo primero</strong></h2><p><i>Que trata de la condición y ejercicio del famoso hidalgo D. Quijote de la Mancha.&nbsp;</i></p><p>En un lugar de la Mancha, de cuyo nombre no quiero acordarme, no ha mucho tiempo que vivía un hidalgo de los de lanza en astillero, adarga antigua, rocín flaco y galgo corredor. Una olla de algo más vaca que carnero, salpicón las más noches, duelos y quebrantos los sábados, lentejas los viernes, algún palomino de añadidura los domingos, consumían las tres partes de su hacienda. El resto della concluían sayo de velarte, calzas de velludo para las fiestas con sus pantuflos de lo mismo, los días de entre semana se honraba con su vellori de lo más fino. Tenía en su casa una ama que pasaba de los cuarenta, y una sobrina que no llegaba a los veinte, y un mozo de campo y plaza, que así ensillaba el rocín como tomaba la podadera. Frisaba la edad de nuestro hidalgo con los cincuenta años, era de complexión recia, seco de carnes, enjuto de rostro; gran madrugador y amigo de la caza. Quieren decir que tenía el sobrenombre de Quijada o Quesada (que en esto hay alguna diferencia en los autores que deste caso escriben), aunque por conjeturas verosímiles se deja entender que se llama Quijana; pero esto importa poco a nuestro cuento; basta que en la narración dél no se salga un punto de la verdad. Es, pues, de saber, que este sobredicho hidalgo, los ratos que estaba ocioso (que eran los más del año) se daba a leer libros de caballerías con tanta afición y gusto, que olvidó casi de todo punto el ejercicio de la caza, y aun la administración de su hacienda; y llegó a tanto su curiosidad y desatino en esto, que vendió muchas hanegas de tierra de sembradura, para comprar libros de caballerías en que leer; y así llevó a su casa todos cuantos pudo haber dellos; y de todos ningunos le parecían tan bien como los que compuso el famoso Feliciano de Silva: porque la claridad de su prosa, y aquellas intrincadas razones suyas, le parecían de perlas; y más cuando llegaba a leer aquellos requiebros y cartas de desafío, donde en muchas partes hallaba escrito: la razón de la sinrazón que a mi razón se hace, de tal manera mi razón enflaquece, que con razón me quejo de la vuestra fermosura, y también cuando leía: los altos cielos que de vuestra divinidad divinamente con las estrellas se fortifican, y os hacen merecedora del merecimiento que merece la vuestra grandeza. Con estas y semejantes razones perdía el pobre caballero el juicio, y desvelábase por entenderlas, y desentrañarles el sentido, que no se lo sacara, ni las entendiera el mismo Aristóteles, si resucitara para sólo ello. No estaba muy bien con las heridas que don Belianis daba y recibía, porque se imaginaba que por grandes maestros que le hubiesen curado, no dejaría de tener el rostro y todo el cuerpo lleno de cicatrices y señales; pero con todo alababa en su autor aquel acabar su libro con la promesa de aquella inacabable aventura, y muchas veces le vino deseo de tomar la pluma, y darle fin al pie de la letra como allí se promete; y sin duda alguna lo hiciera, y aun saliera con ello, si otros mayores y continuos pensamientos no se lo estorbaran. Tuvo muchas veces competencia con el cura de su lugar (que era hombre docto graduado en Sigüenza), sobre cuál había sido mejor caballero, Palmerín de Inglaterra o Amadís de Gaula; mas maese Nicolás, barbero del mismo pueblo, decía que ninguno llegaba al caballero del Febo, y que si alguno se le podía comparar, era don Galaor, hermano de Amadís de Gaula, porque tenía muy acomodada condición para todo; que no era caballero melindroso, ni tan llorón como su hermano, y que en lo de la valentía no le iba en zaga. En resolución, él se enfrascó tanto en su lectura, que se le pasaban las noches leyendo de claro en claro, y los días de turbio en turbio, y así, del poco dormir y del mucho leer, se le secó el cerebro, de manera que vino a perder el juicio. Llenósele la fantasía de todo aquello que leía en los libros, así de encantamientos, como de pendencias, batallas, desafíos, heridas, requiebros, amores, tormentas y disparates imposibles, y asentósele de tal modo en la imaginación que era verdad toda aquella máquina de aquellas soñadas invenciones que leía, que para él no había otra historia más cierta en el mundo.</p>";

        $chapter->text()->create(['content' => $contenido]);

        $chapter = Chapter::create([
            'number' => 2,
            'title' => 'Capítulo segundo',
            'type' => 'text',
            'work_id' => $work->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $contenido = "<h2><strong>Capítulo segundo</strong></h2><p><i>Que trata de la primera salida que de su tierra hizo el ingenioso D. Quijote.&nbsp;</i></p><p>Hechas, pues, estas prevenciones, no quiso aguardar más tiempo a poner en efecto su pensamiento, apretándole a ello la falta que él pensaba que hacía en el mundo su tardanza, según eran los agravios que pensaba deshacer, tuertos que enderezar, sinrazones que enmendar, y abusos que mejorar, y deudas que satisfacer; y así, sin dar parte a persona alguna de su intención, y sin que nadie le viese, una mañana, antes del día (que era uno de los calurosos del mes de Julio), se armó de todas sus armas, subió sobre Rocinante, puesta su mal compuesta celada, embrazó su adarga, tomó su lanza, y por la puerta falsa de un corral, salió al campo con grandísimo contento y alborozo de ver con cuánta facilidad había dado principio a su buen deseo. Mas apenas se vió en el campo, cuando le asaltó un pensamiento terrible, y tal, que por poco le hiciera dejar la comenzada empresa: y fue que le vino a la memoria que no era armado caballero, y que, conforme a la ley de caballería, ni podía ni debía tomar armas con ningún caballero; y puesto qeu lo fuera, había de llevar armas blancas, como novel caballero, sin empresa en el escudo, hasta que por su esfuerzo la ganase. Estos pensamientos le hicieron titubear en su propósito; mas pudiendo más su locura que otra razón alguna, propuso de hacerse armar caballero del primero que topase, a imitación de otros muchos que así lo hicieron, según él había leído en los libros que tal le tenían. En lo de las armas blancas pensaba limpiarlas de manera, en teniendo lugar, que lo fuesen más que un armiño: y con esto se quietó y prosiguió su camino, sin llevar otro que el que su caballo quería, creyendo que en aquello consistía la fuerza de las aventuras.</p>";

        $chapter->text()->create(['content' => $contenido]);

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
