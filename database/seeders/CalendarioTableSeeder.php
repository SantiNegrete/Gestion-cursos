<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Calendario;

class CalendarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Calendario::create([
            'nombre_semana' => ' Semana 1',
            'fecha_inicio' => '2023-08-21',
            'fecha_fin' => '2023-08-25'
        ]);

        Calendario::insert([
            ['nombre_semana' => ' Semana 2', 'fecha_inicio' => '2023-08-28','fecha_fin' => '2023-09-01'],
            ['nombre_semana' => ' Semana 3', 'fecha_inicio' => '2023-09-04','fecha_fin' => '2023-09-08'],
            ['nombre_semana' => ' Semana 4', 'fecha_inicio' => '2023-09-11','fecha_fin' => '2023-09-15'],
            ['nombre_semana' => ' Semana 5', 'fecha_inicio' => '2023-09-18','fecha_fin' => '2023-09-22'],
            ['nombre_semana' => ' Semana 6', 'fecha_inicio' => '2023-09-25','fecha_fin' => '2023-09-29'],
            ['nombre_semana' => ' Semana 7', 'fecha_inicio' => '2023-10-02','fecha_fin' => '2023-10-06'],
            ['nombre_semana' => ' Semana 8', 'fecha_inicio' => '2023-10-09','fecha_fin' => '2023-10-13'],
            ['nombre_semana' => ' Semana 9', 'fecha_inicio' => '2023-10-16','fecha_fin' => '2023-10-20'],
            ['nombre_semana' => ' Semana 10', 'fecha_inicio' => '2023-10-23','fecha_fin' => '2023-10-27'],
            ['nombre_semana' => ' Semana 11', 'fecha_inicio' => '2023-10-30','fecha_fin' => '2023-11-03'],
            ['nombre_semana' => ' Semana 12', 'fecha_inicio' => '2023-11-06','fecha_fin' => '2023-11-10'],
            ['nombre_semana' => ' Semana 13', 'fecha_inicio' => '2023-11-13','fecha_fin' => '2023-11-17'],
            ['nombre_semana' => ' Semana 14', 'fecha_inicio' => '2023-11-20','fecha_fin' => '2023-11-24'],
            ['nombre_semana' => ' Semana 15', 'fecha_inicio' => '2023-11-27','fecha_fin' => '2023-12-01'],
            ['nombre_semana' => ' Semana 16', 'fecha_inicio' => '2023-12-04','fecha_fin' => '2023-12-08'],
        ]);



    }
}
