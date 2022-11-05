<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente_Premio extends Model
{
    use HasFactory;

    protected $table = 'cliente_premio';

    protected $fillable = [
        'cliente_id',
        'premio_id',
        'puntos_canjeados',
    ];
}
