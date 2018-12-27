<?php

namespace App;



class Savings extends Model
{
    //

    public function user(){

    	return $this->belongsTo(User::class);
    }
}
