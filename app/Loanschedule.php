<?php

namespace App;



class Loanschedule extends Model
{
    //

        public function repayment(){

       return $this->hasMany(Repayment::class);
    }

    public function monthrepayment(){


    	 return $this->hasMany(Repayment::class);
    }


      public function loan(){

            return $this->belongsTo(Loan::class);
          }


          public function monthpenaty(){

             return $this->hasOne(Monthpenaty::class);
          }

      /*    public function member(){

          return $this->hasManyThrough(Loan::class, Loanschedule::class, 'member_id');
      }*/
}


  