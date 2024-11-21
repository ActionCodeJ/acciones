<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'name',

        'action_id',
         'outlet_id', 
        'path'
    ];


    public function action()
    {
        return $this->belongsTo(Action::class);
    }
}
