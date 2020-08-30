<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class replyComment extends Model
{
    public function user(){
      return $this->belongsTo('App\User');
    }

    public function comment(){
      return $this->belongsTo('App\Comment');
    }
}
