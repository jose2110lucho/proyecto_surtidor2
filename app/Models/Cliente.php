<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'ci',
        'nombre',
        'apellido',
        'telefono',
        'puntos',
        'estado'
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }

    public function premios()
    {
        return $this->belongsToMany(Premio::class, 'cliente_premio')
        ->withPivot('id','cantidad','puntos_canjeados')
        ->withTimestamps();
    }
}
