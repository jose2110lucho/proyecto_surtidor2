<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanque extends Model
{
    use HasFactory;

    protected $fillable = ['codigo','combustible','descripcion', 'capacidad_max', 'cantidad_disponible','cantidad_min','estado'];

}
