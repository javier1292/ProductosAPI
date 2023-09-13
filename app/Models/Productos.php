<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productos extends Model
{
    use HasFactory, SoftDeletes;



    public function categoria()
    {
        return $this->belongsToMany(Categorias::class, 'categoria_productos', 'producto_id', 'categoria_id');
    }
}
