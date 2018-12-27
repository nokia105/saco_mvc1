<?php

namespace App;


class Voucher extends Model
{
    //


    public $timestamps = false;

    public function loan(){

    	return $this->belongsTo(Loan::class);
    }


    public function memberaccount(){

    	 return $this->belongsTo(Memberaccount::class);
    }

    public function mainaccount(){

    	 return $this->belongsTo(Mainaccount::class);
    }
}
