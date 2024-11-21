<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionEntity extends Model
{
    protected $table = 'actions_entities';

    protected $fillable = [
        'action_id',
        'entity_id',
        
    ];

    public function action()
    {
        return $this->belongsTo(Action::class);
    }

    
    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}
