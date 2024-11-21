<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'name',

        'action_id',
         'outlet_id', 
        'image_path'
    ];


    public function action()
    {
        return $this->belongsTo(Action::class);
    }
}
