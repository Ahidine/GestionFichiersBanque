<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    //
       public function dossiers()
    {
        return $this->belongsToMany('App\Dossier');
    }
    public function agents()
    {
        return $this->hasMany('App\Agent');
    }
        public function users()
    {
        return $this->belongsTo('App\User');
    }
        public function regions()
    {
        return $this->belongsTo('App\Region');
    }
        public function objectifs()
        {
        	return $this->belongsToMany('App\Objectif');
        }
}
