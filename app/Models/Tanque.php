<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use OwenIt\Auditing\Contracts\Auditable;
class Tanque extends Model //implements Auditable
{
    use HasFactory;
   // use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'codigo',
        'combustible',
        'descripcion',
        'capacidad',
        'cantidad_disponible',
        'cantidad_min',
        'estado',
        'fecha_carga'
    ];
}
