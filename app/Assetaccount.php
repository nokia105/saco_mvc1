<?php

namespace App;

class Assetaccount extends Model
{
    //

     public $timestamps = false;


     public function mainaccount(){

     	  return $this->belongsTo(Mainaccount::class);
     }
}
