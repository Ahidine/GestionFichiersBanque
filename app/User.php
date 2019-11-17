<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','last_name','profil',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


  public function regions()
    {
        return $this->hasMany('App\Region');
    }
      public function agents()
    {
        return $this->hasMany('App\Agent');
    }
  public function agences()
    {
        return $this->hasMany('App\Agence');
    }
  public function dossiers()
    {
        return $this->hasMany('App\Agent');
    }
}
