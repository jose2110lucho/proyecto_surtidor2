<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;
class Cliente extends Model implements Auditable
{
    use HasFactory;
    use AuditingAuditable;

    protected $fillable = [
        'ci',
        'nombre',
        'apellido',
        'telefono',
        'puntos',
        'estado'
    ];


    public function premios()
    {
        return $this->belongsToMany(Premio::class, 'cliente_premio')
        ->withPivot('id')
        ->withTimestamps();
    }
}
