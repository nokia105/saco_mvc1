<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Member;
use App\Loan;
use App\Loanschedule;
use App\Repayment;
use App\Penalty;
use App\Monthpenaty;
use App\Journalentry;
use App\Mainaccount;

class ApplyMonthPenaty extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ApplyMonthPenaty:monthpenalty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Apply month penalty';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    
        //check  if that month is marks paid
                  $schedules=LoanSchedule::where('status','!=','paid')->
                  where('duedate','=',date('Y-m-d'))->get();

              
                     
                  $penalty=Penalty::first()->percentage_penalty; 

                   $mainpenaty_account=Mainaccount::where('name','=','Penalty Account')->first();                              
                 
              foreach($schedules as $schedule){

                            $member_penatyaccount=$schedule->loan->member->memberaccount->where('glaccount_id','=',5)->first();
                            $month_pay_amount=$schedule->monthprinciple+$schedule->monthinterest;
                              if($schedule->status=='incomplete'){
                              
                                         $amount_paid=$schedule->monthrepayment->sum('principlepayed')+$schedule->monthrepayment->sum('interestpayed');  
                                             //if exist method for schedule id in peyment table

                                         $penalty_amount=($penalty/100)*($month_pay_amount-$amount_paid);


                                               //penaty to the jornal

                                                 //dr main penaty account 
/*
                                                        Journalentry::create(
                                                  [
                               
                                             'dr'=>$penalty_amount, 
                                             'mainaccount_id'=>$mainpenaty_account->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'penaty']
                                   
                                                  ); 
                                                  //cr penaty account member

                                                           Journalentry::create(
                                                  [
                               
                                             'cr'=>$penalty_amount, 
                                             'memberaccount_id'=>$member_penatyaccount->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'penaty']
                                   
                                                  );       */

                                         Monthpenaty::create(
                                              [
                                                 'loanschedule_id'=>$schedule->id,
                                                  'amount_paid'=>$penalty_amount,
                                                   'status'=>'unpaid',  
                                           ]);

                                           
                                }else{

          
                                         $penalty_amount=($penalty/100)*$month_pay_amount;
                                         //penaty to the jornal

                                                 //dr main penaty account 

                                                        Journalentry::create(
                                                  [
                               
                                             'dr'=>$penalty_amount, 
                                             'mainaccount_id'=>$mainpenaty_account->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'penaty']
                                   
                                                  ); 
                                                  //cr penaty account member

                                                           Journalentry::create(
                                                  [
                               
                                             'cr'=>$penalty_amount, 
                                             'memberaccount_id'=>$member_penatyaccount->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'penaty']
                                   
                                                  ); 
                                         Monthpenaty::create(
                                              [
                                                 'loanschedule_id'=>$schedule->id,
                                                  'amount_paid'=>$penalty_amount,
                                                   'status'=>'unpaid',  
                                           ]);

                                                 
                                }      
              }

    }
}
