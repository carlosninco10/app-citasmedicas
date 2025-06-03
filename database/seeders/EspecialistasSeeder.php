<?php

namespace Database\Seeders;

use App\Models\Especialistas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EspecialistasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Especialistas::insert([
            [
                'nombre' => 'Anestesiología',
                'descripcion' => 'Se encarga de la anestesia y el manejo del dolor durante y después de las cirugías.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Cardiología',
                'descripcion' => 'Estudia y trata enfermedades del corazón y del sistema circulatorio.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Dermatología',
                'descripcion' => 'Se ocupa de las enfermedades de la piel, cabello y uñas.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Pediatría',
                'descripcion' => 'Especialidad que se centra en la salud de los niños y adolescentes.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Ginecología y Obstetricia',
                'descripcion' => 'Se ocupa de la salud reproductiva de la mujer y el embarazo.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Gastroenterología',
                'descripcion' => 'La gastroentetrología trata las funciones y enfermedades del sistema digestivo.
                    Tratan problemas relacionado a la vesícula biliar, estomago, intestinos, entre otros.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Infectología',
                'descripcion' => 'La infectología trata las infecciones que son difíciles de tratar o diagnosticar.',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
