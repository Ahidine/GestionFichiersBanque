<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //
        public function agences()
    {
        return $this->hasMany('App\Agence');
    }
        public function users()
    {
        return $this->belongsTo('App\User');
    }
}
