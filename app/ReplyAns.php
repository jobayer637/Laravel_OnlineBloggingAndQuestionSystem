<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplyAns extends Model
{
    public function ans(){
    	return $this->belongsTo('App\Answer');
    }
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
