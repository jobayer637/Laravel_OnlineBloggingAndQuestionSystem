<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function user(){
      return $this->belongsTo('App\User');
    }

    public function answers(){
    	return $this->hasMany('App\Answer');
    }

    public function likes(){
    	return $this->hasMany('App\Like');
    }

    public function type(){
        return $this->belongsTo('App\Types');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag','ques_tags')->withTimestamps();
    }
}
