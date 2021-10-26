<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // un tag ha moliti post
    public function posts(){
        return $this->belongsToMany('App\Models\Post');
    }
}
