<?php

namespace Database\Seeders;

use App\Models\Categorias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoria = new Categorias();
        $categoria->nombre = 'Hogar';
        $categoria->descripcion = 'Productos para el hogar';
        $categoria->save();

        $categoria = new Categorias();
        $categoria->nombre = 'Oficina';
        $categoria->descripcion = 'Productos para la oficina';
        $categoria->save();

        $categoria = new Categorias();
        $categoria->nombre = 'Tecnología';
        $categoria->descripcion = 'Productos tecnológicos';
        $categoria->save();

        $categoria = new Categorias();
        $categoria->nombre = 'Mascotas';
        $categoria->descripcion = 'Productos para mascotas';
        $categoria->save();

        $categoria = new Categorias();
        $categoria->nombre = 'Juguetes';
        $categoria->descripcion = 'Productos para niños';
        $categoria->save();

        $categoria = new Categorias();
        $categoria->nombre = 'Deportes';
        $categoria->descripcion = 'Productos para deportes';
        $categoria->save();
    }
}
