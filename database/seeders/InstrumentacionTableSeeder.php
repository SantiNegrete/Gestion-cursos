<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Instrumentacion;

class InstrumentacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Instrumentacion::create([
            'tipo_instrumentacion' => ' Análisis de Campo',
        ]);

        Instrumentacion::insert([
            ['tipo_instrumentacion' => ' Cátedra Docente'],
            ['tipo_instrumentacion' => ' Debates/ Discusión'],
            ['tipo_instrumentacion' => ' Estudio de Campo'],
            ['tipo_instrumentacion' => ' Investigación Documental'],
            ['tipo_instrumentacion' => ' Prácticas de Laboratorio'],
            ['tipo_instrumentacion' => ' Proyecto'],
            ['tipo_instrumentacion' => ' Resolución de Ejercicios'],
            ['tipo_instrumentacion' => ' Uso de multimedia/software'],
            ['tipo_instrumentacion' => ' Vista con propósitos de estudio'],


        ]);

    }
}
