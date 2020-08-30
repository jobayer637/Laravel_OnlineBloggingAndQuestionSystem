<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user(){
      return $this->belongsTo('App\User');
    }

    public function blog(){
      return $this->belongsTo('App\Blog');
    }

    public function replyComments(){
      return $this->hasMany('App\replyComment');
    }
}
