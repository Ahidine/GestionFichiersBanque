<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    //


         public function agences()
    {
        return $this->belongsToMany('App\Agence');
    }
        public function agents()
        {

        	 return $this->belongsToMany('App\Agent', 'agent_dossiers','dossier_id','agent_id');
        }
}
