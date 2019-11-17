<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    //

      public function users()
    {
        return $this->belongsTo('App\User');
    }
            public function agences()
    {
        return $this->belongsTo('App\Agence');
    }
    public function dossiers()
    {
        return $this->belongsToMany('App\Dossier', 'agent_dossiers', 'agent_id', 'dossier_id');
    }
}
