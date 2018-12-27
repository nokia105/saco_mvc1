<?php

namespace App;

class Collateral extends Model
{
    //

      public function memberCollateral(){


      	return $this->belongsTo(Member::class);
      }


      public function loanscollatreral(){

      	   return $this->belongsToMany(Loan::class);
      }
}
