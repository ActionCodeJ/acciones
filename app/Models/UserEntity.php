<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEntity extends Model
{
    
    protected $table = 'user_entities';

    protected $fillable = [
        'entity_id',
        'user_id',
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
