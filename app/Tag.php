<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use MongoDB\BSON\Timestamp;

class Tag extends Model
{
    public function questions(){
        return $this->belongsToMany('App\Question','ques_tags')->withTimestamps();
    }
}
