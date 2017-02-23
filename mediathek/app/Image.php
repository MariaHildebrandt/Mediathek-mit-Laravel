<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function book()
    {
    	return $this->belongsTo('App\book');
    }
    
    public function film()
    {
    	return $this->belongsTo('App\film');
    }
}
