<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Monthsavingshare;
use App\Membersaving;
use App\Share;
use App\Mainaccount;
use App\Payment;
use App\Journalentry;
use App\Bankaccount;
use App\Payableaccount;
use App\Receivableaccount;
use App\Repayment;
use App\Loanaccount;
use Auth;
use App\Member_share;

class PaymentsController extends Controller
{
    //



   function __construct(){

       return $this->middleware('auth:member');
     }


     public function allpayments(){


                   //
                           //query should accomodate and loanschedule 

     $members=Member::where('status','active')->whereHas('monthsavingshare', function ($query) {
        $curentdate=explode('-',date('Y-m-d'));
              $year=$curentdate[0];
             $month=$curentdate[1];

    $query->whereMonth('date',$month)->whereYear('date',$year)->where('saving_status','!=','paid')->orWhere('share_status','!=','paid');
})->get();
    
       //members whose status in monthsavingshare table is equel not eqiel to paid
       //members whose status in loan schedule of that or priviors month is either incomplite or unpaid 


     	 return view('Payment.allmonthpayment',compact('members'));  
     }


      public function printallmember_topay(Request $request){


      	    $array=explode(',', $request->array);

      	     $members=Member::find($array);

           foreach($members as $member){
      	     echo '<tr>
           
      
    <td>'.$member->registration_no.'</td>
    <td>'.ucfirst($member->first_name).' '.ucfirst($member->last_name) .' '. ucfirst($member->middle_name).'  </td>
    <td>'.number_format($share=$member->monthshare,2).'</td>
    <td>'.number_format($saving=$member->monthsaving,2).'</td>
     

     <td>'.number_format($interest=0.00,2).'</td>
     <td>'.number_format($principle=0.00,2).'</td>
     <td>'.number_format($share+$saving+$interest+$principle,2).'</td>

    </tr>';

        //to be complited
      }

  }


    public function pay_allmembers(Request $request){

         
               $array=$request->array;

               $numbers=array_filter($array,function($number){
                            
                      return intval($number);
                } );

                       $bankaccount=Mainaccount::where('name','=','Bankaccount')->first();




                       $members=\App\Member::find($numbers);
                       $curentdate=explode('-',date('Y-m-d'));
                       $year=$curentdate[0];
                       $month=$curentdate[1];

                     foreach($members as $member){

                              
                    

                         $membermonthsaving=$member->monthsaving;
                         $membermonthshare=$member->monthshare;
                         $shareaccount=$member->memberaccount->where('name','Share Account')->first();
                         $mainshare=Mainaccount::where('name','=','Share Account')->first();
                        /*$membersavingalready=$member->savingamount->whereYear('saving_date',$year)->whereMonth('saving_date',$month)->sum('amount'); this query we assume their incomplite payment*/

                          //membersaving account id
                             $savingaccount=$member->memberaccount->where('name','Saving Account')->first();
                             $mainsaving=Mainaccount::where('name','=','Saving Account')->first();

                                if(count($member->loanschedule)){   
                              $loan_schedule=$member->loanschedule()->whereMonth('duedate',$month)->whereYear('duedate',$year)->first();
                                       }

                          $saving=Membersaving::create([
                               'member_id'=>$member->member_id,
                               'saving_code'=>1111,
                               'amount'=>$membermonthsaving,
                               'saving_date'=>date('Y-m-d'),
                               'user_id'=>Auth::guard('member')->user()->member_id
                            ]);

                              $share=Member_share::create([
                               'member_id'=>$member->member_id,
                               'amount'=>$membermonthshare,
                               'No_shares'=>($membermonthshare/Share::sum('share_value')),
                               'share_date'=>date('Y-m-d'),
                               'user_id'=>Auth::guard('member')->user()->member_id
                             ]);

                             $payment=Payment::create([
                                      'membersaving_id'=>$saving->id,  
                                      'member_share_id'=>$share->id,  
                                      'loan_id'=>(count($member->loanschedule))? $member->$loan_schedule->loan->id :' ',
                                      'amount'=>(count($member->loanschedule))? $membermonthinterest+$membermonthprinciple+$membermonthsaving+$membermonthshare : $membermonthsaving+$membermonthshare,
                                      'narration'=>'Member Month Payment',
                                      'paid_by'=>Auth::guard('member')->user()->member_id,  //loan payment verificat
                                      'payment_type'=>'salary',
                                      'state'=>'in',
                                      'date'=>date('Y-m-d')
                                         ]);

                          
                                  Bankaccount::create([
                                       'dr'=>$membermonthsaving,
                                        'mainaccount_id'=>$mainsaving->id,
                                        'memberaccount_id'=>$savingaccount->id,
                                        'description'=>'saving',
                                         'date'=>date('Y-m-d')
                                            
                                      ]);

                                      /* Payableaccount::create([
                                       'membersaving_id'=>$saving->id,
                                       'cr'=>$request->payment,
                                       'date'=>date('Y-m-d')
                                       ]);*/
                                      

                                       //jornal dr main saving account
                               Journalentry::create( [
                                             'cr'=>$membermonthsaving, 
                                             'mainaccount_id'=>$mainsaving->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'saving']); 

                                  //jornal dr member saving account

                                        Journalentry::create( [
                                             'dr'=>$membermonthsaving, 
                                             'memberaccount_id'=>$savingaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'saving']); 


                                         //shares time
                       

                              

                         


                                   Bankaccount::create([
                                       'dr'=>$membermonthshare,
                                        'mainaccount_id'=>$mainshare->id,
                                        'memberaccount_id'=>$shareaccount->id,
                                        'description'=>'share',
                                         'date'=>date('Y-m-d')
                                            
                                      ]);

                                       Payableaccount::create([
                                       'member_share_id'=>$share->id,
                                       'cr'=>$membermonthshare,
                                       'date'=>date('Y-m-d')
                                       ]);

                                       Journalentry::create( [
                                             'cr'=>$membermonthshare, 
                                             'mainaccount_id'=>$mainshare->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'share']); 

                                  //jornal dr member share account

                                        Journalentry::create( [
                                             'dr'=>$membermonthshare, 
                                             'memberaccount_id'=>$shareaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'share']); 
                       
                                    //loan schedule

                                 $membermonthsavingshare=$member->monthsavingshare()->whereMonth('date',$month)->whereYear('date',$year)->first();
                                 $membermonthsavingshare->saving_status='paid';
                                 $membermonthsavingshare->share_status='paid';
                                 $membermonthsavingshare->save();
                               

                                     if(count($member->loanschedule)){           
                        $membermonthinterest=$loan_schedule->sum('monthinterest');
                        $membermonthprinciple=$loan_schedule->sum('monthprinciple');
                        $main_interestaccount=Mainaccount::where('name','=','Interest Account')->first();
                       $member_interestaccount=Memberaccount::where('name','=','$member_interestaccount')->first();
                       $main_loanaccount=Mainaccount::where('name','=','Loan Account')->first();
                       $member_loanaccount=Memberaccount::where('name','=','Loan Account')->first();

                                                
                             $repayment=Repayment::create([
                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=> $membermonthprinciple,
                                                                  'interestpayed'=>$membermonthinterest,
                                                                  'amountpayed'=>$membermonthinterest+$membermonthprinciple,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id

                                                             ]);  

                                                          //$newamount=0;
                                                           
                                                           $repayment->monthrepayment()->attach($loan_schedule->id);
                                                            $loan_schedule->status='paid';
                                                            $loan_schedule->save();

                                             //work out all this
                                        Bankaccount::create([

                                  'memberaccount_id'=>$member_loanaccount->id,
                                  'mainaccount_id'=>$main_loanaccount,
                                  'dr'=> $membermonthprinciple,
                                  'description'=>'loan',
                                  'date'=>date('Y-m-d')
                                      ]); 

                                     // dr bankaccount

                                       Loanaccount::create([
                                       'memberaccount_id'=>$member_loanaccount->id,
                                       'mainaccount_id'=>$bankaccount->id,
                                       'dr'=>$membermonthprinciple,
                                       'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                    ]);

                                          //interest account

                                       Bankaccount::create([

                                  'mainaccount_id'=>$main_interestaccount->id,
                                  'memberaccount_id'=>$member_interestaccount->id,
                                  'dr'=>$membermonthinterest,
                                  'description'=>'interest',
                                  'date'=>date('Y-m-d')
                                      ]);

                                       //loan  account receivable 

                                      Receivableaccount::create([
                                     'cr'=>$membermonthprinciple,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$member_loanaccount->id,
                                      'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                   ]);

                                              //interest in receivable

                                       Receivableaccount::create([
                                     'cr'=>$membermonthinterest,
                                     'memberaccount_id'=>$member_interestaccount->id,
                                      'mainaccount_id'=>$bankaccount->id,
                                      'description'=>'interest',
                                       'date'=>date('Y-m-d')
                                   ]);

                                            //store in jornal table 


                                                            //principle main
                                                Journalentry::create(
                                               [
                               
                                             'dr'=>$membermonthprinciple, 
                                             'mainaccount_id'=>$bankaccount->id,
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'loan']
                                   
                                                  ); 

                                                  //principle member

                                             Journalentry::create( [
                                             'cr'=>$membermonthprinciple, 
                                             'memberaccount_id'=>$member_loanaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'loan']); 

                                                      //interst main
                                                  Journalentry::create([
                                             'dr'=>$membermonthinterest, 
                                             'mainaccount_id'=>$bankaccount->id,//$main_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']); 

                                                   // interest member

                                                   Journalentry::create([
                                             'cr'=>$membermonthinterest, 
                                             'memberaccount_id'=>$member_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']);

                                             
                                                    }              

                     }  


                       return response()->json(['success'=>'successfully Posted']); 


          
   
    }



      public function payment_list(){


          $payments=Payment::orderBy('date','desc')->get();




         return view('payment.payment_list',compact('payments'));
      }


}
 
  /*<td>'.$interest=$member->loan->loanschedule->whereMonth('duedate','<=',$month)->whereYear('duedate','<=',$year)->where('status','=','!paid')->sum('monthinterest').'</td>
    <td>'.$principle=$member->loan->loanschedule->where('status','=','unpaid')->whereMonth('duedate',$month)->whereYear('duedate',$year)->sum('monthprinciple').'</td>
    <td>'.number_format($share+$saving+$interest+$principle,2).'</td>*/