<?php

namespace App;



class Member_share extends Model
{
    //

   protected $table = 'member_share';

    public function member(){
      
       return $this->belongsTo(Member::class,'member_id');
    }
}
