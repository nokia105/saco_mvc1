<?php

namespace App;


class Categoryaccountstype extends Model
{
    //



     public function bankaccounts(){


     	  return $this->hasManyThrough(Bankaccount::class, Mainaccount::class);
     }

}
