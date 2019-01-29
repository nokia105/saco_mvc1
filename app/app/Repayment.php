<?php

namespace App;


class Repayment extends Model
{
    //


       public function monthrepayment(){


    	 return $this->belongsToMany(Loanschedule::class);
    }
}
