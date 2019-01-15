<?php
    $loanschedules=Loanschedule::whereIn('loan_id',$loanscheduleid)->whereMonth('duedate',$month)->whereYear('duedate',$year)->get();
     $incompliteloanschedule=Loanschedule::whereIn('loan_id',$loanscheduleid)whereBetween('duedate',[$previousmonth,$lastdateofcurrentmonth])->orWhere('status','=','incomplite')->get();

     $totalschedules=Loanschedule::whereIn('loan_id',$loanscheduleid)whereBetween('duedate',[$previousmonth,$lastdateofcurrentmonth])where('status',null)->orWhere('status','=','incomplite')->get();
    $sumtotalschedule=$totalschedules->sum('monthprinciple')+$loanschedules->sum('monthinterest');


      $totalmonthpay=$loanschedules->sum('monthprinciple')+$loanschedules->sum('monthinterest');
                     
                  
              if($inputamount==$sumtotalschedule){
                        if(!empty($incompliteloanschedules)){
                 foreach($incompliteloanschedules as $loanschedule){

                     $totalpay=$loanchedule->sum('monthprinciple')+$loanschedule->sum('monthinterest');
                      $principlepay=$loanchedule->sum('monthprinciple');
                      $interestpay=$loanchedule->sum('monthinterest');
                      $principlepaid=$loanschedule->monthpayment->sum('principlepayed');
                      $interestpaid=$loanschedule->monthpayment->sum('interestpayed');
                       $principle_to_pay=$principlepay-$principlepaid;
                       $interest_to_pay=$interestpay-$interestpaid;
                       $total_to_pay=$totalpay-($principlepaid+$interestpaid);

                         $payment=Payment::create([
                                     'loan_id'=>$loanschedule->loan->id,
                                      'amount'=>total_to_pay,
                                      'narration'=>$request->narration,
                                      'paid_by'=>Auth::guard('member')->user()->member_id,  //loan payment verificat
                                      'payment_type'=>$request->payment_method,
                                      'state'=>'in',
                                      'date'=>date('Y-m-d')
                                         ]);

                                          $repayment=Repayment::create([
                                                                  'loanschedule_id'=>$loanschedule->id,
                                                                  'principlepayed'=> $principle_to_pay,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$total_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id
                                                             ]); 

                                                       $repayment->monthrepayment()->attach($loan_schedule->id);
                                                       $loan_schedule->status='paid';
                                                       $loan_schedule->save();


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

                 }

                 foreach($loanschedules as $loanschedule){

                      $totalpay=$loanchedule->sum('monthprinciple')+$loanschedule->sum('monthinterest');
                      $principlepay=$loanchedule->sum('monthprinciple');
                      $interestpay=$loanchedule->sum('monthinterest');
                      $principlepaid=$loanschedule->monthpayment->sum('principlepayed');
                      $interestpaid=$loanschedule->monthpayment->sum('interestpayed');
                       $principle_to_pay=$principlepay-$principlepaid;
                       $interest_to_pay=$interestpay-$interestpaid;
                       $total_to_pay=$totalpay-($principlepaid+$interestpaid);

                         $payment=Payment::create([
                                     'loan_id'=>$loanschedule->loan->id,
                                      'amount'=>total_to_pay,
                                      'narration'=>$request->narration,
                                      'paid_by'=>Auth::guard('member')->user()->member_id,  //loan payment verificat
                                      'payment_type'=>$request->payment_method,
                                      'state'=>'in',
                                      'date'=>date('Y-m-d')
                                         ]);

                                          $repayment=Repayment::create([
                                                                  'loanschedule_id'=>$loanschedule->id,
                                                                  'principlepayed'=> $principle_to_pay,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$total_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id
                                                             ]); 

                                                       $repayment->monthrepayment()->attach($loan_schedule->id);
                                                       $loan_schedule->status='paid';
                                                       $loan_schedule->save();


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
                    }

              }else{

                    foreach($loanschedules as $loanschedule){

                      $totalpay=$loanchedule->sum('monthprinciple')+$loanschedule->sum('monthinterest');
                      $principlepay=$loanchedule->sum('monthprinciple');
                      $interestpay=$loanchedule->sum('monthinterest');
                      $principlepaid=$loanschedule->monthpayment->sum('principlepayed');
                      $interestpaid=$loanschedule->monthpayment->sum('interestpayed');
                       $principle_to_pay=$principlepay-$principlepaid;
                       $interest_to_pay=$interestpay-$interestpaid;
                       $total_to_pay=$totalpay-($principlepaid+$interestpaid);

                         $payment=Payment::create([
                                     'loan_id'=>$loanschedule->loan->id,
                                      'amount'=>total_to_pay,
                                      'narration'=>$request->narration,
                                      'paid_by'=>Auth::guard('member')->user()->member_id,  //loan payment verificat
                                      'payment_type'=>$request->payment_method,
                                      'state'=>'in',
                                      'date'=>date('Y-m-d')
                                         ]);

                                          $repayment=Repayment::create([
                                                                  'loanschedule_id'=>$loanschedule->id,
                                                                  'principlepayed'=> $principle_to_pay,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$total_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id
                                                             ]); 

                                                       $repayment->monthrepayment()->attach($loan_schedule->id);
                                                       $loan_schedule->status='paid';
                                                       $loan_schedule->save();


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
                    }

                 }

              }else if($inputamount>$sumtotalschedule){

                     foreach($incompliteloanschedules as $loanschedule){

                     $totalpay=$loanchedule->sum('monthprinciple')+$loanschedule->sum('monthinterest');
                      $principlepay=$loanchedule->sum('monthprinciple');
                      $interestpay=$loanchedule->sum('monthinterest');
                      $principlepaid=$loanschedule->monthpayment->sum('principlepayed');
                      $interestpaid=$loanschedule->monthpayment->sum('interestpayed');
                       $principle_to_pay=$principlepay-$principlepaid;
                       $interest_to_pay=$interestpay-$interestpaid;
                       $total_to_pay=$totalpay-($principlepaid+$interestpaid);

                         $payment=Payment::create([
                                     'loan_id'=>$loanschedule->loan->id,
                                      'amount'=>total_to_pay,
                                      'narration'=>$request->narration,
                                      'paid_by'=>Auth::guard('member')->user()->member_id,  //loan payment verificat
                                      'payment_type'=>$request->payment_method,
                                      'state'=>'in',
                                      'date'=>date('Y-m-d')
                                         ]);

                                          $repayment=Repayment::create([
                                                                  'loanschedule_id'=>$loanschedule->id,
                                                                  'principlepayed'=> $principle_to_pay,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$total_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id
                                                             ]); 

                                                       $repayment->monthrepayment()->attach($loan_schedule->id);
                                                       $loan_schedule->status='paid';
                                                       $loan_schedule->save();

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

                 }

                 foreach($loanschedules as $loanschedule){

                      $totalpay=$loanchedule->sum('monthprinciple')+$loanschedule->sum('monthinterest');
                      $principlepay=$loanchedule->sum('monthprinciple');
                      $interestpay=$loanchedule->sum('monthinterest');
                      $principlepaid=$loanschedule->monthpayment->sum('principlepayed');
                      $interestpaid=$loanschedule->monthpayment->sum('interestpayed');
                       $principle_to_pay=$principlepay-$principlepaid;
                       $interest_to_pay=$interestpay-$interestpaid;
                       $total_to_pay=$totalpay-($principlepaid+$interestpaid);

                         $payment=Payment::create([
                                     'loan_id'=>$loanschedule->loan->id,
                                      'amount'=>total_to_pay,
                                      'narration'=>$request->narration,
                                      'paid_by'=>Auth::guard('member')->user()->member_id,  //loan payment verificat
                                      'payment_type'=>$request->payment_method,
                                      'state'=>'in',
                                      'date'=>date('Y-m-d')
                                         ]);

                                          $repayment=Repayment::create([
                                                                  'loanschedule_id'=>$loanschedule->id,
                                                                  'principlepayed'=> $principle_to_pay,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$total_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id
                                                             ]); 

                                                       $repayment->monthrepayment()->attach($loan_schedule->id);
                                                       $loan_schedule->status='paid';
                                                       $loan_schedule->save();


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
                    }

              }else{

                    foreach($loanschedules as $loanschedule){

                      $totalpay=$loanchedule->sum('monthprinciple')+$loanschedule->sum('monthinterest');
                      $principlepay=$loanchedule->sum('monthprinciple');
                      $interestpay=$loanchedule->sum('monthinterest');
                      $principlepaid=$loanschedule->monthpayment->sum('principlepayed');
                      $interestpaid=$loanschedule->monthpayment->sum('interestpayed');
                       $principle_to_pay=$principlepay-$principlepaid;
                       $interest_to_pay=$interestpay-$interestpaid;
                       $total_to_pay=$totalpay-($principlepaid+$interestpaid);

                         $payment=Payment::create([
                                     'loan_id'=>$loanschedule->loan->id,
                                      'amount'=>total_to_pay,
                                      'narration'=>$request->narration,
                                      'paid_by'=>Auth::guard('member')->user()->member_id,  //loan payment verificat
                                      'payment_type'=>$request->payment_method,
                                      'state'=>'in',
                                      'date'=>date('Y-m-d')
                                         ]);

                                          $repayment=Repayment::create([
                                                                  'loanschedule_id'=>$loanschedule->id,
                                                                  'principlepayed'=> $principle_to_pay,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$total_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id
                                                             ]); 

                                                       $repayment->monthrepayment()->attach($loan_schedule->id);
                                                       $loan_schedule->status='paid';
                                                       $loan_schedule->save();


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
                    }

                     $newamount=$totalmothpayallschedule-($totalmonthpayincomplite+$totalmonthpaycurrent);


                 }else if($inputamount<$totalmonthpayincomplite){

                      

                 }

             

               