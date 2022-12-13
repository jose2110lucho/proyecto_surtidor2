<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaCombustible extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_cliente',
        'codigo',
        'fecha',
        'precio',
        'cantidad_combustible',
    ];
}
