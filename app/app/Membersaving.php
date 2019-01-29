<?php

namespace App;



class Membersaving extends Model
{
    public $timestamps = false;//


    public function member(){
      
       return $this->belongsTo(Member::class,'member_id');
    }
}
