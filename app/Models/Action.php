<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Action extends Model
{
    protected $table = 'actions';
   

    public function entidad()
    {
        return $this->belongsTo(Entity::class ,'entity_id');
    }

    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function mapa(): HasOne
    {
        return $this->hasOne(Outlet::class);
    }

    public function imagenes()
    {
        return $this->hasMany(Image::class);
    }
    public function personas()
    {
        return $this->hasMany(ActionTeam::class);
    }
   
    public function secundarios()
    {
        return $this->hasMany(ActionEntity::class);
    }


    public function documentos()
    {
        return $this->hasMany(Document::class);
    }


    public function estado()
    {
        return $this->belongsTo(ActionState::class,'estate_id');
    }

    public function tipo()
    {
        return $this->belongsTo(ActionType::class,'type_id');
    }
      
        
}
