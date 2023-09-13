<?php

namespace Database\Seeders;

use App\Models\Productos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $producto = new Productos();
        $producto->nombre = 'Producto 1';
        $producto->descripcion = 'Descripcion del producto 1';
        $producto->precio = 1000;
        $producto->save();
    }
}
