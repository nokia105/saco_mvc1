<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
function __construct(){

       return $this->middleware('auth:member');
     }

      public function index(){

   
        return view('admin.index');

      }
}
