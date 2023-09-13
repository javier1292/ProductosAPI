<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorias extends Model
{
    use HasFactory, SoftDeletes;


    public function productos()
    {
        return $this->belongsToMany(Productos::class, 'categoria_productos', 'categoria_id', 'producto_id');
    }
}
