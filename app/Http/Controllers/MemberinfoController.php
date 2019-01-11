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
use App\Share;
use Carbon\Carbon;
use Auth;
use App\Mail\Guarantors;
use App\Mail\Cashier_draft;
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

       public function apply_loan($id){
                       $totalsumloan=0;
                       $sumpaidamount=0;
              $member=Member::find($id);
              $savings=$member->savingamount->where('state','in')->sum('amount')-$member->savingamount->where('state','out')->sum('amount');
               $lastloans=$member->loans->where('loan_status','repayment');
                foreach($lastloans as $lastloan){
                    $totalsumloan+=$lastloan->principle;

                    $sumpaidamount+=$lastloan->loanrepayment->sum('principlepayed');  
                }
                 
                    $remaidloan=$totalsumloan-$sumpaidamount;
                              if($remaidloan>1000){
                $loanallowed=3*$savings-$remaidloan;
             }else{
             $loanallowed=3*$savings;  
       }
          $loancategories=LoanCategory::select('id','category_name')->get();
                      $fees=Feescategory::all()->where('fee_name','!=','Registration fee');
                     $interestmethods=Interestmethod::all();
                     $code=Memberaccount::where('name','=','Loan Account')->first()->account_no;
         return view('member.info.apply_loan',compact('loancategories','fees','interestmethods','loanallowed','lastloans','code'));
       }

       public function store_appliedloan(Request $request){



           $member_id=$request->memberid;
            $pcategory_id=$request->pcategory;
            $principle=$request->principle;
            $loanperiod=$request->period;

            $startpayment=$request->startpayment;
             //colateral from js field  
            $collate_id=$request->collate;
            $guarator_id=$request->guarantor;

             $guarantors=Member::find($guarator_id);

               $totalsumloan=0;
                       $sumpaidamount=0;
              $member=Member::find($member_id);
              $savings=$member->savingamount->where('state','in')->sum('amount')-$member->savingamount->where('state','out')->sum('amount');
               $lastloans=$member->loans->where('loan_status','repayment');
                foreach($lastloans as $lastloan){
                    $totalsumloan+=$lastloan->principle;

                    $sumpaidamount+=$lastloan->loanrepayment->sum('principlepayed');  
                }
                 
                    $remaidloan=$totalsumloan-$sumpaidamount;
       

                
                $validator=$this->validate(request(),[
                 'pcategory'=>'required',
                 'principle'=>'required|numeric',
                 'period'=>'required|numeric',
                 'startpayment'=>'required|date',
                 'narration'=>'required',
                ]);


                  $charges=Feescategory::where('fee_name','!=','Registration fee')->pluck('id');
              
                  $member=Member::find($member_id);

                    $no_shares=$member->no_shares->where('state','in')->sum('No_shares')-$member->no_shares->where('state','out')->sum('No_shares');
                
                    $max_shares=Share::select('max_shares')->first()->max_shares; 

                    $totalsaving=$member->savingamount->where('state','in')->sum('amount')- $member->savingamount->where('state','out')->sum('amount');
                   

                    $differ_register_days=$member->joining_date->diffInDays(Carbon::now());
                    $insurance=Insurance::first()->percentage_insurance; //since we had only one 

                          $interest=0.83;

                          $guarantors=Member::find($guarator_id);

                         if($no_shares==$max_shares){

                   if($request->has('collate')){
                      
                  $totalcollateral_value=Collateral::find($collate_id)->sum('colateral_value');

                   if($remaidloan>1000){
                $loanallowed=$totalcollateral_value-$remaidloan;
             }else{
             $loanallowed=$totalcollateral_value;  
       }

                   if($principle<=80/100*$loanallowed){
                            
                             $loan=Loan::create([
                            'request_date'=>date('Y-m-d'),
                            'loan_status'=>'waiting guarator',
                            'loancategory_id'=>$pcategory_id,
                            'member_id'=>$member_id,
                            'duration'=>$loanperiod,
                            'interestmethod_id'=> 1,
                            'interest'=>$interest,
                            'principle'=>$principle,
                            'repayment_date'=>$startpayment,
                            'no_of_installments'=>$loanperiod,
                            'mounthlyrepayment_amount'=>($principle/$loanperiod)+(($interest/100)*$principle)/$loanperiod,//total monthly pricinple+m.niterest+other changes 1month
                            'mounthlyrepayment_principle'=>$principle/$loanperiod, 
                           'mounthlyrepayment_interest'=>(($interest/100)*$principle)/$loanperiod,
                           'narration'=>$request->narration,
                           'insurance_id'=>Insurance::first()->id
               ]);
                                    $loan->collaterals()->attach($collate_id);
                                    $loan->guarantor()->attach( $guarator_id);
                                    $loan->loan_fees()->attach($charges);

                                      foreach($guarantors as $member){
                                       
                                           \Mail::to($member)->send(new Guarantors($member,$loan)); 
                                      }

                                               if($request->submit){
                                             return back()->with('status','Successfully Submitted');

                                              }else{

                                                return back()->with('status','Success! Saved to draft');

                                              }         

                   }

                                            return back()->with('error','You asked for a loan which is grater than your allowed amount '.number_format($loanallowed,2). ' Tshs' )->withInput();
                   }else{
                  
                    // $totalsaving=Member::find($member_id)->savingamount->sum('amount');
                                           if($remaidloan>1000){
                $loanallowed=3*$savings-$remaidloan;
             }else{
             $loanallowed=3*$savings;  
       }

                    if($principle<=$loanallowed){

                $loan=Loan::create([

                            'request_date'=>date('Y-m-d'),
                            'loan_status'=>'waiting guarator',
                            'loancategory_id'=>$pcategory_id,
                            'member_id'=>$member_id,
                            'duration'=>$loanperiod,
                            'interestmethod_id'=>1,
                            'interest'=>$interest,
                            'principle'=>$principle,
                            'repayment_date'=>$startpayment,
                            'no_of_installments'=>$loanperiod,
                            'mounthlyrepayment_amount'=>($principle/$loanperiod)+(($interest/100)*$principle)/$loanperiod,//total monthly pricinple+m.niterest+other changes 1month
                            'mounthlyrepayment_principle'=>$principle/$loanperiod, 
                           'mounthlyrepayment_interest'=>(($interest/100)*$principle)/$loanperiod,
                            'narration'=>$request->narration,
                        
                           'insurance_id'=>Insurance::first()->id


               ]);
                  
              $loan->guarantor()->attach($guarator_id);
              $loan->loan_fees()->attach($charges);

                 foreach($guarantors as $member){
                                       
                 \Mail::to($member)->send(new Guarantors($member,$loan)); 
                                      }
                                     return back()->with('status','your loan is accepted');

              }  
                  

                                     return back()->with('error','You asked for a loan which is grater than your allowed amount '.number_format($loanallowed,2). ' Tshs' )->withInput();     

                   }

                   
                 }else{

                                     return back()->with('error','you must have 1000 shares in your account')->withInput();
                    }

                  
           }

             public function guarantor_approve($id){
               $code=Memberaccount::where('name','=','Loan Account')->first()->account_no;
            $loan=Loan::find($id);
                    
               return view('modal.guarantor_approve',compact('loan','code'));
             }

              public function save_guarantor_status($id,Request $request){
                       $loan=Loan::findorfail($id);
                        $member_id=Auth::guard('member')->user()->member_id;  
                        
                       $loan_guarantor=$loan->guarantor()->where('guarator_id','=',$member_id)->first();
                        $loan_guarantor->pivot->status=($request->submit=='approve') ? 'approved' :'rejected';
                        $loan_guarantor->pivot->reason=$request->reason;
                         $loan_guarantor->pivot->save();

                          $cashiers=Member::role('Cashier')->get();

                          //check if all coloumn in the guarantor reads approved send it to jane
                    
                        $numberguarantors_approved=$loan->guarantor()->where('loan_guarantor.status','=','approved')->count();

                              if($numberguarantors_approved >1){
                                   $loan->loan_status='draft';
                                 $loan->save();
                                 
                                 foreach($cashiers as $cashier){

                                   \Mail::to($cashier)->send(new Cashier_draft($cashier,$loan));   
                                 }
                              }
                   
                   return back()->with('status','Successfully ')->withInput();
                 }

             public function guarantor_reject($id){

              $code=Memberaccount::where('name','=','Loan Account')->first()->account_no;
            $loan=Loan::find($id);

              return view('modal.guarantor_reject',compact('loan','code'));
             }

    public function loans($id){
      
        $memberloans=Member::find($id)->loanlist->where('loan_status','=','paid');
       $code=Memberaccount::where('name','=','Loan Account')->first()->account_no;

    	return view('member.info.loans',compact('memberloans','code','id'));	

    }

      public function guarantor($id){

          $member=Member::findorfail($id);
           $code=Memberaccount::where('name','=','Loan Account')->first()->account_no;

           $loanguarantors=$member->loanguarantor->where('loan_status','=','waiting guarantor');

       return view('member.info.guarantor',compact('loanguarantors','code'));
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
