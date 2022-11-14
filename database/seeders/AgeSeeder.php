<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ages')->insert([
            'id' => '1',
            'name' => '0',
            'description' => 'Adecuados para todos los grupos de edad.',
        ]);
        DB::table('ages')->insert([
            'id' => '2',
            'name' => '6',
            'description' => 'Las obras no contienen imágenes que puedan asustar a los niños pequeños. Una forma muy leve de violencia (en un contexto cómico o en un entorno infantil) es aceptable. No se lee un lenguaje soez.',
        ]);
        DB::table('ages')->insert([
            'id' => '3',
            'name' => '9',
            'description' => 'Su contenido puede atemorizar a los niños más pequeños. Las formas muy suaves de violencia (violencia implícita, no detallada o no realista) son aceptables.',
        ]);
        DB::table('ages')->insert([
            'id' => '4',
            'name' => '12',
            'description' => 'Las obras muestran violencia de una naturaleza un poco más gráfica hacia los personajes de fantasía o violencia no realista hacia los personajes humanos. Puede haber insinuaciones sexuales o posturas sexuales, mientras que cualquier lenguaje soez es leve.',
        ]);
        DB::table('ages')->insert([
            'id' => '5',
            'name' => '16',
            'description' => 'La descripción de la violencia (o actividad sexual) alcanza un nivel semejante al que se esperaría en la vida real. El uso de lenguaje incorrecto puede ser más extremo, mientras que los juegos de azar y el uso de tabaco, alcohol o drogas ilegales también pueden estar presentes.',
        ]);
        DB::table('ages')->insert([
            'id' => '6',
            'name' => '18',
            'description' => 'A partir de 18 años. Obras recomendadas para mayores de 18 años. La violencia alcanza un nivel tal que se convierte en una representación de violencia brutal, asesinato sin motivo aparente o violencia hacia personajes indefensos. El uso de drogas ilegales y la actividad sexual explícita también están incluidos.',
        ]);
    }
}
