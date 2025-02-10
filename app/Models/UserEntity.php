<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEntity extends Model
{
    
    protected $table = 'user_entities';

    protected $fillable = [
        'id_entity',
        'id_user',
        'observacion'
        
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    
    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}
