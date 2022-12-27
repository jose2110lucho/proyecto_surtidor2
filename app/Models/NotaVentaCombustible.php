<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaVentaCombustible extends Model
{
    use HasFactory;
    protected $table = 'nota_venta_combustible';
    protected $fillable = [
        'fecha',
        'total',
        'cantidad_combustible',
        'vehiculo_id',
      ];
}


            