<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //  


    function __construct(){

       return $this->middleware('auth:member');
     }




        public function index()
    {
        return view('dashboard.template');
    }
/*
    public function dashboard_chair(){


    	  return view('dashboard.chair');
    }


    public function dashboard_loanofficer(){


    	 return view('dashboard.loanofficer');
    }

    public function dashboard_cashier(){


    	 return view('dashboard.cashier');
    }

    public function dashboard_accountant(){


    	  return view('dashboard.accountant');
    }*/
}
