<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;



    public function categoria()
    {
        return $this->belongsToMany(Categorias::class, 'categoria_productos', 'producto_id', 'categoria_id');
    }
}
