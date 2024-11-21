<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderSeccion extends Model
{
    protected $table = 'order_secciones';
    protected $fillable = [
        'seccion_id',
        'order_id',
    ];

    public function Seccion()
    {
        return $this->belongsTo(Seccion::class);
    }
}
