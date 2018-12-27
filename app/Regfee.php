<?php

namespace App;


class Regfee extends Model
{
    //


    public function member(){

              return $this->belongsTo(Member::class,'member_id');
        }
}
