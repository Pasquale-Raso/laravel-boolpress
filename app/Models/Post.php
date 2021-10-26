<?php

namespace App\Models;
//! creazione campo per le date con carbon
use Carbon\Carbon;
//! --------------------------------------
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'slug', 'image', 'category_id'];


    //! creazione campo per le date con carbon   
    public function getFormattedDate($column, $format = 'd-m-Y H:m')
    {
        return  Carbon::create($this->$column)->format($format);
    }    
    //! --------------------------------------

    public function category(){
        return $this->belongsTo('App\Model\Category');
    }


    // un post può avere più tag
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

}
