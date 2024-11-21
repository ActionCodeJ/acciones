<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'amount',
        'order_id',
        'user_id',
        'date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getCustomerName()
    {
        if ($this->order) {
            if ($this->order->customer) {
                return $this->order->customer->first_name.' '.$this->order->customer->last_name;
            }
            return 'Sin Cliente Definido';
        }

        return 'Sin Prestamo Definido';
    }
}
