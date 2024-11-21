<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionTeam extends Model
{
    protected $table = 'actions_teams';
    protected $fillable = [
        'action_id',
        'teams_id',
        
    ];
    public function action()
    {
        return $this->belongsTo(Action::class);
    }

    
    public function team()
    {
        return $this->belongsTo(Team::class, 'teams_id');
    }
}
