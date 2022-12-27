<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBomba extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'fecha_asignacion',
        'user_id',
        'bomba_id',
    ];

    public function Bomba()
    {
        return $this->belongsTo('App\Models\Bomba','bomba_id');
    }
}