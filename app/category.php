<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $guarded = [];  

    public function user(){

      return  $this->belongsTo('App\User');
    }


    public function post(){

        return  $this->hasMany('App\post');
      }



}
