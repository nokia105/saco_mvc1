<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Code;
use App\Insurance;
use App\Loaninsuarance;
use App\Loan;
use App\Memberaccount;
use App\payment;
use App\LoanCategory;  
use App\Feescategory;
use App\Interestmethod;
class MemberinfoController extends Controller
{
    //



  public function __construct(){

  	 return $this->middleware('auth:member');
  }
    public function dashboard($id){

     return view('member.dashboard');
    }  


    public function savings($id){

    	 $member=Member::find($id);

    	 return view('member.info.savings',compact('member'));
    }

      public function allsavings($id){


            $allmembersavings=Member::findorfail($id)->savingamount;
    
           return view('member.info.allsavings',compact('allmembersavings'));

      }


     public function shares($id){

    	 $member=Member::find($id);

    	 return view('member.info.shares',compact('member'));
    }

      public function allshares($id){

          $allmembershares=Member::findorfail($id)->no_shares;
          
          return view('member.info.allshares',compact('allmembershares'));
      }

    	 
    public function collaterals($id){

          $member=Member::find($id);

    	 return view('member.info.collaterals',compact('member'));	
    }

      public function payments($id){



        $loanstrasactions=Member::find($id)->loan_payment;

         $sharetrasactions=Member::find($id)->share_payment;
         $savingtrasactions=Member::find($id)->saving_payment;
         $regfeetransactions=Member::find($id)->regfee_payment;
        // $loanfeestransactions=Member::find($id)->loanlist->where('loan');

           //  dd($loanfeestransactions);

           $member=Member::find($id);

           $code=Memberaccount::where('name','=','Loan Account')->first()->account_no;

           $sharecode=Memberaccount::where('name','=','Share Account')->first()->account_no;

           $savingcode=Memberaccount::where('name','=','Saving Account')->first()->account_no;


          return view('member.info.payments',compact('loanstrasactions','code','sharecode','sharetrasactions','savingcode','savingtrasactions','regfeetransactions','member'));
      }

       public function apply_loan(){


            
          $loancategories=LoanCategory::select('id','category_name')->get();
                      $fees=Feescategory::all()->where('fee_name','!=','Registration fee');
                     $interestmethods=Interestmethod::all();
         return view('member.info.apply_loan',compact('loancategories','fees','interestmethods'));
       }

         

    public function loans($id){
      
        $memberloans=Member::find($id)->loanlist->where('loan_status','=','paid');
       $code=Memberaccount::where('name','=','Loan Account')->first()->account_no;

    	return view('member.info.loans',compact('memberloans','code','id'));	

    }

    public function loan_info($id,$lid){

      

       $loan=Loan::find($lid);

            $loancollaterals=Loan::find($lid)->collaterals;
               
               $loanguarantors=Loan::find($lid)->guarantor;

               $insurance=Insurance::first();

               $loanfees=Loan::find($lid)->loan_fees;
         

         $code=Memberaccount::where('name','=','Loan Account')->first()->account_no;


          return view('member.info.loan_info',compact('loan','code','lid','id','loancollaterals','loanguarantors','insurance','loanfees'));
  
    }


     public function profile($id){

          $member=Member::find($id);

           return view('member.info.profile',compact('member'));
     }


      public function picture_update(Request $request, $id){

             
             $this->validate($request,[
                  
                  'file'=>'required|'
             ]);

            $file_upload=$request->file('file');

            $filename=time() . '.' . $file_upload->getClientOriginalName();
          
             $file_upload->move('uploads/profileimages',$filename);
             $member=Member::find($id);
             $member->member_image=$filename;
             $member->save();

              return back();
      }

      public function password_modal($id){
              

        return view('member.info.password_modal',compact('id'));
      }


       public function pass_change(Request $request,$id){

                   $oldpass=$request->oldpassword;
                   $newpass=$request->password;
                   $confirm=$request->paswword_confirmation;

                   $member=Member::find($id);
                   //member password comparison
                   $currentpass=$member->password;

                    $validation=$this->validate($request,[
                          'oldpassword'=>'required',
                          'password' => 'required|confirmed|min:6' 
                    ]);
                         if($validation->fails()){
                            //return errors password does not match
                             return Response::json(array(
        'success' => false,
        'errors' => $validator->getMessageBag()->toArray()

    ), 400);

                         }else{


                       if($oldpassword==$currentpass){
                        
                           $member->password=bcrypt($newpass);
                            $member->save();

                              return Response::json([
                                   'errors'=>false,
                                    'sucess'=>'Sucessfully password changed'
                              ]);

                       }else{
                      
                            return Response::json([
                               
                               'errors'=>'Please enter old password Corrently'
                            ]);
                       }
                     

                     }

       }
}
