<?php

namespace App\Models;
//! creazione campo per le date con carbon
use Carbon\Carbon;
//! --------------------------------------
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //! creazione campo per le date con carbon   
    public function getFormattedDate($column, $format = 'd-m-Y H:m')
    {
        return  Carbon::create($this->$column)->format($format);
    }    
    //! --------------------------------------
}
