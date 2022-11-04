<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use OwenIt\Auditing\Contracts\Auditable;
class Tanque extends Model //implements Auditable
{
    use HasFactory;

    protected $fillable = ['codigo','combustible','descripcion', 'capacidad_max', 'cantidad_disponible',
    'cantidad_min','estado'];

    public function bombas(){
        return $this->hasMany(Bomba::class,'id'); // 1 tanque  tiene muchas bombas
    }

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
