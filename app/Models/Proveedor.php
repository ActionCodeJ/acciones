<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'cuil',
        'codigoPostal',


        'cbu',
        'alias',
        'tipo',
        'iva',

        'ctaBanco',
        'ctaPesos',
        'ctaBonos',
        'codigoBanco',
        'ingresosBrutos	',

        'ingresosBrutosNro',
        'ganancias',
        'gananciasNro',
        'tipoRazonSocial',
        'cedulaFiscal',

        'avatar',
        'user_id',
    ];

    public function getAvatarUrl()
    {
        return Storage::url($this->avatar);
    }
}
