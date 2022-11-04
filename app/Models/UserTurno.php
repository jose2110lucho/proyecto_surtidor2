<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTurno extends Model
{
    use HasFactory;
    protected $table = 'users_turnos';
    protected $fillable = [
     'user_id',
     'turno_id', 
    ];
}
