<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'unidades',
        'puntos_requeridos',
        'estado',
        'producto_id',
    ];

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'cliente_premio')->withTimestamps();
    }

    public function producto()
    {
        return $this->hasOne(Producto::class, 'id', 'producto_id');
    }
}
