<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoActividad extends Model
{
    use SoftDeletes;

    protected $table = 'actividades_laborales';

    protected $fillable = [
        'descripcion',
        'orden_adicional',
        'user_upd'
    ];
}
