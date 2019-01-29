<?php

namespace App;



class Categoryaccount extends Model
{
    //


     public function mainaccounts(){


     	  return $this->hasManyThrough(Mainaccount::class,Categoryaccountstype::class);
     }

    
}
