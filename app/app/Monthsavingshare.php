<?php

namespace App;



class Monthsavingshare extends Model
{
    //

    public function member(){

    	 return $this->belongsTo(Member::class,'member_id');
    }
}
