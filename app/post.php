<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    protected $guarded = [];  

    public function category(){

      return  $this->belongsTo('App\category');
    }


    public function comment(){

      return  $this->hasmany('App\comment');
    }

    
    public function favorite(){

      return  $this->hasmany('App\favorite');
    }


    public function user(){

      return  $this->belongsTo('App\User');
    }


}
