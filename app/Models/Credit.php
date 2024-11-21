<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $table = 'creditos';

    // /clientes
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // /usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
