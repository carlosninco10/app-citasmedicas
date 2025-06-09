<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            //citas
            'ver-citas',
            'crear-cita',
            'editar-cita',

            //Especialistas
            'ver-especialistas',
            'crear-especialista',
            'mostrar-especialista',
            'editar-especialista',
            'eliminar-especialista',
        ];

        foreach($permisos as $permiso) {
            Permission::create(['name' => $permiso]);
        }
    }
}
