<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCuenta extends Model
{
    protected $table = 'user_cuenta';
    protected $fillable = [
        'cuenta_id',
        'user_id',
    ];

    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class);
    }
}
