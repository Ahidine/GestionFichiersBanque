<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objectif extends Model
{
    //
            public function agences()
        {
        	return $this->belongsToMany('App\Agence');
        }
}
