<?php

namespace App;



class Share extends Model
{
    //

    public function user(){

    	return $this->belongsTo(User::class);
    }
}
