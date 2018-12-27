<?php

namespace App;



class Loan extends Model
{
    //


   public $timestamps = false;



        public function insurances(){

         return $this->belongsTo('App\Insurance','insurance_id');
       }

    public function user(){

    	return $this->belongsTo(User::class);
    }


     public function guarantor(){

     	return $this->belongsToMany(Member::class,'loan_guarantor','loan_id','guarator_id')->withTimestamps();
     }



       public function collaterals(){

       	return $this->belongsToMany(Collateral::class)->withTimestamps();
       }
       public function loan_fees(){

        return $this->belongsToMany(Feescategory::class)->withTimestamps();
       }

      public function loancategory(){

         return $this->belongsTo(Loancategory::class);
       }

          public function loanschedule(){

            return $this->hasMany(Loanschedule::class);
          }


         public function loanrepayment(){

            return $this->hasManyThrough(Repayment::class, Loanschedule::class);
         }

            
             public function member(){

              return $this->belongsTo(Member::class,'member_id');
             }


            
          public function shares(){


             return $this->hasMany(Member_share::class);
          }


          public function loanpayment(){

             return $this->hasOne(Loanpayment::class);
          }

          public function voucher(){

            return $this->hasOne(Voucher::class);
          }

           public function payment(){

              
           }
         

}
