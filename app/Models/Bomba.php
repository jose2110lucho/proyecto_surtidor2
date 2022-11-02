<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bomba extends Model
{
    use HasFactory;
    protected $fillable=['codigo','nombre','combustible','descripcion','estado','tanque_id'];
  
    public function tanques(){
        return $this->belongsToMany(Tanque::class,'id','codigo'); // PErtenece a categoria 1 bomba pertenece a una categoria

    }
}
