<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;
    protected $table = 'secciones';
    protected $fillable = [
        'nombre',
        'descripcion',
        'area_id',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}
