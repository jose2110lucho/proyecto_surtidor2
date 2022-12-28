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
        'user_bombas_id',   //colocado por orden de gerald

      ];

      public function userBombas()
    {
        return $this->belongsTo(UserBomba::class);
    }


    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
}







