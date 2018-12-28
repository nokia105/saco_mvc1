<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;




class Member extends Authenticatable
{
    //

     use Notifiable;

    use HasRoles;

        
     protected $table='members';
     protected $primaryKey = 'member_id';
     protected $dates = ['joining_date'];

     protected $guard = 'member';

     protected $guarded = [

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     

    public function user(){

    	return $this->belongsTo(User::class);
    }

       public function collateral(){


       	  return $this->hasMany(Collateral::class,'member_id');
          
       }


      /*    public function loans(){

     	return $this->belongsToMany(Loan::class,'loan_guarantor','loan_id','guarator_id');
     }*/

           public function loans(){

      return $this->hasMany(Loan::class,'member_id');
     }


     public function loanlist(){

         return $this->hasMany(Loan::class,'member_id')->orderBy('repayment_date','ASC');
       }

       public function no_shares(){

         return $this->hasMany(Member_share::class,'member_id');
       }

       public function savingamount(){

         return $this->hasMany(Membersaving::class,'member_id');
       }


         static function numeric($length){
         
            $chars = "1234567890";
            $clen   = strlen( $chars )-1;
            $id  = '';

            for ($i = 0; $i < $length; $i++) {
                  $id .= $chars[mt_rand(0,$clen)];
          }

           return ($id);

      }


      public function memberaccount(){

          return $this->hasMany(Memberaccount::class,'member_id');
      }


      public function regfee(){

         return $this->hasOne(Regfee::class,'member_id');
      } 


      public function loanschedule(){

          return $this->hasManyThrough(Loanschedule::class,Loan::class,'member_id');
      } 

      public function loan_payment(){

          return $this->hasManyThrough(Payment::class,Loan::class,'member_id');
      } 

       public function share_payment(){

          return $this->hasManyThrough(Payment::class,Member_share::class,'member_id');
      } 


       public function saving_payment(){

          return $this->hasManyThrough(Payment::class,Membersaving::class,'member_id');
      } 


       public function regfee_payment(){

          return $this->hasManyThrough(Payment::class,Regfee::class,'member_id');
      } 


       public function monthsavingshare(){

           return $this->hasMany(Monthsavingshare::class,'member_id');
       }


}
