<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $primaryKey = 'ci';

    protected $fillable = ['ci','nombre','apellido', 'telefono', 'puntos'];

}
