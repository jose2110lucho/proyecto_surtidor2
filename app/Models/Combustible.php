<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combustible extends Model
{
    use HasFactory;
    protected $fillable = ['codigo','nombre','precio_compra', 'precio_venta', 'unidad_medida','categoria_id'];

    public function categorias(){
        return $this->belongsToMany(Categoria::class,'id','codigo'); 

    }
}
