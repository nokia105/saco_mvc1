<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Member;
use App\Collateral;
use App\Loan;
use App\Loancategory;
use App\Loaninsuarance;
use Illuminate\Support\Facades\DB;
use App\Feescategory;
use App\Member_share;
use App\Share;
use App\Interestmethod;
use Carbon\Carbon;
use PDF;
use App\Loanschedule;
use App\Repayment;
use App\Membersaving;
use App\Insurance;
use App\Code;
use App\Mainaccount;
use App\Penalty;
use App\Payment;
use App\Journalentry;
use App\Payableaccount;
use App\Bankaccount;
use App\Loanaccount;
use App\Receivableaccount;
use App\Memberaccount;
use Excel;
use File;
class MembersProfileController extends Controller
{
    // 

     function __construct(){

       return $this->middleware('auth:member');
     }


  public function cover($mprofileid){

      $member=Member::findorfail($mprofileid);

    
    return view('loans.profile',compact('member'));
  }

      public function newloan($id){

    
            $username=Auth::guard('member')->user();

            $member=Member::find($id);
         
            $collaterals=Member::find($id)->collateral;      
              
            $loancategories=LoanCategory::select('id','category_name')->get();

            $guarantors=Member::all()->where('member_id','!=',$id);
            $fees=Feescategory::all()->where('fee_name','!=','Registration fee');
            $interestmethods=Interestmethod::all();
            return view('loans.newloan',compact('loancategories','username','member','collaterals','guarantors','fees','interestmethods'));
          }


      public function interest(Request $request){

         	 $pcategory_id=$request->pcategory;

              $interest=LoanCategory::select('id','default_duration','interest_rate')->find($pcategory_id);
                 echo json_encode([
                   'id'=>$interest->id,
                   'interest'=>$interest->interest_rate,
                   'duration'=>$interest->default_duration
                 ]);      
         }



      public function interestmethod(Request $request){
            // $principle=$request->principle;
             $period=$request->period;
             $startpayment=$request->startpayment;
             $Imethod=$request->Imethod;

            
               echo json_encode([
                
                 'principle'=>$request->principle,
                 'interest'=>$request->interest,
                 'monthlyrepayment'=>round(($request->principle/$period)+(($request->interest/100)*$request->principle)/$period,2),
                 'loanperiod'=>$request->period,
                 'firstpayment'=>$request->startpayment,
                 'lastpayment'=>date('Y-m-d', strtotime($request->period.' month', strtotime($request->startpayment))),
                 'loanrequestor'=>$request->loanrequestor,
                 'loanOfficer'=>$request->loanOfficer

               ]);
                  

      }
      public function membercollateral(Request $request){
                   $collateral_id=$request->collateral;             
          //$collaterals=Member::find($id)->collateral->where('id','=',1); 
              $collateral=Collateral::find($collateral_id);    
            echo json_encode([
                   'id'=>$collateral->id,
                   'asset'=>$collateral->colateral_name,
                   'value'=>$collateral->colateral_value,
                   'duration'=>$collateral->colateralevalution_date
                 ]);       
         }

      public function guarantors(Request $request){
             
           $guarator_id=$request->g;

            $guarator=Member::find($guarator_id);
            echo json_encode([
              'id'=>$guarator->member_id,
               'member_no'=>$guarator->registration_no,
              'fullname'=>ucfirst($guarator->first_name). ' '.ucfirst($guarator->middle_name).' '.ucfirst($guarator->last_name),
              'totalsaving'=>number_format($guarator->savingamount->where('state','in')->sum('amount')-$guarator->savingamount->where('state','out')->sum('amount'),2),
              'totalshare'=>number_format($guarator->no_shares->where('state','in')->sum('amount')-$guarator->no_shares->where('state','out')->sum('amount'),2),
              'salary'=>number_format($guarator->salary_amount,2)
            ]);     
         }

      public function loancharges(Request $request){  
          $charge_id=$request->charge_id;
          $charge=DB::table('feescategories')
                     ->select('id','fee_value','fee_name')
                     ->where('id', $charge_id)
                     ->get();
                foreach ($charge as $key) {
                        $data=array('id'=>$key->id,
                    'fee_name'=>$key->fee_name,
                    'fee_value'=>$key->fee_value );
                   }
            echo json_encode($data);     
         }

      public function createloan(Request $request){
              
                   // return back()->with('status','Successfully Submitted');
                  //dd($request->all());

            $member_id=$request->memberloan;
            $pcategory_id=$request->pcategory;
            $loanOfficer_id=$request->loanOfficer;
            $principle=$request->principle;
            $interest=$request->interest;
            $Imethod=$request->Imethod;
            $loanperiod=$request->period;
            $loanwm=$request->loanwm;
            $startpayment=$request->startpayment;
             //colateral from js field  
            $collate_id=$request->collate;
            $guarator_id=$request->guarantor;
            $charges=$request->charges;

                  /*dd(Member::check_registered_days($member_id));*/

                  //we get priciple deducting charges and insuarances

                  

                    
                $validator=$this->validate(request(),[
                 'pcategory'=>'required',
                 'principle'=>'required|numeric',
                 'interest'=>'required|numeric',
                 'Imethod'=>'required',
                 'period'=>'required|numeric',
                 'startpayment'=>'required|date',
                 'narration'=>'required',
                // 'file'=>'required|max:10000'
                ]);



                 
          /*  $file_upload=$request->file('file');

            $filename=time() . '.' . $file_upload->getClientOriginalName();
          
             $file_upload->move('uploads/file',$filename);*/


             //$mInterest=($interest/100)*$principle;

                    $no_shares=Member::find($member_id)->no_shares->sum('No_shares');
                
                    $max_shares=Share::select('max_shares')->first()->max_shares; 

                    $totalsaving=Member::find($member_id)->savingamount->sum('amount');

                    $differ_register_days=Member::find($member_id)->joining_date->diffInDays(Carbon::now());
                     
                    $insurance=Insurance::first()->percentage_insurance; //since we had only one insurance
                       
                   // $newprinciple= $principle-$request->principle*$insurance/100;

                        //dd($newprinciple);
                          
                           

                     /*if($differ_register_days>=90){*/

                               //testing purpose <=
                         if($no_shares==$max_shares){

                   if($request->has('collate')){
                      
                  $totalcollateral_value=Collateral::find($collate_id)->sum('colateral_value');

                   if(/*$principle<=(80/100*$totalcollateral_value+$totalsaving ) ||*/ $principle<=80/100*$totalcollateral_value ){
                            
                             $loan=Loan::create([
                            'loanInssue_date'=>date('Y-m-d'),
                            'inssued_by'=>($request->submit=='draft') ? ' ' : Auth::guard('member')->user()->member_id,
                            'loan_status'=>($request->submit=='draft') ? 'draft' :'submitted',
                            'loancategory_id'=>$pcategory_id,
                            'member_id'=>$member_id,
                            'duration'=>$loanperiod,
                            'interestmethod_id'=> $Imethod,
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

                        
                                               if($request->submit){
                                             return back()->with('status','Successfully Submitted');

                                              }else{

                                                return back()->with('status','Success! Saved to draft');

                                              }         

                   }

                                            return back()->with('error','your loan must be 80%  or of your collaterals')->withInput();


                   }else{
                  
                    // $totalsaving=Member::find($member_id)->savingamount->sum('amount');

                    if($principle<=3*$totalsaving){

                $loan=Loan::create([

                            'loanInssue_date'=>date('Y-m-d'),
                            'inssued_by'=>Auth::guard('member')->user()->member_id,
                            'loan_status'=>($request->submit=='draft') ? 'draft' :'submitted',
                            'loancategory_id'=>$pcategory_id,
                            'member_id'=>$member_id,
                            'duration'=>$loanperiod,
                            'interestmethod_id'=> $Imethod,
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



                                     return back()->with('status','your loan is accepted');

              }  
                  

                                     return back()->with('error','You asked for a loan which is more than your savings')->withInput();     

                   }

                   
                 }else{

                                     return back()->with('error','you must have 1000 shares in your account')->withInput();

                    }


                  /*   }else{


                                      return back()->with('error','you must be a member for three months')->withInput();
                     }*/
               
      }

   public function loanlist($id)
      {
      
        $code=Memberaccount::where('name','=','Loan Account')->first()->account_no;

      $loanlists=Member::find($id)->loans; 

      return view('loans.loanlist' , compact('loanlists','id','code')); 
    }


     public function finished_loans($id){
            $code=Memberaccount::where('name','=','Loan Account')->first()->account_no;

      $loanlists=Member::find($id)->loans->where('loan_status','=','finished'); 

        return view('loans.loanlist.finished_loans' , compact('loanlists','id','code')); 
     }

       public function ongoing_loans($id){
            $code=Memberaccount::where('name','=','Loan Account')->first()->account_no;

      $loanlists=Member::find($id)->loans->where('loan_status','=','paid'); 

        return view('loans.loanlist.ongoing_loans' , compact('loanlists','id','code')); 
     }

  
public function updateloan(Request $request)
 
 {  

              /*$this->validate(request(),[
                 'pcategory'=>'required',
                 'principle'=>'required|numeric',
                 'interest'=>'required|numeric',
                 'Imethod'=>'required',
                 'loanperiod'=>'required|numeric',
                 'startpayment'=>'required|date'

                ]);*/
          

}
        //download pdf

    public function pdfview(Request $request,$priciple,$interest,$period,$firstpayment){

               $principle=request()->segment(2);
                $interest=request()->segment(3);

                $period=request()->segment(4); 
                $firstpayment=request()->segment(5);

                $monthlyrepayment=round(($principle/$period)+(($interest/100)*$principle)/$period,2);  
                $montlyinterest=(($interest/100)*$principle)/$period;

                $pdf = PDF::loadView('loans.loanrepaymentpdf',compact('principle','interest','period','firstpayment','monthlyrepayment','montlyinterest'));
            return $pdf->download('pdfview.pdf');
    }



      public function schedule(){

           $loan_id=request()->segment(4);
           $member_id=request()->segment(2);

           $loan=Loan::find($loan_id);

            $loancollaterals=Loan::find($loan_id)->collaterals;
               
               $loanguarantors=Loan::find($loan_id)->guarantor;

               $insurance=Insurance::first();

               $loanfees=Loan::find($loan_id)->loan_fees;
         

          $code=Memberaccount::where('name','=','Loan Account')->first()->account_no;


           //$code=2000+$loan_id+$id;



           return view('loans.schedule',compact('loan','code','loan_id','member_id','loancollaterals','loanguarantors','insurance','loanfees'));
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



      return view('payment.showpayments',compact('loanstrasactions','code','sharecode','sharetrasactions','savingcode','savingtrasactions','regfeetransactions','member')); 
      

   }

              //repayment
      public function pay(){

        return view('loans.payment');
      }


        public function ajaxreceivepayment(Request $request,$id){

                     $member=Member::find($id);

                if($request->payment_type=='loan'){

                   
                    $main_account=Mainaccount::where('name','=','Loan Account')->first();

                   echo json_encode([
                    'member_account'=>$member->memberaccount->where('name','=','Loan Account')->first()->account_no .': ' .strtoupper($member->first_name .' '.$member->last_name),
                    'main_account'=>$main_account->account_no . strtoupper(' : Loan'),
                    'memberaccount_id'=>$member->memberaccount->where('name','=','Loan Account')->first()->id,
                    'mainaccount_id'=>$main_account->id

                   ]);
                }elseif($request->payment_type=='share'){
                  $main_account=Mainaccount::where('name','=','Share Account')->first();
                 echo json_encode([
                    'member_account'=>$member->memberaccount->where('name','=','Share Account')->first()->account_no .': ' .strtoupper($member->first_name .' '.$member->last_name),
                    'main_account'=>$main_account->account_no. strtoupper(' : Share'),
                    'memberaccount_id'=>$member->memberaccount->where('name','=','Share Account')->first()->id ,
                    'mainaccount_id'=>$main_account->id

                   ]);
                }elseif($request->payment_type=='saving'){
                    $main_account=Mainaccount::where('name','=','Saving Account')->first();
                 echo json_encode([
                    'member_account'=>$member->memberaccount->where('name','=','Saving Account')->first()->account_no .': ' .strtoupper($member->first_name .' '.$member->last_name),
                    'main_account'=>$main_account->account_no. strtoupper(' : Saving'),
                    'memberaccount_id'=>$member->memberaccount->where('name','=','Saving Account')->first()->id,
                    'mainaccount_id'=>$main_account->id

                   ]);

                }elseif($request->payment_type=='reg_fee'){

                  $main_account=Mainaccount::where('name','=','Registration Fee')->first();

                  echo json_encode([
                    'member_account'=>$member->memberaccount->where('name','=','Registration Fee')->first()->account_no .': ' .strtoupper($member->first_name .' '.$member->last_name),
                    'main_account'=>$main_account->account_no. strtoupper(' : Registration Fee'),
                    'memberaccount_id'=>$member->memberaccount->where('name','=','Registration Fee')->first()->id,
                    'mainaccount_id'=>$main_account->id

                   ]);
                   

                }else{
                 echo json_encode([
                    'member_account'=>"none",
                    'main_account'=>"none"
                     ]);

                }
        }
           //repayment
       public function storepayments(Request $request){

           //dd($request->all());

                           $member=Member::find($request->member);
                            $amountinput=$request->payment;
                             $getpaymenttype=$request->payment_type;

                          

                  $newamount=0;

                   $bankaccount=Mainaccount::where('name','=','Bank Account')
                                            ->first();
                 $curentdate=explode('-',date('Y-m-d'));
              $year=$curentdate[0];
             $month=$curentdate[1];
                      
                if($request->payment_type=='loan'){
                    $member_loans=Member::find($request->member)->loanlist->where('loan_status','=','repayment');     
                      $loanscheduleid=$member_loans->pluck('id');

                              
                       foreach($member_loans as $loan){
                           /* $loanschedules=$loan->loanschedule->whereRaw(\DB::raw('MONTH(duedate)'),'=',$month);*/
                                  /* dd($loanschedules);*/
                         /*  $loanschedules=Loanschedule::whereIn('loan_id',$loanscheduleid)->whereMonth('duedate',$month)->whereYear('duedate',$year)->get();*/
                           $previousmonth=date('Y-m-d', strtotime(date('Y-m-01')." -1 month"));
                              //dd($previousmonth);
                       
                             $lastdateofcurrentmonth=date("Y-m-t", strtotime(date('Y-m-d'))); 
                                

                      $loanschedules=Loanschedule::whereIn('loan_id',$loanscheduleid)->where('status',null)->whereBetween('duedate',[$previousmonth,$lastdateofcurrentmonth])->orWhere('status','=','incomplite')->get();
                                      
                                
                          foreach($loanschedules  as $loan_schedule){
                                          // dd($loan_schedule);
                                 if($loan_schedule->status!='paid') {
                                                      //get first row in table
      
                      $member_interestaccount=$member->memberaccount->where('name','=','Interest Account')->first();
                      $main_interestaccount=Mainaccount::where('name','=','Interest Account')->first();
                       $main_loanaccount=Mainaccount::where('name','=','Loan Account')->first();
                      $month_paid_interest=$loan_schedule->monthrepayment->sum('interestpayed');
                      $month_paid_principle=$loan_schedule->monthrepayment->sum('principlepayed');

                        

                                   $payment=Payment::create([
                                     'loan_id'=>$loan_schedule->loan->id,
                                      'amount'=>$request->payment,
                                      'narration'=>$request->narration,
                                      'paid_by'=>Auth::guard('member')->user()->member_id,  //loan payment verificat
                                      'payment_type'=>$request->payment_method,
                                      'state'=>'in',
                                      'date'=>date('Y-m-d')
                                         ]);

                

                                        if(is_null($loan_schedule->monthpenaty)){
                                                  
                                                    //dd($loan_schedule->monthpenaty);
                                            //amount he  has paid
                                
                                $month_paid_amount=$month_paid_interest+$month_paid_principle;

                               $totalmonthpay=($loan_schedule->monthprinciple+$loan_schedule->monthinterest)-$month_paid_amount;

                    
                                            $interest_to_pay=$loan_schedule->monthinterest-$month_paid_interest;


                                                $principle_to_pay=$loan_schedule->monthprinciple-$month_paid_principle;

                                                         $total_to_pay=($principle_to_pay+$interest_to_pay);
                                                     

                                                //store in payment table
                                                           
                                                          if($amountinput==$totalmonthpay){         
                                                               
                                                             $repayment=Repayment::create([
                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=> $principle_to_pay,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$total_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id

                                                             ]);  

                                                          //$newamount=0;
                                                           
                                                       $repayment->monthrepayment()->attach($loan_schedule->id);
                                                       $loan_schedule->status='paid';
                                                       $loan_schedule->save();

                                                                         
                                                      /*if($loan->loanrepayment->sum('amountpayed')==($loan_schedule->sum('monthprinciple')+$loan_schedule->sum('monthinterest'))){

                                                     $loan->loan_status='inactive';
                                                      $loan->save();*/

                                                //cr loan account in bank
                                           
                                   Bankaccount::create([

                                  'memberaccount_id'=>$request->memberaccount_id,
                                  'mainaccount_id'=>$request->mainaccount_id,
                                  'dr'=>$principle_to_pay,
                                  'description'=>'loan',
                                  'date'=>date('Y-m-d')
                                      ]); 

                                     // dr bankaccount

                                       Loanaccount::create([
                                       'memberaccount_id'=>$request->memberaccount_id,
                                       'mainaccount_id'=>$bankaccount->id,
                                       'dr'=>$principle_to_pay,
                                       'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                    ]);

                                          //interest account

                                       Bankaccount::create([

                                  'mainaccount_id'=>$main_interestaccount->id,
                                  'memberaccount_id'=>$member_interestaccount->id,
                                  'dr'=>$interest_to_pay,
                                  'description'=>'interest',
                                  'date'=>date('Y-m-d')
                                      ]);

                                       //loan  account receivable 

                                      Receivableaccount::create([
                                     'cr'=>$principle_to_pay,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$request->memberaccount_id,
                                      'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                   ]);

                                              //interest in receivable

                                       Receivableaccount::create([
                                     'cr'=>$interest_to_pay,
                                     'memberaccount_id'=>$member_interestaccount->id,
                                      'mainaccount_id'=>$bankaccount->id,
                                      'description'=>'interest',
                                       'date'=>date('Y-m-d')
                                   ]);


                     
                                                  
                                   
                                                //store in jornal table 


                                                            //principle main
                                                Journalentry::create(
                                               [
                               
                                             'dr'=>$principle_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'loan']
                                   
                                                  ); 

                                                  //principle member

                                             Journalentry::create( [
                                             'cr'=>$principle_to_pay, 
                                             'memberaccount_id'=>$request->memberaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'loan']); 

                                                      //interst main
                                                  Journalentry::create([
                                             'dr'=>$interest_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,//$main_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']); 

                                                   // interest member

                                                   Journalentry::create([
                                             'cr'=>$interest_to_pay, 
                                             'memberaccount_id'=>$member_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']);

                                          return view('loans.receipt.repayment',compact('payment','getpaymenttype','member'));
                                                             
                                                        break; 

                                                        

                                               }
                                               else if($amountinput>$totalmonthpay){
                                                     //to br followed
                                                           
                                                           $repayment=Repayment::create([

                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=> $principle_to_pay,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$total_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id

                                                 ]);  

                                                                   $newamount=$amountinput-$totalmonthpay;   
                                                                   
                                                                    $repayment->monthrepayment()->attach($loan_schedule->id);
                                                                    $loan_schedule->status='paid';
                                                                    $loan_schedule->save();

                                                         
                                               
                                     Bankaccount::create([

                                  'mainaccount_id'=>$request->mainaccount_id,
                                  'memberaccount_id'=>$request->memberaccount_id,
                                  'dr'=>$principle_to_pay,
                                  'description'=>'loan',
                                  'date'=>date('Y-m-d')
                                      ]); 

                                     // dr bankaccount

                                       Loanaccount::create([
                                       'memberaccount_id'=>$request->memberaccount_id,
                                       'mainaccount_id'=>$bankaccount->id,
                                       'dr'=>$principle_to_pay,
                                       'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                    ]);

                                          //interest account

                                       Bankaccount::create([

                                  'mainaccount_id'=>$main_interestaccount->id,
                                  'memberaccount_id'=>$member_interestaccount->id,
                                  'dr'=>$interest_to_pay,
                                  'description'=>'interest',
                                  'date'=>date('Y-m-d')
                                      ]);

                                       //loan  account receivable 

                                      Receivableaccount::create([
                                     'cr'=>$principle_to_pay,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$request->memberaccount_id,
                                      'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                  ]);

                                              //interest in receivable

                                       Receivableaccount::create([
                                     'cr'=>$interest_to_pay,
                                     'memberaccount_id'=>$member_interestaccount->id,
                                      'mainaccount_id'=>$bankaccount->id,
                                      'description'=>'interest',
                                       'date'=>date('Y-m-d')
                                   ]);



 
                                                //store in jornal table 

                                                           
                                                            //principle main
                                                Journalentry::create(
                                               [
                               
                                             'dr'=>$principle_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'loan']
                                   
                                                  ); 

                                                  //principle member

                                             Journalentry::create( [
                                             'cr'=>$principle_to_pay, 
                                             'memberaccount_id'=>$request->memberaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'loan']); 

                                                      //interst main
                                                  Journalentry::create([
                                             'dr'=>$interest_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,//$main_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']); 

                                                   // interest member

                                                   Journalentry::create([
                                             'cr'=>$interest_to_pay, 
                                             'memberaccount_id'=>$member_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']);
                                                                              
                                                              //return back()->with('status','Loan deposited'); 
                                                                               
                                               }
                                               else if($amountinput<$totalmonthpay){


                                                /*  if(($loan_schedule->monthinterest+$loan_schedule->monthprinciple)!=$loan_schedule->monthrepayment->sum('amountpayed')){*/

                                                     if($amountinput<$interest_to_pay){

                                                               
                                                                 $repayment=Repayment::create([

                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=> 0,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$interest_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id

                                                 ]);  

                                                                    $newamount=0;
                                                                   
                                                                    $repayment->monthrepayment()->attach($loan_schedule->id);
                                                                    $loan_schedule->status='incomplete';
                                                                    $loan_schedule->save();


                                                     //interest account

                                       Bankaccount::create([

                                  'mainaccount_id'=>$main_interestaccount->id,
                                  'memberaccount_id'=>$member_interestaccount->id,
                                  'dr'=>$interest_to_pay,
                                  'description'=>'interest',
                                  'date'=>date('Y-m-d')
                                      ]);


                                              //interest in receivable

                                       Receivableaccount::create([
                                     'cr'=>$interest_to_pay,
                                     'memberaccount_id'=>$member_interestaccount->id,
                                      'mainaccount_id'=>$bankaccount->id,
                                      'description'=>'interest',
                                       'date'=>date('Y-m-d')
                                   ]);                      

                                                //store in jornal table 
                                     
                                                      //interst main
                                                Journalentry::create([
                                             'dr'=>$interest_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,//$main_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']); 

                                                   // interest member

                                                   Journalentry::create([
                                             'cr'=>$interest_to_pay, 
                                             'memberaccount_id'=>$member_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']);
     
                                                return view('loans.receipt.repayment',compact('payment','getpaymenttype','member'));
                                                             
                                                           break;
                                                              

                                         }else if($amountinput>=$interest_to_pay){
                                                                     
                                                        //start inserting in principle

                                                                   $repayment=Repayment::create([

                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=>($amountinput-$interest_to_pay),
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$amountinput,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id

                                                 ]);  

                                                                    $newamount=0;
                                                                   
                                                                 $repayment->monthrepayment()->attach($loan_schedule->id);
                                                                  $loan_schedule->status='incomplete';
                                                                  $loan_schedule->save();





                               Bankaccount::create([

                                  'mainaccount_id'=>$request->mainaccount_id,
                                  'memberaccount_id'=>$request->memberaccount_id,
                                  'dr'=>($amountinput-$interest_to_pay),
                                  'description'=>'loan',
                                  'date'=>date('Y-m-d')
                                      ]); 

                                     // dr bankaccount

                                       Loanaccount::create([
                                       'memberaccount_id'=>$request->memberaccount_id,
                                       'mainaccount_id'=>$bankaccount->id,
                                       'dr'=>($amountinput-$interest_to_pay),
                                       'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                    ]);


                                             //receivable account
                                         Receivableaccount::create([
                                     'cr'=>($amountinput-$interest_to_pay),
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$request->memberaccount_id,
                                      'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                   ]);
                                                    
                                                              //interest account

                                       Bankaccount::create([

                                  'mainaccount_id'=>$main_interestaccount->id,
                                  'memberaccount_id'=>$member_interestaccount->id,
                                  'dr'=>$interest_to_pay,
                                  'description'=>'interest',
                                  'date'=>date('Y-m-d')
                                      ]);


                                              //interest in receivable

                                       Receivableaccount::create([
                                     'cr'=>$interest_to_pay,
                                     'memberaccount_id'=>$member_interestaccount->id,
                                      'mainaccount_id'=>$bankaccount->id,
                                      'description'=>'interest',
                                       'date'=>date('Y-m-d')
                                   ]);  


                                                //store in jornal table 


                                                            //principle main
                                                      Journalentry::create(
                                                  [
                               
                                             'dr'=>($amountinput-$interest_to_pay), 
                                             'mainaccount_id'=>$bankaccount->id,
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'loan']
                                   
                                                  ); 

                                                  //principle member

                                             Journalentry::create( [
                                             'cr'=>($amountinput-$interest_to_pay), 
                                             'memberaccount_id'=>$request->memberaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'loan']); 

                                                      //interst main
                                                  Journalentry::create([
                                             'dr'=>$interest_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,//$main_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']); 

                                                   // interest member

                                                   Journalentry::create([
                                             'cr'=>$interest_to_pay, 
                                             'memberaccount_id'=>$member_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']);
                                                                    

                                                  
                                              return view('loans.receipt.repayment',compact('payment','getpaymenttype','member'));
                                                             
                                                              break;


                                                        } 

                                               }



                                                if($newamount>0){


                                                           $amountinput=$newamount;
                                                        } 
                                                else return view('loans.receipt.repayment',compact('payment','getpaymenttype','member'));


                                        }else{

                                                // dd($request->all());
                                                 $penalty=Penalty::first()->percentage_penalty;
                                                 $month_paid_penaty=$loan_schedule->monthpenaty->sum('amount_paid'); 
                                                          // actual all penalty
                                                  $monthpenalty=($penalty/100)*($loan_schedule->monthprinciple+$loan_schedule->monthinterest);

                                                 $month_paid_amount=$month_paid_interest+$month_paid_principle+$month_paid_penaty;

                                                $totalmonthpay=($loan_schedule->monthprinciple+$loan_schedule->monthinterest+$monthpenalty)-$month_paid_amount;

                                                $interest_to_pay=$loan_schedule->monthinterest-$month_paid_interest;


                                                $principle_to_pay=$loan_schedule->monthprinciple-$month_paid_principle;

                                                $penaty_to_pay=$monthpenalty-$month_paid_penaty;

                                                  $total_to_pay=($principle_to_pay+$interest_to_pay+$penaty_to_pay);
                                             

                  $member_penatyaccount=$member->memberaccount->where('name','=','Penaty Account')->first();
                      $main_penatyaccount=Mainaccount::where('name','=','Penaty Account')->first();


                             if($amountinput==$totalmonthpay){
                                                           
                                                       $repayment=Repayment::create([
                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=> $principle_to_pay,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$total_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id

                                                             ]);  

                                                          //$newamount=0;
                                                           
                                                           $repayment->monthrepayment()->attach($loan_schedule->id);
                                                            $loan_schedule->status='paid';
                                                            $loan_schedule->save();

                                                           //payment



                                   Bankaccount::create([

                                  'mainaccount_id'=>$main_penatyaccount->id,
                                  'memberaccount_id'=>$member_penatytaccount->id,
                                  'dr'=>$penaty_to_pay,
                                  'description'=>'penaty',
                                  'date'=>date('Y-m-d')
                                      ]);

                                       //penaty account receivable 

                                      Receivableaccount::create([
                                     'cr'=>$penaty_to_pay,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$member_penatyaccount->id,
                                     'description'=>'penaty',
                                      'date'=>date('Y-m-d')
                                   ]);



                                                              //interest account

                                       Bankaccount::create([

                                  'mainaccount_id'=>$main_interestaccount->id,
                                  'memberaccount_id'=>$member_interestaccount->id,
                                  'dr'=>$interest_to_pay,
                                  'description'=>'interest',
                                  'date'=>date('Y-m-d')
                                      ]);


                                              //interest in receivable

                                       Receivableaccount::create([
                                     'cr'=>$interest_to_pay,
                                     'memberaccount_id'=>$member_interestaccount->id,
                                      'mainaccount_id'=>$bankaccount->id,
                                      'description'=>'interest',
                                       'date'=>date('Y-m-d')
                                   ]); 


                                      Bankaccount::create([

                                  'memberaccount_id'=>$request->memberaccount_id,
                                  'mainaccount_id'=>$request->mainaccount_id,
                                  'dr'=>$principle_to_pay,
                                  'description'=>'loan',
                                  'date'=>date('Y-m-d')
                                      ]); 

                                     // dr bankaccount

                                       Loanaccount::create([
                                       'memberaccount_id'=>$request->memberaccount_id,
                                       'mainaccount_id'=>$bankaccount->id,
                                       'dr'=>$principle_to_pay,
                                       'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                    ]); 

                                              //loan receivable
                                        Receivableaccount::create([
                                     'cr'=>$principle_to_pay,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$request->memberaccount_id,
                                      'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                   ]);
                                        




                                                          //penalty main account 

                                                 Journalentry::create(
                                                  [
                               
                                             'dr'=>$penaty_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id, //from penalty account
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'penaty']
                                   
                                                  ); 
                                                              //penalty member account

                                             Journalentry::create( [
                                             'cr'=>$penaty_to_pay, 
                                             'memberaccount_id'=>$member_penatyaccount->id,//$request->memberaccount_id, //from penalty account
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'penaty']); 


                                                        //principle main  

                                                 Journalentry::create(
                                                  [
                               
                                             'dr'=>$principle_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'loan']
                                   
                                                  ); 

                                                  //principle member

                                             Journalentry::create( [
                                             'cr'=>$principle_to_pay, 
                                             'memberaccount_id'=>$request->memberaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'loan']); 

                                                      //interst main
                                                  Journalentry::create([
                                             'dr'=>$interest_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']); 

                                                   // interest member

                                                   Journalentry::create([
                                             'cr'=>$interest_to_pay, 
                                             'memberaccount_id'=>$member_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']);


                                                                //update penaty status
                                                   $monthpenaty=$loan_schedule->monthpenaty;
                                                  $monthpenaty->status="paid";
                                                    $monthpenaty->save(); 

                                              return view('loans.receipt.repayment',compact('payment','getpaymenttype','member'));
                                                             
                                                        break;        
                                                        
                                         }elseif($amountinput>$totalmonthpay){



                                                            
                                                          $repayment=Repayment::create([

                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=> $principle_to_pay,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$total_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id

                                                 ]);  

                                                                   $newamount=$amountinput-$totalmonthpay;   
                                                                   
                                                                    $repayment->monthrepayment()->attach($loan_schedule->id);
                                                                    $loan_schedule->status='paid';
                                                                    $loan_schedule->save();

                                           Bankaccount::create([

                                  'mainaccount_id'=>$main_penatyaccount->id,
                                  'memberaccount_id'=>$member_penatyaccount->id,
                                  'dr'=>$penaty_to_pay,
                                  'description'=>'penaty',
                                  'date'=>date('Y-m-d')
                                      ]);

                                       //penaty account receivable 

                                      Receivableaccount::create([
                                     'cr'=>$penaty_to_pay,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$member_penatyaccount->id,
                                     'description'=>'penaty',
                                      'date'=>date('Y-m-d')
                                   ]);



                                                              //interest account

                                       Bankaccount::create([

                                  'mainaccount_id'=>$main_interestaccount->id,
                                  'memberaccount_id'=>$member_interestaccount->id,
                                  'dr'=>$interest_to_pay,
                                  'description'=>'interest',
                                  'date'=>date('Y-m-d')
                                      ]);


                                              //interest in receivable

                                       Receivableaccount::create([
                                     'cr'=>$interest_to_pay,
                                     'memberaccount_id'=>$member_interestaccount->id,
                                      'mainaccount_id'=>$bankaccount->id,
                                      'description'=>'interest',
                                       'date'=>date('Y-m-d')
                                   ]); 


                                      Bankaccount::create([

                                  'memberaccount_id'=>$request->memberaccount_id,
                                  'mainaccount_id'=>$request->mainaccount_id,
                                  'dr'=>$principle_to_pay,
                                  'description'=>'loan',
                                  'date'=>date('Y-m-d')
                                      ]); 

                                     // dr bankaccount

                                       Loanaccount::create([
                                       'memberaccount_id'=>$request->memberaccount_id,
                                       'mainaccount_id'=>$bankaccount->id,
                                       'dr'=>$principle_to_pay,
                                       'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                    ]); 

                                              //loan receivable
                                        Receivableaccount::create([
                                     'cr'=>$principle_to_pay,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$request->memberaccount_id,
                                      'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                   ]);
                                        




                                                          //penalty main account 

                                                 Journalentry::create(
                                                  [
                               
                                             'dr'=>$penaty_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id, //from penalty account
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'penaty']
                                   
                                                  ); 
                                                              //penalty member account

                                             Journalentry::create( [
                                             'cr'=>$penaty_to_pay, 
                                             'memberaccount_id'=>$member_penatyaccount->id,//$request->memberaccount_id, //from penalty account
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'penaty']); 


                                                        //principle main  

                                                 Journalentry::create(
                                                  [
                               
                                             'dr'=>$principle_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'loan']
                                   
                                                  ); 

                                                  //principle member

                                             Journalentry::create( [
                                             'cr'=>$principle_to_pay, 
                                             'memberaccount_id'=>$request->memberaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'loan']); 

                                                      //interst main
                                                  Journalentry::create([
                                             'dr'=>$interest_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']); 

                                                   // interest member

                                                   Journalentry::create([
                                             'cr'=>$interest_to_pay, 
                                             'memberaccount_id'=>$member_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']);



                                                    }elseif($amountinput<$totalmonthpay){

                                                      
                                                       if($amountinput<$penaty_to_pay){

                                                               
                                                         $repayment=Repayment::create([

                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=> 0,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$interest_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id

                                                 ]);  

                                                                    $newamount=0;
                                                                   
                                                                    $repayment->monthrepayment()->attach($loan_schedule->id);
                                                                    $loan_schedule->status='incomplete';
                                                                    $loan_schedule->save();
                           

                                        Bankaccount::create([

                                  'mainaccount_id'=>$main_penatyaccount->id,
                                  'memberaccount_id'=>$member_penatyaccount->id,
                                  'dr'=>$penaty_to_pay,
                                  'description'=>'penaty',
                                  'date'=>date('Y-m-d')
                                      ]);

                                       //penaty account receivable 

                                      Receivableaccount::create([
                                     'cr'=>$penaty_to_pay,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$member_penatyaccount->id,
                                     'description'=>'penaty',
                                      'date'=>date('Y-m-d')
                                   ]);




                                                //store in jornal table 

                                     Journalentry::create(
                                                  [
                               
                                             'dr'=>$penaty_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id, //from penalty account
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'penaty']
                                   
                                                  ); 
                                                              //penalty member accoount

                                             Journalentry::create( [
                                             'cr'=>$penaty_to_pay, 
                                             'memberaccount_id'=>$member_penatyaccount->id, //from penalty account
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'penaty']);

                                                  
                                                //update penaty sataus
                                                 

                                              return view('loans.receipt.repayment',compact('payment','getpaymenttype','member'));
                                                              

                                       }elseif($amountinput<($penaty_to_pay+$interest_to_pay)){

                                            $repayment=Repayment::create([

                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=> 0,
                                                                  'interestpayed'=>($amountinput-$penaty_to_pay),
                                                                  'amountpayed'=>($amountinput-$penaty_to_pay),
                                                                'paymentdate'=>date('Y-m-d H:i:s'),
                                                        'user_id'=>Auth::guard('member')->user()->member_id

                                                 ]);  

                                                                    $newamount=0;
                                                                   
                                                                $repayment->monthrepayment()->attach($loan_schedule->id);
                                                                $loan_schedule->status='incomplete';
                                                                $loan_schedule->save();

                                                            Bankaccount::create([

                                  'mainaccount_id'=>$main_penatyaccount->id,
                                  'memberaccount_id'=>$member_penatyaccount->id,
                                  'dr'=>$penaty_to_pay,
                                  'description'=>'penaty',
                                  'date'=>date('Y-m-d')
                                      ]);

                                       //penaty account receivable 

                                      Receivableaccount::create([
                                     'cr'=>$penaty_to_pay,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$member_penatyaccount->id,
                                     'description'=>'penaty',
                                      'date'=>date('Y-m-d')
                                   ]);


                                               //interest bank
                                                Bankaccount::create([

                                  'mainaccount_id'=>$bankaccount->id,
                                  'memberaccount_id'=>$member_interestaccount->id,
                                  'dr'=>($amountinput-$penaty_to_pay),
                                  'description'=>'interest',
                                  'date'=>date('Y-m-d')
                                      ]);


                                              //interest in receivable

                                       Receivableaccount::create([
                                     'cr'=>($amountinput-$penaty_to_pay),
                                     'memberaccount_id'=>$member_interestaccount->id,
                                      'mainaccount_id'=>$bankaccount->id,
                                      'description'=>'interest',
                                       'date'=>date('Y-m-d')
                                   ]); 


                                                Journalentry::create(
                                                  [
                               
                                             'dr'=>$penaty_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id, //from penalty account
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'penaty']
                                   
                                                  ); 
                                                              //penalty member accoount

                                             Journalentry::create( [
                                             'cr'=>$penaty_to_pay, 
                                             'memberaccount_id'=>$member_penatyaccount->id, //from penalty account
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'penaty']);                     

                                                                   //interst main
                                                  Journalentry::create([
                                             'dr'=>($amountinput-$penaty_to_pay), 
                                             'mainaccount_id'=>$bankaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']); 

                                                   // interest member

                                                   Journalentry::create([
                                             'cr'=>$amountinput-$penaty_to_pay, 
                                             'memberaccount_id'=>$member_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']);

                                                     $monthpenaty=$loan_schedule->monthpenaty;
                                                  $monthpenaty->status="paid";
                                                    $monthpenaty->save(); 


                                                              return view('loans.receipt.repayment',compact('payment','getpaymenttype','member'));
                                                             
                                                              break;
                                                          
                                                        }elseif ($amountinput>=($penaty_to_pay+$interest_to_pay)) {

                                                               $repayment=Repayment::create([

                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                'principlepayed'=>($amountinput-($penaty_to_pay+$interest_to_pay)),
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$amountinput,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id

                                                 ]);  

                                                                    $newamount=0;
                                                                   
                                                                    $repayment->monthrepayment()->attach($loan_schedule->id);
                                                                    $loan_schedule->status='incomplete';
                                                                    $loan_schedule->save();



                                       Bankaccount::create([

                                  'mainaccount_id'=>$main_penatyaccount->id,
                                  'memberaccount_id'=>$member_penatyaccount->id,
                                  'dr'=>$penaty_to_pay,
                                  'description'=>'penaty',
                                  'date'=>date('Y-m-d')
                                      ]);

                                       //penaty account receivable 

                                      Receivableaccount::create([
                                     'cr'=>$penaty_to_pay,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$member_penatyaccount->id,
                                     'description'=>'penaty',
                                      'date'=>date('Y-m-d')
                                   ]);


                                               //interest bank
                                                Bankaccount::create([

                                  'mainaccount_id'=>$main_interestaccount->id,
                                  'memberaccount_id'=>$member_interestaccount->id,
                                  'dr'=>$interest_to_pay,
                                  'description'=>'interest',
                                  'date'=>date('Y-m-d')
                                      ]);


                                              //interest in receivable

                                       Receivableaccount::create([
                                     'cr'=>$interest_to_pay,
                                     'memberaccount_id'=>$member_interestaccount->id,
                                      'mainaccount_id'=>$bankaccount->id,
                                      'description'=>'interest',
                                       'date'=>date('Y-m-d')
                                   ]); 


                                               Bankaccount::create([

                                  'memberaccount_id'=>$request->memberaccount_id,
                                  'mainaccount_id'=>$request->mainaccount_id,
                                  'dr'=>($amountinput-($penaty_to_pay+$interest_to_pay)),
                                  'description'=>'loan',
                                  'date'=>date('Y-m-d')
                                      ]); 

                                     // dr bankaccount

                                       Loanaccount::create([
                                       'memberaccount_id'=>$request->memberaccount_id,
                                       'mainaccount_id'=>$bankaccount->id,
                                       'dr'=>($amountinput-($penaty_to_pay+$interest_to_pay)),
                                       'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                    ]); 

                                              //loan receivable
                                        Receivableaccount::create([
                                     'cr'=>($amountinput-($penaty_to_pay+$interest_to_pay)),
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$request->memberaccount_id,
                                      'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                   ]);

                            
                                                    
                                       Journalentry::create(
                                                  [
                               
                                             'dr'=>$penaty_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id, //from penalty account
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'penaty']
                                   
                                                  ); 
                                                              //penalty member accoount

                                             Journalentry::create( [
                                             'cr'=>$penaty_to_pay, 
                                             'memberaccount_id'=>$member_penatyaccount->id, //from penalty account
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'penaty']); 
                      
                                                //store in jornal table 


                                                            //principle main
                                                      Journalentry::create(
                                                  [
                               
                                             'dr'=>($amountinput-($penaty_to_pay+$interest_to_pay)), 
                                             'mainaccount_id'=>$bankaccount->id,
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'loan']
                                   
                                                  ); 

                                                  //principle member

                                             Journalentry::create( [
                                            'cr'=>($amountinput-($penaty_to_pay+$interest_to_pay)), 
                                             'memberaccount_id'=>$request->memberaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'loan']); 

                                                      //interst main
                                                  Journalentry::create([
                                             'dr'=>$interest_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']); 

                                                   // interest member

                                                   Journalentry::create([
                                             'cr'=>$interest_to_pay, 
                                             'memberaccount_id'=>$member_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']);

                                                  
                                              
                                                    $monthpenaty=$loan_schedule->monthpenaty;
                                                  $monthpenaty->status="paid";
                                                    $monthpenaty->save(); 
                  

                                                  
                                              return view('loans.receipt.repayment',compact('payment','getpaymenttype','member'));
                                                             
                                                              break;



                                                          
                                                        }

                          
                                                } 
                                          if($newamount>0){


                                              $amountinput=$newamount;
                                                        } 
            else return view('loans.receipt.repayment',compact('payment','getpaymenttype','member'));
//next if  
                                              }    

                                                     
                                              }//loan status  

                                               
                                 }
                                   

                               }

                                 return back();
                          
                       }else if($request->payment_type=='share'){

                              $share=Share::sum('share_value');
                             $max_shares=Share::select('max_shares')->first()->max_shares;
                                    
                                   $no_share=Member::find($request->member)->no_shares->sum('No_shares');
        
                                             if($no_share<$max_shares){


                                   
                         $share=Member_share::create([
                              
                               'member_id'=>$request->member,
                               'amount'=>$request->payment,
                               'share_date'=>date('Y-m-d'),
                               'user_id'=>Auth::guard('member')->user()->member_id,
                               'No_shares'=>$request->payment/$share

                         ]);

                                 $payment=Payment::create([
                                 'member_share_id'=>$share->id,
                                 'amount'=>$request->payment,
                                 'narration'=>$request->narration,
                                 'paid_by'=>Auth::guard('member')->user()->member_id, 
                                 'payment_type'=>$request->payment_method,
                                 'state'=>'in',
                                 'date'=>date('Y-m-d')
                             
                         ]);
                               


                                   //jornal cr main saccoss

                                      Bankaccount::create([
                                       'dr'=>$request->payment,
                                        'mainaccount_id'=>$request->mainaccount_id,
                                        'memberaccount_id'=>$request->memberaccount_id,
                                        'description'=>'share',
                                         'date'=>date('Y-m-d')
                                            
                                      ]);

                                       Payableaccount::create([
                                       'member_share_id'=>$share->id,
                                       'cr'=>$request->payment,
                                       'date'=>date('Y-m-d')
                                       ]);

                                       Journalentry::create( [
                                             'cr'=>$request->payment, 
                                             'mainaccount_id'=>$request->mainaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'share']); 


                                  //jornal dr member share account

                                        Journalentry::create( [
                                             'dr'=>$request->payment, 
                                             'memberaccount_id'=>$request->memberaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'share']); 




                          return view('loans.receipt.repayment',compact('payment','getpaymenttype','member')); 
                } else{


                    return back()->with('error','No more shares are needed');
                }
                  

                     }elseif($request->payment_type=='saving'){

                        $savingaccount=$member->memberaccount->where('name','=','Saving Account')->first(); 
     
                           $saving=Membersaving::create([
                               
                               'member_id'=>$request->member,
                               'saving_code'=>$savingaccount->account_no,
                               'amount'=>$request->payment,
                               'user_id'=>Auth::guard('member')->user()->member_id,
                               'saving_date'=>date('Y-m-d H:i:s')
                           ]);


                                  $payment=Payment::create([
                                 'membersaving_id'=>$saving->id,
                                 'amount'=>$request->payment,
                                 'narration'=>$request->narration,
                                 'paid_by'=>Auth::guard('member')->user()->member_id, 
                                 'payment_type'=>$request->payment_method,
                                 'state'=>'in',
                                 'date'=>date('Y-m-d')
                             
                         ]);


                                     Bankaccount::create([
                                       'dr'=>$request->payment,
                                        'mainaccount_id'=>$request->mainaccount_id,
                                        'memberaccount_id'=>$request->memberaccount_id,
                                        'description'=>'saving',
                                         'date'=>date('Y-m-d')
                                            
                                      ]);

                               Journalentry::create( [
                                             'cr'=>$request->payment, 
                                             'mainaccount_id'=>$request->mainaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'saving']); 

                                  //jornal dr member saving account

                                        Journalentry::create( [
                                             'dr'=>$request->payment, 
                                             'memberaccount_id'=>$request->memberaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'saving']); 


                            return view('loans.receipt.repayment',compact('payment','getpaymenttype','member'));



                     }else{ 
                                // $member=Member::find($member_id);
                                  if($request->payment==$member->regfee->amount){



                                  
                                  $memberregfee=$member->regfee;
                                  $memberregfee->status='paid';
                                   $memberregfee->save();

                                  $member->status='active';
                                  $member->save();

                                 $payment=Payment::create([
                                 'regfee_id'=>$memberregfee->id,
                                 'amount'=>$request->payment,
                                 'narration'=>$request->narration,
                                 'paid_by'=>Auth::guard('member')->user()->member_id, 
                                 'payment_type'=>$request->payment_method,
                                 'state'=>'in',
                                 'date'=>date('Y-m-d')  
                         ]);




                                    Bankaccount::create([
                                       'dr'=>$request->payment,
                                        'mainaccount_id'=>$request->mainaccount_id,
                                        'memberaccount_id'=>$request->memberaccount_id,
                                        'description'=>'registration fee',
                                         'date'=>date('Y-m-d')
                                            
                                      ]); 



                                      Receivableaccount::create([
                                     'cr'=>$request->payment,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$request->memberaccount_id,
                                      'description'=>'registration fee',
                                       'date'=>date('Y-m-d')
                                   ]);


                                        Journalentry::create( [
                                             'cr'=>$request->payment, 
                                             'mainaccount_id'=>$request->mainaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'registration fee']); 

                                  //jornal dr member saving account

                                        Journalentry::create( [
                                             'dr'=>$request->payment, 
                                             'memberaccount_id'=>$request->memberaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'registration fee']); 


                                         return view('loans.receipt.repayment',compact('payment','getpaymenttype','member'));



                               }else{

                                 return back()->with('error','Please enter the fee required')->withInput();
                               }


                     }

                
                    }


                    public function repayment_slip($member_id,$amountinput,$getpaymenttype){

                          $member=Member::find($member_id);

                         $pdf = PDF::loadView('loans.receipt.repayment',compact('member','amountinput','getpaymenttype'));
                          return $pdf->download('paid.pdf');
                          
                    }


      public function previous_payment($id){


         $loancategories=LoanCategory::all();
  

           return view('payment.previous_payment',compact('loancategories'));


      }


      public function savings_shares_excel(){

        return response()->download(base_path('\Payment-Excel\payment-excel.xlsx'));
      }


      public function store_shares_savings_excel(Request $request, $id){

         
          
          $this->validate($request,[
             'excel'=>'required|mimes:xlsx'   
               ]);

            $member=Member::find($id);
          

             // dd($share

            $member_savingaccount=$member->memberaccount->where('name','=','Saving Account')->first(); 

            $member_shareaccount=$member->memberaccount->where('name','=','Share Account')->first();
             $main_shareaccount=Mainaccount::where('name','=','Share Account')->first();
            $main_savingaccount=Mainaccount::where('name','=','Saving Account')->first();




           if($request->hasFile('excel')){

                     $path = $request->excel->getRealPath();
                      $extension = $request->excel->getClientOriginalExtension();
                      $filename=$member->first_name.'-'.$member->last_name.'.'.$extension;
                       
                       $uploadedLedgerpath = $request->excel->storeAs(
                         'UploadedLedger',$filename
                            );
  


                     $data = Excel::load($path, function($reader) {
                })->get();
                              
                   

                     if(!empty($data) && $data->count()){

                             
                                
                            foreach($data as $key=>$value){


                                    
                                   $share_amount=explode(',', $value->share_amount);
                                   $saving_amount=explode(',', $value->saving_amount);


                                   $date0=$value->date;
                                   $date0=str_replace('/', '-', $date0);
                                    $dateex=explode('-', $date0);
                                 //   var_dump($dateex);

                                   $yr=$dateex[0];
                                   $m=$dateex[1];
                                   $d=$dateex[2];

                                    // dd($m);*/

                                 //  $date = date('Y-m-d', strtotime(str_replace('/', '-', $date0)));

                                     /* $month=date('m', strtotime($date));
                                      $day1=date('d', strtotime($date));
                                      $year=date('Y', strtotime($date));*/
                                       

                                       if(checkdate( (int)$m, (int)$d, (int)$yr)===False){
                                          
                                           $d=$d-1;

                                           $date=$yr.'-'.$m.'-'.$d;

                                           }
                                           else $date=$date0;
                                           $date = date('Y-m-d', strtotime(str_replace('/', '-', $date)));


                                            if(( $value->saving_amount>1) && (!empty($value->saving_amount))){
                                 $saving=Membersaving::create([   
                               'member_id'=>$member->member_id,
                               'saving_code'=>$member_savingaccount->account_no.Member::numeric(2),
                               'amount'=>$value->saving_amount,
                               'user_id'=>Auth::guard('member')->user()->member_id,
                               'saving_date'=>$date,
                               'state'=>'in'
                           ]);
                                 
                                 $payment=Payment::create([
                                 'membersaving_id'=>$saving->id,
                                 'amount'=>$value->saving_amount,
                                 'narration'=>'savings',
                                 'paid_by'=>Auth::guard('member')->user()->member_id, 
                                 'payment_type'=>'salary',
                                 'state'=>'in',
                                 'date'=>$date
                           
                         ]);

                                   Bankaccount::create([
                                       'dr'=>$value->saving_amount,
                                        'mainaccount_id'=>$main_savingaccount->id,
                                        'memberaccount_id'=>$member_savingaccount->id,
                                        'description'=>'saving',
                                         'date'=>$date,
                                         'payment_id'=>$payment->id    
                                      ]); 

                                      }

                                      if(($value->share_amount>1) && (!empty($value->share_amount))){
                                     
                               $share=Member_share::create([
                               'member_id'=>$member->member_id,
                               'amount'=>$value->share_amount,
                               'share_date'=>$date,
                               'user_id'=>Auth::guard('member')->user()->member_id,
                               'No_shares'=>$value->share_amount/1000,
                               'state'=>'in'

                         ]);
                                          $payment=Payment::create([
                                 'member_share_id'=>$share->id,
                                 'amount'=>$value->share_amount,
                                 'narration'=>'shares',
                                 'paid_by'=>Auth::guard('member')->user()->member_id, 
                                 'payment_type'=>'salary',
                                 'state'=>'in',
                                 'date'=>$date
                           
                         ]);

                                   Bankaccount::create([
                                       'dr'=>$value->share_amount,
                                        'mainaccount_id'=>$main_shareaccount->id,
                                        'memberaccount_id'=>$member_shareaccount->id,
                                        'description'=>'share',
                                         'date'=>$date,
                                          'payment_id'=>$payment->id  
                                            
                                      ]); 
                             }
     
                            }
                          }

                   }

            return back()->with('status','Successfully Posted');
      }



      public function previous_loan($principle,$interest,$duration,$pcategory,$issued_date,$startpayment,$paidmonths,$id){

                   
                    
                 // dd($interest);    

                 
      return view('modal.previous_loan',compact('principle','interest','pcategory','duration','issued_date','startpayment','paidmonths','id'));      
      }


      public function post_previous_loan(Request $request,$id){

                      // dd($request->all());

           
             $member=Member::findorfail($id);

               $member_loanaccount=$member->memberaccount->where('name','Loan Account')->first();
               $member_interestaccount=$member->memberaccount->where('name','Interest Account')->first();

               $main_loanaccount=Mainaccount::where('name','=','Loan Account')->first();

               $main_interestaccount=Mainaccount::where('name','=','Interest Account')->first();
               $bankaccount=Mainaccount::where('name','=','Bank Account')->first();

                                

         $loan=Loan::create([
              'loanInssue_date'=>$request->issued_date,
                            'inssued_by'=>Auth::guard('member')->user()->member_id,
                            'loan_status'=>($request->paidmonths==$request->duration) ? 'finished' :'paid',
                            'loancategory_id'=>$request->pcategory,
                            'member_id'=>$member->member_id,
                            'duration'=>$request->duration,
                            'interestmethod_id'=>1,
                            'interest'=>$request->percentage_interest,
                            'principle'=>$request->principle,
                            'repayment_date'=>$request->startpayment[0],
                            'no_of_installments'=>$request->duration,
                            'mounthlyrepayment_amount'=>$request->monthamount,
                            'mounthlyrepayment_principle'=>round($request->principle/$request->duration,2), 
                           'mounthlyrepayment_interest'=>$request->monthinterest,
                            'narration'=>'loan',
                        
                           'insurance_id'=>Insurance::first()->id     

         ]);
                //create schedule

                              //payment table
                           $payment=Payment::create([
                                 'loan_id'=>$loan->id,
                                 'amount'=>$request->principle,
                                 'narration'=>'loan',
                                 'paid_by'=>Auth::guard('member')->user()->member_id, 
                                 'payment_type'=>'cash',
                                 'state'=>'out',
                                 'date'=>$request->issued_date
                             
                         ]);

                           Bankaccount::create([

                                  'memberaccount_id'=>$member_loanaccount->id,
                                  'mainaccount_id'=>$main_loanaccount->id,
                                  'cr'=>$request->principle,
                                  'description'=>'loan',
                                  'date'=>$request->issued_date,
                                  'payment_id'=>$payment->id
                                      ]);

                                      //receivable


                                  Receivableaccount::create([
                                     'dr'=>$request->principle,
                                     'memberaccount_id'=>$member_loanaccount->id,
                                      'description'=>'loan',
                                       'date'=>$request->issued_date,
                                       'payment_id'=>$payment->id
                                   ]);


                                     //loan account 

                                    Loanaccount::create([
                                       'memberaccount_id'=>$member_loanaccount->id,
                                       'mainaccount_id'=>$bankaccount->id,
                                       'dr'=>$request->principle,
                                       'description'=>'loan',
                                       'date'=>$request->issued_date,
                                       'payment_id'=>$payment->id
                                    ]);
  

                             for($i=0; $i<count($request->startpayment); $i++){

                                           
                               $date=$request->startpayment[$i];

                                $loanschedule=Loanschedule::create([                      
                                'loan_id'=>$loan->id,                   
                                 'monthprinciple'=>$request->principle/$request->duration, //loan schedule
                                 'monthinterest'=>$request->monthinterest,
                                 'duedate'=>$date,
                                 'month'=>date('m',strtotime($date)),
                                 'status'=>'unpaid'
                                 
                           ]);

                                
                               }


                             if ($request->paidmonths>0) {

                      for($i=0; $i<$request->paidmonths; $i++){

                                  
                                   $date=$request->startpayment[$i];     

                            foreach($loan->loanschedule as $updateloanschedule){
                           
                                           if($updateloanschedule->duedate==$date){
                                              $updateloanschedule->status='paid';
                                              $updateloanschedule->save();


                                               $payment=Payment::create([
                                 'loan_id'=>$loan->id,
                                 'amount'=>$request->amount[$i],
                                 'narration'=>'loan',
                                 'paid_by'=>Auth::guard('member')->user()->member_id, 
                                 'payment_type'=>'salary',
                                 'state'=>'in',
                                 'date'=>$request->startpayment[$i]
                             
                         ]);


                                    Loanaccount::create([
                                       'memberaccount_id'=>$member_loanaccount->id,
                                       'mainaccount_id'=>$bankaccount->id,
                                       'cr'=>$request->principle,
                                       'description'=>'loan',
                                       'date'=>$request->startpayment[$i],
                                       'payment_id'=>$payment->id
                                    ]);

                                                   $repayment=Repayment::create([
                                    'loanschedule_id'=>$updateloanschedule->id,
                                     'principlepayed'=>((float)$request->amount[$i]-(float)$request->interest[$i]),
                                     'interestpayed'=>$request->interest[$i],
                                      'amountpayed'=>$request->amount[$i],
                                     'paymentdate'=>$request->startpayment[$i],
                                     'user_id'=>Auth::guard('member')->user()->member_id,
                                      'payment_id'=>$payment->id
                                      ]); 



                                                     // dr bankaccount
                                                   Bankaccount::create([

                                  'memberaccount_id'=>$member_loanaccount->id,
                                  'mainaccount_id'=>$main_loanaccount->id,
                                  'dr'=>((float)$request->amount[$i]-(float)$request->interest[$i]),
                                  'description'=>'loan',
                                  'date'=>$request->startpayment[$i],
                                  'payment_id'=>$payment->id
                                      ]); 


                                          //interest account

                                       Bankaccount::create([

                                  'mainaccount_id'=>$main_interestaccount->id,
                                  'memberaccount_id'=>$member_interestaccount->id,
                                  'dr'=>$request->interest[$i],
                                  'description'=>'interest',
                                  'date'=>$request->startpayment[$i],
                                     'payment_id'=>$payment->id
                                      ]);    





                                       //loan  account receivable 

                                      Receivableaccount::create([
                                     'cr'=>((float)$request->amount[$i]-(float)$request->interest[$i]),
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$member_loanaccount->id,
                                      'description'=>'loan',
                                       'date'=>$request->startpayment[$i],
                                        'payment_id'=>$payment->id
                                   ]);
                                               //interest in receivable
                                       Receivableaccount::create([
                                     'cr'=>$request->interest[$i],
                                     'memberaccount_id'=>$member_interestaccount->id,
                                      'mainaccount_id'=>$bankaccount->id,
                                      'description'=>'interest',
                                       'date'=>$request->startpayment[$i],
                                       'payment_id'=>$payment->id
                                   ]);     

                                                    }
                                            }
                           }  

                         }

            return back()->with('status','Successfully Posted');
      }

         

         public function refund(){

                   
            return view('payment.refund');
         }

         public function post_refund(Request $request ,$id){



               $member=Member::find($id);
                            $amountinput=$request->payment;
                             $getpaymenttype=$request->payment_type;

                          

                      $this->validate(request(),[
                            'payment_type'=>'required',
                            'payment'=>'required|numeric',
                            'payment_method'=>'required',
                            'narration'=>'required'
                      ]);
                  

              

                   $bankaccount=Mainaccount::where('name','=','Bank Account')
                                            ->first();

                                     //dd($request->all());
                      if($request->payment_type=='share'){

                              $share=Share::sum('share_value');
                             $max_shares=Share::select('max_shares')->first()->max_shares;
                                    
                                   $share_amount=Member::find($request->member)->no_shares->where('state','in')->sum('amount');
        
                                       
                             if($request->payment<=$share_amount){      

                                   
                         $share=Member_share::create([
                              
                               'member_id'=>$request->member,
                               'amount'=>$request->payment,
                               'share_date'=>$request->refund_date,
                               'user_id'=>Auth::guard('member')->user()->member_id,
                               'No_shares'=>$request->payment/$share,
                                'state'=>'out'

                         ]);

                                 $payment=Payment::create([
                                 'member_share_id'=>$share->id,
                                 'amount'=>$request->payment,
                                 'narration'=>$request->narration,
                                 'paid_by'=>Auth::guard('member')->user()->member_id, 
                                 'payment_type'=>$request->payment_method,
                                 'state'=>'out',
                                 'date'=>$request->refund_date
                             
                         ]);
                               


                                   //jornal cr main saccoss

                                      Bankaccount::create([
                                       'cr'=>$request->payment,
                                        'mainaccount_id'=>$request->mainaccount_id,
                                        'memberaccount_id'=>$request->memberaccount_id,
                                        'description'=>'share',
                                         'date'=>$request->refund_date,
                                         'payment_id'=>$payment->id
                                            
                                      ]);

                              
                         return back()->with('status','Successfully Refunded');
                           }else{

                              return back()->with('error','You cannot refund more than your total shares amount ' . number_format($share_amount,2))->withInput();
                          }
              
                  

                     }else{

                        $savingaccount=$member->memberaccount->where('name','=','Saving Account')->first();

                              $saving_amount=Member::find($request->member)->savingamount->where('state','in')->sum('amount'); 
     
                                   if($request->payment<=$saving_amount){

                                    $saving=Membersaving::create([
                               
                               'member_id'=>$request->member,
                               'saving_code'=>$savingaccount->account_no,
                               'amount'=>$request->payment,
                               'user_id'=>Auth::guard('member')->user()->member_id,
                               'saving_date'=>$request->refund_date,
                               'state'=>'out'
                           ]);


                                  $payment=Payment::create([
                                 'membersaving_id'=>$saving->id,
                                 'amount'=>$request->payment,
                                 'narration'=>$request->narration,
                                 'paid_by'=>Auth::guard('member')->user()->member_id, 
                                 'payment_type'=>$request->payment_method,
                                 'state'=>'out',
                                 'date'=>$request->refund_date
                             
                         ]);


                                     Bankaccount::create([
                                       'cr'=>$request->payment,
                                        'mainaccount_id'=>$request->mainaccount_id,
                                        'memberaccount_id'=>$request->memberaccount_id,
                                        'description'=>'saving',
                                         'date'=>$request->refund_date,
                                         'payment_id'=>$payment->id
                                            
                                      ]);



                            return back()->with('status','Successfully Refunded');
                                   }else{

                                    return back()->with('error','You cannot refund more than your total savings amount ' . number_format($saving_amount,2))->withInput(); 
                                   }
                                                
         }


       }
}


                       