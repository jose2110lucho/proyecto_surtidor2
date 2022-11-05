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
        'stock',
        'puntos_requeridos',
        'estado',
        'producto_id',
        'unidades_producto',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'cliente_premio')->withTimestamps()->withPivot('id','cantidad','puntos_canjeados');
    }

    public function producto()
    {
        return $this->hasOne(Producto::class, 'id', 'producto_id');
    }
}
