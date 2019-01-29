<?php

namespace App;


class Payment extends Model
{
    //

      public function loan(){

      	 return $this->belongsTo(Loan::class);
      }


      public function membersaving(){

      	  return $this->belongsTo(Membersaving::class);
      }


       public function membershare(){

      	  return $this->belongsTo(Member_share::class);
      }


      public function memberregfee(){

      	  return $this->belongsTo(Regfee::class);
      }


      /*public function memberonsaving(){


        return  $this->hasManyThrough('member_id',Member::class, Membersaving::class);
      }

       public function memberonshare(){


        return  $this->hasManyThrough('member_id',Member::class, Member_share::class);
      }

       public function memberonreg(){


        return  $this->hasManyThrough(Member::class,'member_id', Regfee::class);
      }*/
}
