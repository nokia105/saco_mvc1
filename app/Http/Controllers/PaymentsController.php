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
use App\Memberaccount;
use App\Monthpaymentlist;
use App\Loanschedule;

class PaymentsController extends Controller
{
    //



   function __construct(){

       return $this->middleware('auth:member');
     }


     public function allpayments(){
           // $member=Member::find(3);

         //$loans=$member->loans->where('loan_status','repayment');
              $curentdate=explode('-',date('Y-m-d'));
                       $year=$curentdate[0];
                       $month=$curentdate[1];

  $monthpaymentlists=Monthpaymentlist::whereYear('date',$year)->whereMonth('date',$month)->where('status','!=','paid')->get();

     	 return view('Payment.allmonthpayment',compact('monthpaymentlists'));  
     }

      public function editpaymentlist($id){

      $paymentlist=Monthpaymentlist::findorfail($id);
          return view('modal.editpaymentlist',compact('paymentlist'));
      }

       public function posteditpaymentlist($id,Request $request){

         
         Monthpaymentlist::find($id)->update([
                   'shares'=>$request->shares,
                   'savings'=>$request->savings,
                   'current_loan'=>$request->current_loan,
                  'previous_loan'=>$request->previous_loan
         ]); 

             return redirect()->route('allpayments');

                   }


      public function printallmember_topay(Request $request){


      	    $array=explode(',', $request->array);

            $numbers=array_filter($array,function($number){
                            
                      return intval($number);
                } );

                $curentdate=explode('-',date('Y-m-d'));
                $year=$curentdate[0];
                $month=$curentdate[1];

        $monthpaymentlists=Monthpaymentlist::whereIn('member_id',[$numbers])->whereYear('date',$year)
        ->whereMonth('date',$month)->where('status','!=','paid')->get(); 
             
            

           foreach($monthpaymentlists as $monthpaymentlist){
      	     $html= '<tr>
           
      
    <td>'.$monthpaymentlist->member->registration_no.'</td>
 <td>'.ucfirst($monthpaymentlist->member->first_name).' '.ucfirst($monthpaymentlist->member->last_name) .' '. ucfirst($monthpaymentlist->member->middle_name).'  </td>';
          

            
    $html .='<td>'.number_format($share=$monthpaymentlist->shares,2).'</td>';
            
  
             $html .='<td>'.number_format($savings=$monthpaymentlist->savings,2).'</td>
                <td>'.number_format($c_loan=$monthpaymentlist->current_loan,2).'</td>
                <td>'.number_format($p_loan=$monthpaymentlist->previous_loan,2).'</td>
                <td>'.number_format(($share+$savings+$c_loan+$p_loan),2).'</td>
                <td>'.strtoupper($monthpaymentlist->status).'</td>';
   $html .= '</tr>';

     echo $html;

        //to be complited
      }

  }


    public function pay_allmembers(Request $request){

         

               $array=$request->array;

              /* $numbers=array_filter($array,function($number){
                            
                      return intval($number);
                } );*/



                       $bankaccount=Mainaccount::where('name','=','Bank Account')->first();
                       $members=\App\Member::find($array);
                       $curentdate=explode('-',date('Y-m-d'));
                       $year=$curentdate[0];
                       $month=$curentdate[1];
                       $previousmonth=date('Y-m-d', strtotime(date('Y-m-01')." -10 month"));
                       //dd($previousmonth);
                        $lastdateofcurrentmonth=date("Y-m-t", strtotime(date('Y-m-d'))); 
                      //$members=array($members); 
                     foreach($members as $member){
                               
                  $member_loanaccount=$member->memberaccount->where('name','Loan Account')->first();
             
                  $member_interestaccount=$member->memberaccount->where('name','Interest Account')->first();
                  $main_loanaccount=Mainaccount::where('name','=','Loan Account')->first();
                   $main_interestaccount=Mainaccount::where('name','=','Interest Account')->first();
             

         $sharebalance=Monthpaymentlist::whereIn('member_id',[$member->member_id])
         ->whereMonth('date',$month)->whereYear('date',$year)->sum('shares');
           $savingbalance=Monthpaymentlist::whereIn('member_id',[$member->member_id])
           ->whereMonth('date',$month)->whereYear('date',$year)->sum('savings');
                //loan
            $current_loan=Monthpaymentlist::whereIn('member_id',[$member->member_id])
            ->whereMonth('date',$month)->whereYear('date',$year)->sum('current_loan');
            $previous_loan=Monthpaymentlist::whereIn('member_id',[$member->member_id])
            ->whereMonth('date',$month)->whereYear('date',$year)->sum('previous_loan');
              
            $balance= $current_loan+$previous_loan;
            $member_loans=Member::find($member->member_id)->loanlist->where('loan_status','=','repayment');     
            $loanscheduleid=$member_loans->pluck('id');
            //get all schedules
  $loanschedules=Loanschedule::whereIn('loan_id',[$loanscheduleid])->where('status','unpaid')
->whereBetween('duedate',[$previousmonth,$lastdateofcurrentmonth])->orWhere('status','=','incomplite')->get();

            foreach($loanschedules as $loanschedule){
              $schedule_principle=$loanschedule->monthprinciple;
              $schedule_interest=$loanschedule->monthinterest;

               $payment=Payment::create([
             'loan_id'=>$loanschedule->loan->id,
              'amount'=>$balance,
              'narration'=>'loan',
              'paid_by'=>Auth::guard('member')->user()->member_id,  //loan payment verificat
              'payment_type'=>'salary',
              'state'=>'in',
              'date'=>date('Y-m-d')
                 ]);

                 switch ($loanschedule->status) {
                  case "incomplite":
                        $paid_principle=$loanschedule->monthrepayment->sum('principlepayed');
                        $paid_interest=$loanschedule->monthrepayment->sum('interestpayed');
                         switch (true) {
                            case $paid_interest < $schedule_interest:
                                  $interest_to_pay=$schedule_interest-$paid_interest;
                                    if($balance>=$interest_to_pay)
                                    {
                                       //pay iintersest
                                         $repayment=Repayment::create([
                                                    'loanschedule_id'=>$loanschedule->id,
                                                    'principlepayed'=> 0,
                                                    'interestpayed'=>$interest_to_pay,
                                                    'amountpayed'=>$interest_to_pay,
                                                    'payment_id'=>$payment->id,
                                                    'paymentdate'=>date('Y-m-d H:i:s'),
                                                    'user_id'=>Auth::guard('member')->user()->member_id
                                               ]);
                                         ///post to bank
                                                Bankaccount::create([
                                                'mainaccount_id'=>$main_interestaccount->id,
                                                'memberaccount_id'=>$member_interestaccount->id,
                                                'dr'=>$interest_to_pay,
                                                'description'=>'interest',
                                                'date'=>date('Y-m-d'),
                                                'payment_id'=>$payment->id
                                               ]);  

                                               Receivableaccount::create([
                                               'cr'=>$interest_to_pay,
                                               'memberaccount_id'=>$member_interestaccount->id,
                                                'mainaccount_id'=>$bankaccount->id,
                                                'description'=>'interest',
                                                 'date'=>date('Y-m-d'),
                                                 'payment_id'=>$payment->id
                                                ]);     
                                      $balance=$balance-$interest_to_pay;

                                    }
                                    else {
                                       //pay iintersest
                                         $repayment=Repayment::create([
                                                    'loanschedule_id'=>$loanschedule->id,
                                                    'principlepayed'=> 0,
                                                    'interestpayed'=>$balance,
                                                    'amountpayed'=>$balance,
                                                    'payment_id'=>$payment->id,
                                                    'paymentdate'=>date('Y-m-d H:i:s'),
                                                    'user_id'=>Auth::guard('member')->user()->member_id
                                               ]);
                                         ///post to bank
                                                Bankaccount::create([
                                                'mainaccount_id'=>$main_interestaccount->id,
                                                'memberaccount_id'=>$member_interestaccount->id,
                                                'dr'=>$balance,
                                                'description'=>'interest',
                                                'date'=>date('Y-m-d'),
                                                'payment_id'=>$payment->id
                                               ]);  

                                               Receivableaccount::create([
                                               'cr'=>$interest_to_pay,
                                               'memberaccount_id'=>$member_interestaccount->id,
                                                'mainaccount_id'=>$bankaccount->id,
                                                'description'=>'interest',
                                                 'date'=>date('Y-m-d'),
                                                 'payment_id'=>$payment->id
                                                ]);     
                                           $balance=$balance-$balance;
                                    }

                                break;
                          
                            case $paid_principle < $schedule_principle:
                                  $principle_to_pay=$schedule_principle-$paid_principle;
                                    if($balance >= $principle_to_pay)
                                    {
                                       //pay iintersest
                                         $repayment=Repayment::create([
                                                    'loanschedule_id'=>$loanschedule->id,
                                                    'principlepayed'=> $principle_to_pay,
                                                    'interestpayed'=>0,
                                                    'amountpayed'=>$principle_to_pay,
                                                    'payment_id'=>$payment->id,
                                                    'paymentdate'=>date('Y-m-d H:i:s'),
                                                    'user_id'=>Auth::guard('member')->user()->member_id
                                               ]);
                                         ///post to bank
                                                Bankaccount::create([
                                                'mainaccount_id'=>$main_interestaccount->id,
                                                'memberaccount_id'=>$member_interestaccount->id,
                                                'dr'=>$principle_to_pay,
                                                'description'=>'principle',
                                                'date'=>date('Y-m-d'),
                                                'payment_id'=>$payment->id
                                               ]);
                                                Loanaccount::create([
                                                   'memberaccount_id'=>$member_loanaccount->id,
                                                   'mainaccount_id'=>$bankaccount->id,
                                                   'cr'=>$principle_to_pay,
                                                   'description'=>'loan',
                                                   'date'=>date('Y-m-d'),
                                                   'payment_id'=>$payment->id
                                                ]);  

                                               Receivableaccount::create([
                                               'cr'=>$principle_to_pay,
                                               'memberaccount_id'=>$member_interestaccount->id,
                                                'mainaccount_id'=>$bankaccount->id,
                                                'description'=>'principle',
                                                'date'=>date('Y-m-d'),
                                                 'payment_id'=>$payment->id
                                                ]); 

                                                // $repayment->monthrepayment()->attach($loan_schedule->id);
                                         $loanschedule->status='paid';
                                         $loanschedule->save();

                                      $balance=$balance-$principle_to_pay;
                                    }
                                    else {
                                       //pay principle
                                         $repayment=Repayment::create([
                                                    'loanschedule_id'=>$loanschedule->id,
                                                    'principlepayed'=> $balance,
                                                    'interestpayed'=>0,
                                                    'amountpayed'=>$balance,
                                                    'payment_id'=>$payment->id,
                                                    'paymentdate'=>date('Y-m-d H:i:s'),
                                                    'user_id'=>Auth::guard('member')->user()->member_id
                                               ]);
                                         ///post to bank
                                                Bankaccount::create([
                                                'mainaccount_id'=>$main_interestaccount->id,
                                                'memberaccount_id'=>$member_interestaccount->id,
                                                'dr'=>$balance,
                                                'description'=>'interest',
                                                'date'=>date('Y-m-d'),
                                                'payment_id'=>$payment->id
                                               ]); 
                                                Loanaccount::create([
                                                   'memberaccount_id'=>$member_loanaccount->id,
                                                   'mainaccount_id'=>$bankaccount->id,
                                                   'cr'=>$balance,
                                                   'description'=>'loan',
                                                   'date'=>date('Y-m-d'),
                                                   'payment_id'=>$payment->id
                                                ]);  

                                               Receivableaccount::create([
                                               'cr'=>$interest_to_pay,
                                               'memberaccount_id'=>$member_interestaccount->id,
                                                'mainaccount_id'=>$bankaccount->id,
                                                'description'=>'interest',
                                                 'date'=>$balance,
                                                 'payment_id'=>$payment->id
                                                ]);     
                                           $balance=$balance-$balance;
                                    }

                                break;
                            default:
                                $balance=$balance;
                                break;
                                      }
         case "unpaid":
             $total_to_pay=$loanschedule->monthprinciple+$loanschedule->monthinterest;
              $interest_to_pay=$loanschedule->monthinterest;
              $principle_to_pay=$loanschedule->monthprinciple;
              switch (true) {
                            case $balance >= $total_to_pay:
                                 
                                   
                                       //pay iintersest
                                         $repayment=Repayment::create([
                                                    'loanschedule_id'=>$loanschedule->id,
                                                    'principlepayed'=>$principle_to_pay,
                                                    'interestpayed'=>$interest_to_pay,
                                                    'amountpayed'=>$total_to_pay,
                                                    'payment_id'=>$payment->id,
                                                    'paymentdate'=>date('Y-m-d H:i:s'),
                                                    'user_id'=>Auth::guard('member')->user()->member_id
                                               ]);
                                         ///post to bank
                                                Bankaccount::create([
                                                'mainaccount_id'=>$main_interestaccount->id,
                                                'memberaccount_id'=>$member_interestaccount->id,
                                                'dr'=>$interest_to_pay,
                                                'description'=>'interest',
                                                'date'=>date('Y-m-d'),
                                                'payment_id'=>$payment->id
                                               ]); 
                                                   Bankaccount::create([
                                                'mainaccount_id'=>$main_interestaccount->id,
                                                'memberaccount_id'=>$member_interestaccount->id,
                                                'dr'=>$principle_to_pay,
                                                'description'=>'principle',
                                                'date'=>date('Y-m-d'),
                                                'payment_id'=>$payment->id
                                               ]); 

                                               Receivableaccount::create([
                                               'cr'=>$interest_to_pay,
                                               'memberaccount_id'=>$member_interestaccount->id,
                                                'mainaccount_id'=>$bankaccount->id,
                                                'description'=>'interest',
                                                 'date'=>date('Y-m-d'),
                                                 'payment_id'=>$payment->id
                                                ]);  

                                                    Loanaccount::create([
                                                   'memberaccount_id'=>$member_loanaccount->id,
                                                   'mainaccount_id'=>$bankaccount->id,
                                                   'cr'=>$principle_to_pay,
                                                   'description'=>'loan',
                                                   'date'=>date('Y-m-d'),
                                                   'payment_id'=>$payment->id
                                                ]);  

                                               Receivableaccount::create([
                                               'cr'=>$principle_to_pay,
                                               'memberaccount_id'=>$member_interestaccount->id,
                                                'mainaccount_id'=>$bankaccount->id,
                                                'description'=>'principle',
                                                'date'=>date('Y-m-d'),
                                                 'payment_id'=>$payment->id
                                                ]);  

                                            $loanschedule->status='paid';
                                         $loanschedule->save();

                                      $balance=$balance-$total_to_pay;

                                break;

                            case $balance< $total_to_pay :

                                       if($balance<$interest_to_pay){

                                      $repayment=Repayment::create([
                                                    'loanschedule_id'=>$loanschedule->id,
                                                    'principlepayed'=> 0,
                                                    'interestpayed'=>$balance,
                                                    'amountpayed'=>$balance,
                                                    'payment_id'=>$payment->id,
                                                    'paymentdate'=>date('Y-m-d H:i:s'),
                                                    'user_id'=>Auth::guard('member')->user()->member_id
                                               ]);
                                         ///post to bank
                                                Bankaccount::create([
                                                'mainaccount_id'=>$main_interestaccount->id,
                                                'memberaccount_id'=>$member_interestaccount->id,
                                                'dr'=>$balance,
                                                'description'=>'interest',
                                                'date'=>date('Y-m-d'),
                                                'payment_id'=>$payment->id
                                               ]);  

                                               Receivableaccount::create([
                                               'cr'=>$balance,
                                               'memberaccount_id'=>$member_interestaccount->id,
                                                'mainaccount_id'=>$bankaccount->id,
                                                'description'=>'interest',
                                                 'date'=>date('Y-m-d'),
                                                 'payment_id'=>$payment->id
                                                ]);     
                                      $balance=$balance-$balance;
                                             
                                       }else{

                                        $repayment=Repayment::create([
                                                    'loanschedule_id'=>$loanschedule->id,
                                                    'principlepayed'=>($balance-$interest_to_pay),
                                                    'interestpayed'=>$interest_to_pay,
                                                    'amountpayed'=>$balance,
                                                    'payment_id'=>$payment->id,
                                                    'paymentdate'=>date('Y-m-d H:i:s'),
                                                    'user_id'=>Auth::guard('member')->user()->member_id
                                               ]);
                                         ///post to bank
                                                Bankaccount::create([
                                                'mainaccount_id'=>$main_interestaccount->id,
                                                'memberaccount_id'=>$member_interestaccount->id,
                                                'dr'=>$interest_to_pay,
                                                'description'=>'interest',
                                                'date'=>date('Y-m-d'),
                                                'payment_id'=>$payment->id
                                               ]); 
                                                   Bankaccount::create([
                                                'mainaccount_id'=>$main_interestaccount->id,
                                                'memberaccount_id'=>$member_interestaccount->id,
                                                'dr'=>($balance-$interest_to_pay),
                                                'description'=>'principle',
                                                'date'=>date('Y-m-d'),
                                                'payment_id'=>$payment->id
                                               ]); 

                                               Receivableaccount::create([
                                               'cr'=>$interest_to_pay,
                                               'memberaccount_id'=>$member_interestaccount->id,
                                                'mainaccount_id'=>$bankaccount->id,
                                                'description'=>'interest',
                                                 'date'=>date('Y-m-d'),
                                                 'payment_id'=>$payment->id
                                                ]);  

                                                    Loanaccount::create([
                                                   'memberaccount_id'=>$member_loanaccount->id,
                                                   'mainaccount_id'=>$bankaccount->id,
                                                   'cr'=>($balance-$interest_to_pay),
                                                   'description'=>'loan',
                                                   'date'=>date('Y-m-d'),
                                                   'payment_id'=>$payment->id
                                                ]);  

                                               Receivableaccount::create([
                                               'cr'=>($balance-$interest_to_pay),
                                               'memberaccount_id'=>$member_interestaccount->id,
                                                'mainaccount_id'=>$bankaccount->id,
                                                'description'=>'principle',
                                                'date'=>date('Y-m-d'),
                                                 'payment_id'=>$payment->id
                                                ]);  


                                            $loanschedule->status='incomplite';
                                         $loanschedule->save();
                                       $balance=0;


                                       }
                             

                                      }

          break;
default:
break;

}//switch case statment
                          //shares

                           $shareaccount=$member->memberaccount->where('name','Share Account')->first();
                         $mainshare=Mainaccount::where('name','=','Share Account')->first();

                          $sharev=Share::sum('share_value');
                          $share=Member_share::create([
                              
                            'member_id'=>$member->member_id,
                            'amount'=>$sharebalance,
                            'share_date'=>date('Y-m-d'),
                            'user_id'=>Auth::guard('member')->user()->member_id,
                            'No_shares'=>$sharebalance/$sharev,
                            'state'=>'in'

                      ]);

                              $payment=Payment::create([
                              'member_share_id'=>$share->id,
                              'amount'=>$sharebalance,
                              'narration'=>'shares',
                              'paid_by'=>Auth::guard('member')->user()->member_id, 
                              'payment_type'=>'salary',
                              'state'=>'in',
                              'date'=>date('Y-m-d')
                          
                      ]);
                                //jornal cr main saccoss

                                   Bankaccount::create([
                                    'dr'=>$sharebalance,
                                     'mainaccount_id'=>$mainshare->id,
                                     'memberaccount_id'=>$shareaccount->id,
                                     'description'=>'share',
                                      'date'=>date('Y-m-d')
                                         
                                   ]);
                                    Payableaccount::create([
                                    'member_share_id'=>$share->id,
                                    'cr'=>$sharebalance,
                                    'date'=>date('Y-m-d')
                                    ]);
                                    //savings

                                    $savingaccount=$member->memberaccount->where('name','=','Saving Account')->first(); 
                                    $mainsaving=Mainaccount::where('name','=','Saving Account')->first();
                                    $saving=Membersaving::create([
                                        
                                        'member_id'=>$member->member_id,
                                        'saving_code'=>$savingaccount->account_no,
                                        'amount'=>$savingbalance,
                                        'user_id'=>Auth::guard('member')->user()->member_id,
                                        'saving_date'=>date('Y-m-d'),
                                        'state'=>'in'
                                    ]);
         
         
                                           $payment=Payment::create([
                                          'membersaving_id'=>$saving->id,
                                          'amount'=>$savingbalance,
                                          'narration'=>'saving',
                                          'paid_by'=>Auth::guard('member')->user()->member_id, 
                                          'payment_type'=>'salary',
                                          'state'=>'in',
                                          'date'=>date('Y-m-d')
                                      
                                  ]);
                                              Bankaccount::create([
                                                'dr'=>$savingbalance,
                                                 'mainaccount_id'=>$mainsaving->id,
                                                 'memberaccount_id'=>$savingaccount->id,
                                                 'description'=>'saving',
                                                  'date'=>date('Y-m-d')    
                                               ]);

                                               Payableaccount::create([
                                                'member_share_id'=>$saving->id,
                                                'cr'=>$savingbalance,
                                                'date'=>date('Y-m-d')
                                                ]);               
                         
            }

              $paymentlist=Monthpaymentlist::where('member_id',$member->member_id)
              ->whereMonth('date',$month)->whereYear('date',$year)->update([
                'status'=>'paid'
              ]);
                         
 }

                       return response()->json(['success'=>'successfully Posted']); 

    }
       

          public function duration_payment(){

             return view('payment.duration_payment');
          }


      public function payment_list(Request $request){

               
             $startDate=$request->startDate;
              $endDate=$request->endDate;

              $payments=Payment::whereBetween('date',[$startDate,$endDate])->get();
         // $payments=Payment::orderBy('date','desc')->get();

         return view('payment.payment_list',compact('payments'));
      }


}
 
