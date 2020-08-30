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
        'name', 'email', 'password','image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
      return $this->belongsTo('App\Role');
    }

    public function ques(){
      return $this->hasMany('App\Question');
    }

    public function anss(){
        return $this->hasMany('App\Answer');
    }

    public function reanss(){
        return $this->hasMany('App\Answer');
    }

    public function blogs(){
      return $this->hasMany('App\Blog');
    }

    public function comments(){
      return $this->hasMany('App\Comment');
    }
    public function reply_comments(){
      return $this->hasMany('App\replyComment');
    }
    public function likes(){
      return $this->hasMany('App\Like');
    }
}
