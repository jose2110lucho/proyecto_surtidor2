<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';

    protected $fillable = [
        'codigo',
        'nombre',
        'precio_compra',
        'precio_venta',
        'estado',
        'producto_id'
    ];

    public function premio()
    {
        return $this->belongsTo(Premio::class, 'producto_id', 'id');
    }
}
