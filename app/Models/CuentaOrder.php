<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuentaOrder extends Model
{
    protected $table = 'cuentas_orders';
    protected $fillable = [
        'cuenta_id',
        'order_id',
        'fecha',
        'cheque',
        'tipo_cheque',
        'monto',
        'vencimiento',
    ];

    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
