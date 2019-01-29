<?php

namespace App;



class Bankaccount extends Model
{
    //


      public function categoryaccountstype(){


     	  return $this->hasManyThrough(Categoryaccountstype::class, Mainaccount::class);
     }
}
