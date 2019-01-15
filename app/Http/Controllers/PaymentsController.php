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

class PaymentsController extends Controller
{
    //



   function __construct(){

       return $this->middleware('auth:member');
     }


     public function allpayments(){
            $member=Member::find(3);

          $loans=$member->loans->where('loan_status','repayment');
             $curentdate=explode('-',date('Y-m-d'));
              $year=$curentdate[0];
             $month=$curentdate[1];

     $members=Member::where('status','active')->whereHas('monthsavingshare', function ($query) use($month,$year){
     
    $query->whereMonth('date',$month)->whereYear('date',$year)->where('saving_status','!=','paid')->orWhere('share_status','!=','paid');
})->get();
              // $interest=0;
        /*  foreach ($loans as $loan){
             $interest=$loan->whereHas('loanschedule', function ($query) use($month,$year){
    $query->whereMonth('duedate',$month)->whereYear('duedate',$year);
})->get();
          }

             dd($interest);*/

       //members whose status in monthsavingshare table is equel not eqiel to paid
       //members whose status in loan schedule of that or priviors month is either incomplite or unpaid 
     	 return view('Payment.allmonthpayment',compact('members','loans'));  
     }


      public function printallmember_topay(Request $request){


      	    $array=explode(',', $request->array);

      	     $members=Member::find($array);

           foreach($members as $member){
      	     $html= '<tr>
           
      
    <td>'.$member->registration_no.'</td>
    <td>'.ucfirst($member->first_name).' '.ucfirst($member->last_name) .' '. ucfirst($member->middle_name).'  </td>';
          $noshares=$member->no_shares->where('state','in')->sum('No_shares')-$member->no_shares->where('state','out')->sum('No_shares');

            if($noshares<1000){
    $html .='<td>'.number_format($share=$member->monthshare,2).'</td>';
             }
             else {
              $html .='<td>'.number_format($share=0.00,2).'</td>';

             }


    $html .='<td>'.number_format($saving=$member->monthsaving,2).'</td>';
         
          if(is_null($member->loans)){
             $month=date('m',strtotime(date('Y-m-d'))); 
             $year=date('Y',strtotime(date('Y-m-d')));

             $html .='<td>'.$interest=$member->loan->loanschedule->whereMonth('duedate','<=',$month)->whereYear('duedate','<=',$year)->where('status','=','!paid')->sum('monthinterest').'</td>
                <td>'.$principle=$member->loan->loanschedule->where('status','=','unpaid')->whereMonth('duedate',$month)->whereYear('duedate',$year)->sum('monthprinciple').'</td>
                <td>'.number_format($share+$saving+$interest+$principle,2).'</td>';
                 }else{
                          $interest=0.00;
                          $principle=0.00;
                $html .='<td>'.$interest.'</td>
                <td>'.$principle.'</td>
                <td>'.number_format($share+$saving+$interest+$principle,2).'</td>';
                 
                 }   

   $html .= '</tr>';

     echo $html;

        //to be complited
      }

  }


    public function pay_allmembers(Request $request){

         
               $array=$request->array;

               $numbers=array_filter($array,function($number){
                            
                      return intval($number);
                } );

                       $bankaccount=Mainaccount::where('name','=','Bank Account')->first();




                       $members=\App\Member::find($numbers);
                       $curentdate=explode('-',date('Y-m-d'));
                       $year=$curentdate[0];
                       $month=$curentdate[1];

                     foreach($members as $member){

                         $membermonthsaving=$member->monthsaving;
                         $noshares=$member->no_shares->where('state','in')->sum('No_shares')-$member->no_shares->where('state','out')->sum('No_shares');

                            if($noshares>=1000){
                              $membermonthshare=0; 
                            }
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
                               if($noshares<1000){
                              $share=Member_share::create([
                               'member_id'=>$member->member_id,
                               'amount'=>$membermonthshare,
                               'No_shares'=>($membermonthshare/Share::sum('share_value')),
                               'share_date'=>date('Y-m-d'),
                               'user_id'=>Auth::guard('member')->user()->member_id
                             ]);
                            }

                           

                                          if($noshares<1000){    

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

                                        }
                                    //loan schedule

                                 $membermonthsavingshare=$member->monthsavingshare()->whereMonth('date',$month)->whereYear('date',$year)->first();
                                 $membermonthsavingshare->saving_status='paid';
                                 
                                 $membermonthsavingshare->share_status='paid';
                        
                                 $membermonthsavingshare->save();
                               

                                     if(count($member->loanschedule)){ 
                                               
                        $membermonthinterest=$loan_schedule->sum('monthinterest');
                        $membermonthprinciple=$loan_schedule->sum('monthprinciple');
                        $main_interestaccount=Mainaccount::where('name','=','Interest Account')->first();
                       $member_interestaccount=$member->memberaccount->where('name','=','Interest Account')->first();
                       $main_loanaccount=Mainaccount::where('name','=','Loan Account')->first();
                       $member_loanaccount=$member->memberaccount->where('name','=','Loan Account')->first();

                                                
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

/*
                                                               $payment=Payment::create([
                                      'membersaving_id'=>$saving->id,  
                                      'member_share_id'=>($noshares<1000) ? $share->id :null,  
                                      'loan_id'=>(count($member->loanschedule))? $member->$loan_schedule->id :' ',
                                      'amount'=>(count($member->loanschedule))? $membermonthinterest+$membermonthprinciple+$membermonthsaving+$membermonthshare : $membermonthsaving+$membermonthshare,
                                      'narration'=>'Member Month Payment',
                                      'paid_by'=>Auth::guard('member')->user()->member_id,  //loan payment verificat
                                      'payment_type'=>'salary',
                                      'state'=>'in',
                                      'date'=>date('Y-m-d')
                                         ]);*/

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
                                                           
                                                    }              

                       
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
 
  /*<td>'.$interest=$member->loan->loanschedule->whereMonth('duedate','<=',$month)->whereYear('duedate','<=',$year)->where('status','=','!paid')->sum('monthinterest').'</td>
    <td>'.$principle=$member->loan->loanschedule->where('status','=','unpaid')->whereMonth('duedate',$month)->whereYear('duedate',$year)->sum('monthprinciple').'</td>
    <td>'.number_format($share+$saving+$interest+$principle,2).'</td>*/