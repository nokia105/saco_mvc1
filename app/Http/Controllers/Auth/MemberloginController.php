<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class MemberloginController extends Controller
{
    //


   /*    public function __construct(){

     	$this->middleware('guest:member');
     }*/


      public function showLoginForm()

      {
      	 return view('member.login');
      }


        public function login(Request $request){

        	 //validate form 
        	$this->validate($request,[
                      
                    'email'=>'required|email',
                    'password'=>'required|min:6' 
        	]);

                 //dd(auth());
             

                  //dd($password=Hash::make($request->password));



        	 if(Auth::guard('member')->attempt([

                 'email'=>$request->email,
                 'password'=>$request->password,
        	 ])){
                 $user=Auth::guard('member')->user();

       if($user->hasAnyRole(Role::all())){

             return redirect()->intended('/');
          }else{
               $id=Auth::guard('member')->user()->member_id;
            return redirect()->intended('/member/'.$id.'/profile');
          }
        	 }else{

        	 	 return redirect()->back()->withInput($request->only('email','remember'));
        	 }
                   
        }


       
}
