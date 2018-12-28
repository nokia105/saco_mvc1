<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loan;
use App\Collateral;
use App\Loaninsuarance;
use App\Loanschedule;
use App\Repayment;
use App\Membersaving;
use App\Feescategory;
use App\Member_share;
use App\Share;
use App\Interestmethod;
use Carbon\Carbon;
use DB;
use App\Code;
use App\Monthpenaty;
use App\Month;
use App\Year;
use App\Journalentry;
use App\Bankaccount;
use App\Expense;
use App\Tax;
use App\Memberaccount;
use App\Profitdisribution;

class ReportsController extends Controller
{
    //

     
     function __construct(){

       return $this->middleware('auth:member');
     }

     public function loans_month(){
                 
        /* $months=Loanschedule::get()->groupBy(function($d){

           return  Carbon::parse($d->duedate)->format('F');

         });*/

          //$months=\DB::select(\DB::raw("SELECT `month` as monthnumber FROM `loanschedules` GROUP BY `month`"));

     	 return view('reports.loans_month');


     }

      public function retrive_loans_month(Request $request){

                  
             $this->validate(request(),[
                'month'=>'required'
             ]);

             

              $monthyear=explode('/',$request->month);

                $month=substr($monthyear[0],1);
                $year=$monthyear[1];

           $loanschedule=Loanschedule::whereMonth('duedate','=',$month)
                                       ->whereYear('duedate','=',$year)->get();


             $code=Memberaccount::where('name','=','Loan Account')->first()->account_no;

              //dd($loanschedule);

     	 return view('reports.retrive_loans_month',compact('loanschedule','month','code'));
     }

       public function loans_time_range(){



                 return view('reports.loans_time_range');
       }

       public function retrive_loans_time_range(Request $request){
                             

                    $this->validate(request(),[
                          'startDate'=>'required',
                          'endDate'=>'required'
                    ]);

                      $startDate=$request->startDate;
                      $endDate=$request->endDate;

                      $code=Memberaccount::where('name','=','Loan Account')->first()->account_no;

                    $loans=Loan::whereBetween('loanInssue_date',[$request->startDate,$request->endDate])->get();

                       //dd($loan);
             return view('reports.retrive_loans_time_range',compact('loans','code','startDate','endDate'));
       }


       public function expected_profit(){

           // $month=$

             
          return view('reports.expected_profitMonth_interval');
       }


       public function retrive_expected_profit(Request $request){

            $this->validate(request(),[
                          'startDate'=>'required',
                          'endDate'=>'required'
                    ]);

                      $startDate=$request->startDate;
                      $endDate=$request->endDate;

                           

                      /*$loans=Loan::select( 'id','loanInssue_date','mounthlyrepayment_principle','mounthlyrepayment_interest',DB::raw('MONTH(loanInssue_date) as monthnuber'))
                  
                                 ->whereBetween('loanInssue_date',[$request->startDate,$request->endDate])
                                  ->where('loan_status','=','approved')
                                  ->groupBy(DB::raw('MONTH(loanInssue_date)'))
                                 ->get();*/

                 
            $loans=\DB::select(\DB::raw("SELECT `month` as monthnumber, SUM(monthprinciple) as principlesum, SUM(monthinterest) as interestsum, COUNT(`loans`.id) as no_loans FROM `loanschedules` INNER JOIN `loans` ON `loans`.`id`=`loanschedules`.`loan_id` WHERE `loan_status`='approved' and duedate >='$startDate' and duedate <='$endDate' GROUP BY `month`"));

                    // dd($loans);

           return view('reports.retrive_expected_profit',compact('startDate','endDate','loans'));
       }

       public function income_statments(){

        return view('reports.finacial.income_statments');
       }

       public function duration_incomestatment(Request $request){

                         

                      $year=$request->year;
                      $period=explode('-', $request->period);
                      $startmonth=$period[0];
                      $endmonth=$period[1];

                 


                   $otherincomes=DB::table('mainaccounts')
                    ->leftJoin('bankaccounts','bankaccounts.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(bankaccounts.dr) as dramount'),DB::raw('mainaccounts.name as mainnames'))
                      ->where('categoryaccountstypes.name','=','Other Income')
                       ->whereYear('bankaccounts.date',$year)
                    ->whereRaw("month(bankaccounts.date) between $startmonth and $endmonth")
                    ->groupBy('mainaccount_id')
                   
                    ->get();
                   
                   $operatinalexpenses=DB::table('categoryaccountstypes')
                    ->leftJoin('mainaccounts','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                   ->join('expenses','expenses.mainaccount_id','=','mainaccounts.id') 
                    ->select(DB::raw('SUM(expenses.dr) as dramount'),DB::raw('mainaccounts.name as mainnames'))
                   ->where('categoryaccountstypes.name','=','Operatinal Expenses')
                    ->whereRaw("month(expenses.date) between $startmonth and $endmonth")
                       ->whereYear('expenses.date',$year)
                    ->groupBy('mainaccount_id')
                    ->get();

                    $busnessexpenses=DB::table('mainaccounts')->
                    leftJoin('expenses','expenses.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(expenses.dr) as dramount'),DB::raw('mainaccounts.name as mainnames'))
                    ->where('categoryaccountstypes.name','=','Busness Expenses')
                    ->whereRaw("month(expenses.date) between $startmonth and $endmonth")
                       ->whereYear('expenses.date',$year)
                    ->groupBy('mainaccount_id')
                    ->get();


                    $otherexpenses=DB::table('mainaccounts')->
                    leftJoin('expenses','expenses.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(expenses.dr) as dramount'),DB::raw('mainaccounts.name as mainnames'))
                    ->where('categoryaccountstypes.name','=','Other Expenses')
                    ->whereRaw("month(expenses.date) between $startmonth and $endmonth")
                      ->whereYear('expenses.date',$year)
                    ->groupBy('mainaccount_id')
                    ->get();


                       
                    $loanncomes=DB::table('mainaccounts')
                    ->leftJoin('bankaccounts','bankaccounts.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(bankaccounts.dr) as dramount'),DB::raw('mainaccounts.name as mainnames'))
                      ->where('categoryaccountstypes.name','=','Loan Interest')
                    ->whereRaw("month(bankaccounts.date) between $startmonth and $endmonth")
                      ->whereYear('bankaccounts.date',$year)
                    ->groupBy('mainaccount_id')
                    ->get();


                  $taxpecentage=Tax::where('year','=',$year)->sum('percentage');

                 


                return view('reports.finacial.duration_incomestatment',compact('endmonth','startmonth','otherincomes','loanncomes','operatinalexpenses','busnessexpenses','otherexpenses','year','taxpecentage','startmonth','endmonth'));
       }


        public function balance_sheets(){



            return view('reports.finacial.balance_sheets');
        }


         public function findbalance_sheets(Request $request){

                     //Asset=Liability+Equity

             $year=$request->year;

          
         $currentassets=DB::table('bankaccounts')
                    ->join('mainaccounts','bankaccounts.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('(SUM(bankaccounts.cr)) as accountsum'),DB::raw('mainaccounts.name as mainnames'))
                      ->where('categoryaccountstypes.name','=','Current Asset')
                        ->whereYear('bankaccounts.date',$year)
                      ->where('mainaccounts.name','!=','Bank Account')
                    ->groupBy('mainaccount_id')
                    ->get();


                  

                       $bankaccount=(Bankaccount::sum('dr'))-(Bankaccount::sum('cr'));
                    
                    

            
                    $fixedassets=DB::table('mainaccounts')
                    ->leftJoin('bankaccounts','bankaccounts.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(bankaccounts.cr) as cramount'),DB::raw('mainaccounts.name as mainnames'))
                      ->where('categoryaccountstypes.name','=','Fixed Asset')
                     /*->whereRaw(" year(bankaccounts.date)",$year)*/
                    ->groupBy('mainaccount_id')
                    ->get();
          /*  $cashaccounts=DB::table('journalentries')
                                  ->join('mainaccounts','journalentries.mainaccount_id','=','mainaccounts.id')
                                  ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                                  ->select(DB::raw('(SUM(journalentries.dr)-SUM(journalentries.cr)) as accountsum'),DB::raw('mainaccounts.name as mainnames'))
                                   ->whereYear('journalentries.date',$year)
                 
                    ->groupBy('mainaccount_id')
                    ->get();*/

                     $capitals=DB::table('mainaccounts')
                    ->leftJoin('bankaccounts','bankaccounts.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(bankaccounts.dr) as dramount'),DB::raw('mainaccounts.name as mainnames'))
                      ->where('categoryaccountstypes.name','=','Current Capital')
                     ->whereYear('bankaccounts.date',$year)
                    ->groupBy('mainaccount_id')
                    ->get();

             return view('reports.finacial.findbalance_sheets',compact('currentassets','cashaccounts','fixedassets','bankaccount','capitals','year'));
         }


          public function savings_reports(){


              return view('reports.savings_index');
          }

          public function savings_reports_time(Request $request){

                $this->validate(request(),[
                          'startDate'=>'required',
                          'endDate'=>'required'
                 ]);

                      $startDate=$request->startDate;
                      $endDate=$request->endDate;


       $savings=Membersaving::whereBetween('saving_date',[$request->startDate,$request->endDate])->get();


             return view('reports.savings_reports_time',compact('savings','startDate','endDate'));
          }

            public function shares_reports(){


              return view('reports.shares_index');

          }


            public function shares_reports_time(Request $request){


                $this->validate(request(),[
                          'startDate'=>'required',
                          'endDate'=>'required'
                 ]);

                      $startDate=$request->startDate;
                      $endDate=$request->endDate;


       $shares=Member_share::whereBetween('share_date',[$request->startDate,$request->endDate])->get();


             return view('reports.shares_reports_time',compact('shares','startDate','endDate'));
          }


           public function cash_flow(){


               return view('reports.finacial.cash_flow');
           }



           public function find_cash_flow(Request $request){

                  $year=$request->year;
                  $preyear=$request->year-1;



              return view('reports.finacial.find_cash_flow',compact('year','preyear'));

           }


           public function capital_change(){


              return view('reports.finacial.capital_change');
           }


           public function find_capital_change(Request $request){

             /*  SELECT SUM(`dr`) as total1 FROM `bankaccounts` INNER JOIN mainaccounts ON `mainaccounts`.`id`=`bankaccounts`.`mainaccount_id` INNER JOIN categoryaccountstypes ON `categoryaccountstypes`.`id`=`mainaccounts`.`categoryaccountstype_id` WHERE `categoryaccountstypes`.`name`='Other Income' AND year(bankaccounts.date,2018)*/


                   $year=$request->year;
                  $preyear=$request->year-1;
                  $two_beforeyear=$request->year-2;

                     //incomes

              $otherincomes=DB::table('mainaccounts')
                    ->leftJoin('bankaccounts','bankaccounts.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(bankaccounts.dr) as othericome'))
                      ->where('categoryaccountstypes.name','=','Other Income')
                      ->whereYear('bankaccounts.date',$year)->first(); 

                  $loanincomes=DB::table('mainaccounts')
                    ->leftJoin('bankaccounts','bankaccounts.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(bankaccounts.dr) as loanincome'))
                      ->where('categoryaccountstypes.name','=','Loan Interest')
                      ->whereYear('bankaccounts.date',$year)
                    ->first();  

                           //expenses

                 $operatinalexpenses=DB::table('categoryaccountstypes')
                    ->leftJoin('mainaccounts','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                   ->join('expenses','expenses.mainaccount_id','=','mainaccounts.id') 
                    ->select(DB::raw('SUM(expenses.dr) as operationexpenses'))
                   ->where('categoryaccountstypes.name','=','Operatinal Expenses')
                       ->whereYear('expenses.date',$year)
                    ->first(); 


                     $busnessexpenses=DB::table('mainaccounts')->
                    leftJoin('expenses','expenses.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(expenses.dr) as busnessexpenses'))
                    ->where('categoryaccountstypes.name','=','Busness Expenses')
                       ->whereYear('expenses.date',$year)->first();
              
                          $otherexpenses=DB::table('mainaccounts')->
                    leftJoin('expenses','expenses.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(expenses.dr) as otherexpenses'))
                    ->where('categoryaccountstypes.name','=','Other Expenses')
                      ->whereYear('expenses.date',$year)
                    ->first();

                 $taxpecentage=Tax::where('year','=',$year)->sum('percentage');


        $profitbeforetax=($otherincomes->othericome+$loanincomes->loanincome)-($operatinalexpenses->operationexpenses+$busnessexpenses->busnessexpenses+$otherexpenses->otherexpenses);

     
                                

               $profitaftertax=$profitbeforetax-($taxpecentage/100*$profitbeforetax);
               
              
                      //  previous year               

                $preotherincomes=DB::table('mainaccounts')
                    ->leftJoin('bankaccounts','bankaccounts.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(bankaccounts.dr) as othericome'))
                      ->where('categoryaccountstypes.name','=','Other Income')
                      ->whereYear('bankaccounts.date',$preyear)->first(); 


                         $preloanincomes=DB::table('mainaccounts')
                    ->leftJoin('bankaccounts','bankaccounts.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(bankaccounts.dr) as loanincome'))
                      ->where('categoryaccountstypes.name','=','Loan Interest')
                      ->whereYear('bankaccounts.date',$preyear)
                    ->first();  

                           //expenses

                 $preoperatinalexpenses=DB::table('categoryaccountstypes')
                    ->leftJoin('mainaccounts','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                   ->join('expenses','expenses.mainaccount_id','=','mainaccounts.id') 
                    ->select(DB::raw('SUM(expenses.dr) as operationexpenses'))
                   ->where('categoryaccountstypes.name','=','Operatinal Expenses')
                       ->whereYear('expenses.date',$preyear)
                    ->first(); 

                     $prebusnessexpenses=DB::table('mainaccounts')->
                    leftJoin('expenses','expenses.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(expenses.dr) as busnessexpenses'))
                    ->where('categoryaccountstypes.name','=','Busness Expenses')
                       ->whereYear('expenses.date',$preyear)->first();
              
                          $preotherexpenses=DB::table('mainaccounts')->
                    leftJoin('expenses','expenses.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(expenses.dr) as otherexpenses'))
                    ->where('categoryaccountstypes.name','=','Other Expenses')
                      ->whereYear('expenses.date',$preyear)
                    ->first();

                 $pretaxpecentage=Tax::where('year','=',$preyear)->sum('percentage');
                   

            $preprofitbeforetax=($preotherincomes->othericome+$preloanincomes->loanincome)-($preoperatinalexpenses->operationexpenses+$prebusnessexpenses->busnessexpenses+$preotherexpenses->otherexpenses);

             $preprofitaftertax=$preprofitbeforetax-($pretaxpecentage/100*$preprofitbeforetax);



                      //two years back

                    $two_beforeotherincomes=DB::table('mainaccounts')
                    ->leftJoin('bankaccounts','bankaccounts.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(bankaccounts.dr) as othericome'))
                      ->where('categoryaccountstypes.name','=','Other Income')
                      ->whereYear('bankaccounts.date',$two_beforeyear)->first(); 


                         $two_beforeloanincomes=DB::table('mainaccounts')
                    ->leftJoin('bankaccounts','bankaccounts.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(bankaccounts.dr) as loanincome'))
                      ->where('categoryaccountstypes.name','=','Loan Interest')
                      ->whereYear('bankaccounts.date',$two_beforeyear)
                    ->first();  

                           //expenses

                 $two_beforeoperatinalexpenses=DB::table('categoryaccountstypes')
                    ->leftJoin('mainaccounts','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                   ->join('expenses','expenses.mainaccount_id','=','mainaccounts.id') 
                    ->select(DB::raw('SUM(expenses.dr) as operationexpenses'))
                   ->where('categoryaccountstypes.name','=','Operatinal Expenses')
                       ->whereYear('expenses.date',$two_beforeyear)
                    ->first(); 

                     $two_beforebusnessexpenses=DB::table('mainaccounts')->
                    leftJoin('expenses','expenses.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(expenses.dr) as busnessexpenses'))
                    ->where('categoryaccountstypes.name','=','Busness Expenses')
                       ->whereYear('expenses.date',$two_beforeyear)->first();
              
                          $two_beforeotherexpenses=DB::table('mainaccounts')->
                    leftJoin('expenses','expenses.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(expenses.dr) as otherexpenses'))
                    ->where('categoryaccountstypes.name','=','Other Expenses')
                      ->whereYear('expenses.date',$two_beforeyear)
                    ->first();

                 $two_beforetaxpecentage=Tax::where('year','=',$two_beforeyear)->sum('percentage');
                   

            $two_beforeprofitbeforetax=($two_beforeotherincomes->othericome+$two_beforeloanincomes->loanincome)-($two_beforeoperatinalexpenses->operationexpenses+$two_beforebusnessexpenses->busnessexpenses+$two_beforeotherexpenses->otherexpenses);

             $two_beforeprofitaftertax=$two_beforeprofitbeforetax-($two_beforetaxpecentage/100*$two_beforeprofitbeforetax);   
                    

               return view('reports.finacial.find_capital_change',compact('year','preyear','profitaftertax','preprofitaftertax'));
           }
           
           
           
            public function loanreportselection(){


              return view('reports.loans.loanreportselection');
           }

             public function find_loanreport(Request $request){
                
                      $code=Memberaccount::where('name','=','Loan Account')->first()->account_no;

                      if($request->duration=='month'){

                           $monthyear=explode('/',$request->month);

                                 $month=$monthyear[0];
                                  $year=$monthyear[1];
                                  //  dd($month);

                           if($request->loan=='inssued'){
                           

                           $loans=Loan::where(function ($query) use($month,$year){
                             $query->whereMonth('loanInssue_date','=',$month)
                           ->whereYear('loanInssue_date','=',$year);
                            })->where(function ($query) {
                                 $query->where('loan_status','=','paid')
                                 ->orWhere('loan_status','finished');
                          })->get(); 

                              return view('reports.loans.month.inssued',compact('year','month','loans','code'));

                           }elseif($request->loan=='finished'){
                              
                                $loans=Loan::where('loan_status','finished')->whereYear('loanInssue_date','=',$year)->whereMonth('loanInssue_date','=',$month)->get();
                                 // dd($loans);
                                     return view('reports.loans.month.finished',compact('year','month','loans','code'));
                           }

                        
                      }elseif($request->duration=='cummulative'){

                           $this->validate($request,[
                            'startDate'=>'required',
                            'endDate'=>'required'
                           ]);
                                      $startDate=$request->startDate;
                                       $endDate=$request->endDate;

                             if($request->loan=='inssued'){
     
                    $loans=Loan::where(function ($query) use($startDate,$endDate){
                             $query->whereBetween('loanInssue_date',[$startDate,$endDate]);
                                 
                            })->where(function ($query) {
                                 $query->where('loan_status','=','paid')
                               ->orWhere('loan_status','=','finished');
                          })->get();       

                       return view('reports.loans.cummulative.inssued',compact('loans','startDate','endDate','code'));

                             }elseif($request->loan=='finished'){

                                $loans=Loan::whereBetween('loanInssue_date',[$startDate,$endDate])->where('loan_status','finished')->get();
                                 
                                return view('reports.loans.cummulative.finished',compact('loans','startDate','endDate','code'));  
                             }else{

                                      return back();
                             }


                           
                      }elseif($request->duration=='quatery'){
                         
                      $year=$request->year;
                      $period=explode('-', $request->quatery);
                      $startmonth=$period[0];
                      $endmonth=$period[1];
                              
                              if($request->loan=='inssued'){


                     $loans=Loan::where(function ($query) use($startmonth,$endmonth,$year){
                             $query->whereRaw("month(loanInssue_date) between $startmonth and $endmonth")
                                      ->whereYear('loanInssue_date',$year);
                            })->where(function ($query) {
                                 $query->where('loan_status','=','paid')
                               ->orWhere('loan_status','=','finished');
                          })->get(); 

                                return view('reports.loans.quatery.inssued',compact('year','startmonth','endmonth','code','loans'));
                              }elseif($request->loan=='finished'){

                                $loans=Loan::where(function ($query) use($startmonth,$endmonth,$year){
                             $query->whereRaw("month(loanInssue_date) between $startmonth and $endmonth")
                                      ->whereYear('loanInssue_date',$year);
                            })->where(function ($query) {
                                 $query->where('loan_status','=','finished');
                       
                          })->get();

                           return view('reports.loans.quatery.finished',compact('year','startmonth','endmonth','code','loans'));  
                              }else{
                                     return back();
                              }
                     
                     

                      }elseif($request->duration=='annualy'){
                              
                              $year=$request->year;
                               if($request->loan=='inssued'){

                               $loans=Loan::where(function ($query) use($year){
                             $query->whereYear('loanInssue_date',$year);
                            })->where(function ($query) {
                                 $query->where('loan_status','=','paid')
                                 ->orwhere('loan_status','finished');
                                       
                          })->get();

                             return view('reports.loans.annualy.inssued',compact('year','code','loans'));
                               }elseif($request->loan=='finished'){
                                    
                                     $loans=Loan::where(function ($query) use($year){
                             $query->whereYear('loanInssue_date',$year);
                            })->where(function ($query) {
                                 $query->where('loan_status','=','finished');
                                            
                          })->get();
                         return view('reports.loans.annualy.finished',compact('year','code','loans'));
                               }else{
                                   return back();
                               }
                            
                      }else{

                            return back();
                      }
             }

           public function sharesreportselection(){

             return view('reports.shares.sharesreportselection');
           }


            public function find_sharesreport(Request $request){


                  //  dd($request->all());
              
               if($request->duration=='month'){

                           $monthyear=explode('/',$request->month);

                                 $month=$monthyear[0];
                                  $year=$monthyear[1];
                                  //dd($year);

                           if($request->shares=='total_share'){
                           

                           $shares=Member_share::where(function ($query) use($month,$year){
                             $query->whereMonth('share_date','=',$month)
                           ->whereYear('share_date','=',$year);
                            })->where(function ($query) {
                                 $query->where('state','=','in');
                               
                          })->get(); 

                       

                              return view('reports.shares.month.total_share',compact('year','month','shares','code'));

                           }elseif($request->shares=='refunded_share'){
                              
                                $shares=Member_share::where(function ($query) use($month,$year){
                             $query->whereMonth('share_date','=',$month)
                           ->whereYear('share_date','=',$year);
                            })->where(function ($query) {
                                 $query->where('state','=','out');
                               
                          })->get();
                                 // dd($loans);
                                     return view('reports.shares.month.refunded_shares',compact('year','month','shares','code'));
                           }

                        
                      }elseif($request->duration=='cummulative'){

                           $this->validate($request,[
                            'startDate'=>'required',
                            'endDate'=>'required'
                           ]);
                                      $startDate=$request->startDate;
                                       $endDate=$request->endDate;

                             if($request->shares=='total_share'){
     
                    $shares=Member_share::where(function ($query) use($startDate,$endDate){
                             $query->whereBetween('share_date',[$startDate,$endDate]);
                                 
                            })->where(function ($query) {
                                 $query->where('state','=','in');
                 
                          })->get();
       

                       return view('reports.shares.cummulative.total_shares',compact('year','startDate','shares','endDate'));

                             }elseif($request->shares=='refunded_share'){

                               $shares=Member_share::where(function ($query) use($startDate,$endDate){
                             $query->whereBetween('share_date',[$startDate,$endDate]);
                                 
                            })->where(function ($query) {
                                 $query->where('state','=','out');
                 
                          })->get();
       

                       return view('reports.shares.cummulative.refunded_shares',compact('year','startDate','shares','endDate'));
                                 
                              
                             }else{

                                    return back();
                             }


                           
                      }elseif($request->duration=='quatery'){
                         
                      $year=$request->year;
                      $period=explode('-', $request->quatery);
                      $startmonth=$period[0];
                      $endmonth=$period[1];
                              
                              if($request->shares=='total_share'){


                     $shares=Member_share::where(function ($query) use($startmonth,$endmonth,$year){
                             $query->whereRaw("month(share_date) between $startmonth and $endmonth")
                                      ->whereYear('share_date',$year);
                            })->where(function ($query) {
                                 $query->where('state','=','in');
                             
                          })->get(); 

                                return view('reports.shares.quatery.total_shares',compact('year','startmonth','endmonth','shares'));
                              }elseif($request->shares=='refunded_share'){

                              $shares=Member_share::where(function ($query) use($startmonth,$endmonth,$year){
                             $query->whereRaw("month(share_date) between $startmonth and $endmonth")
                                      ->whereYear('share_date',$year);
                            })->where(function ($query) {
                                 $query->where('state','=','out');
                             
                          })->get(); 

                           return view('reports.shares.quatery.refunded_shares',compact('year','startmonth','endmonth','shares'));  
                              }else{
                                       return back();
                              }
                     
                     

                      }elseif($request->duration=='annualy'){
                              
                              $year=$request->year;
                               if($request->shares=='total_share'){

                               $shares=Member_share::where(function ($query) use($year){
                             $query->whereYear('share_date',$year);
                            })->where(function ($query) {
                                 $query->where('state','=','in');
                           
                                       
                          })->get();

                             return view('reports.shares.annualy.total_shares',compact('year','shares'));

                               }elseif($request->shares=='refunded_share'){
                                    
                                      $shares=Member_share::where(function ($query) use($year){
                             $query->whereYear('share_date',$year);
                            })->where(function ($query) {
                                 $query->where('state','=','out');
                                   
                          })->get();

                         return view('reports.shares.annualy.refunded_shares',compact('year','shares'));
                               }else{

                                   return back();
                               }
                            
                      }else{

                            return back();
                      }          
           }
            public function savingsreportselection(){


             return view('reports.savings.savingsreportselection');
           }

           public function find_savingsreport(Request $request){

                          //dd($request->all());
                    if($request->duration=='month'){

                           $monthyear=explode('/',$request->month);

                                 $month=$monthyear[0];
                                  $year=$monthyear[1];
                                  //dd($year);

                           if($request->savings=='total_saving'){
                           

                           $savings=Membersaving::where(function ($query) use($month,$year){
                             $query->whereMonth('saving_date','=',$month)
                           ->whereYear('saving_date','=',$year);
                            })->where(function ($query) {
                                 $query->where('state','=','in');
                               
                          })->get(); 


                              return view('reports.savings.month.total_savings',compact('year','month','savings'));

                           }elseif($request->savings=='refunded_saving'){
                              
                                $savings=Membersaving::where(function ($query) use($month,$year){
                             $query->whereMonth('saving_date','=',$month)
                           ->whereYear('saving_date','=',$year);
                            })->where(function ($query) {
                                 $query->where('state','=','out');
                               
                          })->get();
                                 // dd($loans);
                                     return view('reports.savings.month.refunded_savings',compact('year','month','savings'));
                           }

                        
                      }elseif($request->duration=='cummulative'){

                           $this->validate($request,[
                            'startDate'=>'required',
                            'endDate'=>'required'
                           ]);
                                      $startDate=$request->startDate;
                                       $endDate=$request->endDate;

                             if($request->savings=='total_saving'){
     
                    $savings=Membersaving::where(function ($query) use($startDate,$endDate){
                             $query->whereBetween('saving_date',[$startDate,$endDate]);
                                 
                            })->where(function ($query) {
                                 $query->where('state','=','in');
                 
                          })->get();
       

                       return view('reports.savings.cummulative.total_savings',compact('year','startDate','savings','endDate'));

                             }elseif($request->savings=='refunded_saving'){

                               $savings=Membersaving::where(function ($query) use($startDate,$endDate){
                             $query->whereBetween('saving_date',[$startDate,$endDate]);
                                 
                            })->where(function ($query) {
                                 $query->where('state','=','out');
                 
                          })->get();
       

                       return view('reports.savings.cummulative.refunded_savings',compact('year','startDate','savings','endDate'));
                                 
                              
                             }else{

                                      return back();
                             }


                           
                      }elseif($request->duration=='quatery'){
                         
                      $year=$request->year;
                      $period=explode('-', $request->quatery);
                      $startmonth=$period[0];
                      $endmonth=$period[1];
                              
                              if($request->savings=='total_saving'){


                     $savings=Membersaving::where(function ($query) use($startmonth,$endmonth,$year){
                             $query->whereRaw("month(saving_date) between $startmonth and $endmonth")
                                      ->whereYear('saving_date',$year);
                            })->where(function ($query) {
                                 $query->where('state','=','in');
                             
                          })->get(); 

                                return view('reports.savings.quatery.total_savings',compact('year','startmonth','endmonth','savings'));
                              }elseif($request->savings=='refunded_saving'){

                              $savings=Membersaving::where(function ($query) use($startmonth,$endmonth,$year){
                             $query->whereRaw("month(saving_date) between $startmonth and $endmonth")
                                      ->whereYear('saving_date',$year);
                            })->where(function ($query) {
                                 $query->where('state','=','out');
                             
                          })->get(); 

                           return view('reports.savings.quatery.refunded_savings',compact('year','startmonth','endmonth','savings'));  
                              }else{

                                   return back();
                              }
                     
                     

                      }elseif($request->duration=='annualy'){
                              
                              $year=$request->year;
                               if($request->savings=='total_saving'){

                               $savings=Membersaving::where(function ($query) use($year){
                             $query->whereYear('saving_date',$year);
                            })->where(function ($query) {
                                 $query->where('state','=','in');
                           
                                       
                          })->get();

                             return view('reports.savings.annualy.total_savings',compact('year','savings'));

                               }elseif($request->savings=='refunded_saving'){
                                    
                                      $savings=Membersaving::where(function ($query) use($year){
                             $query->whereYear('saving_date',$year);
                            })->where(function ($query) {
                                 $query->where('state','=','out');
                                   
                          })->get();

                         return view('reports.savings.annualy.refunded_savings',compact('year','savings'));
                               }else{
                                   return back();
                               }


                            
                      }else{

                         return back();
                      } 
           }
}


