<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
include(app_path()."\datatable\Editor\php\DataTables.php" );
include(app_path()."\datatable\Editor\php\config.php" );
include(app_path()."\datatable\Editor\php\Bootstrap.php" );
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;

use App\Mainaccount;
use App\Expense;
use App\Payment; 
use App\Journalentry;
use App\Bankaccount;
use Auth;
use App\Categoryaccount; 
use App\Asset;
use App\Assetaccount; 

use App\Disposal; 




use App\Member;
use App\Monthsavingshare;
use App\Membersaving;
use App\Share;
//use App\Mainaccount;
//use App\Payment;
//use App\Journalentry;
//use App\Bankaccount;
use App\Payableaccount;
use App\Receivableaccount;
use App\Repayment;
use App\Loanaccount;
//use Auth;
use App\Member_share; 


class MainaccountController extends Controller
{
    //


    function __construct(){

       return $this->middleware('auth:member');
     }

 function db()
      {
        include(app_path()."\connection.php" );
        return $db = new \DataTables\Database( $sql_details );

      }



  public function index(){

     Editor::inst($this->db(),'mainaccounts','id')
    ->fields(
        Field::inst('mainaccounts.account_no')->validator('Validate::notEmpty' ),
        Field::inst('mainaccounts.name')->validator('Validate::notEmpty' ),
        Field::inst('mainaccounts.categoryaccountstype_id')
        ->options( 'categoryaccountstypes', 'id','name'),             
        Field::inst( 'categoryaccountstypes.name' )
    )   
     ->leftJoin('categoryaccountstypes','categoryaccountstypes.id','=', 'mainaccounts.categoryaccountstype_id' ) 
    ->process( $_GET )
    ->json();
    }


      public function expenses(){


          $expensesaccounts=Categoryaccount::where('name','=','Expenses')->first()->mainaccounts;
           
         return view('Expenses.expenses',compact('expensesaccounts'));
      }


      public function expenseajax(Request $request){

              $expenseaccount=Mainaccount::find($request->account_to);

             if($request->account_from=='bank'){ 

              echo json_encode([

                 'account_from'=>'Bank Account',
                  'account_to'=>$expenseaccount->name
              ]);


             }elseif($request->account_from=='cash'){
               
              echo json_encode([

                 'account_from'=>'Cash Account',
                  'account_to'=>$expenseaccount->name
              ]);
   

             }

      }

        public function storeexpenses(Request $request){

                      $bankaccount=Mainaccount::where('name','=','Bank Account')
                                            ->first();



                    $this->validate($request,[

                       'payment'=>'required',
                       'narration'=>'required',
                       'account_from'=>'required',
                       'account_to'=>'required'

                    ]);

               $payment=Payment::create([
                 'amount'=>$request->payment,
                 'narration'=>$request->narration,
                 'paid_by'=>Auth::guard('member')->user()->member_id,  //loan payment verificat
                 'payment_type'=>'bank',
                 'state'=>'out',
                 'date'=>date('Y-m-d')
                             
                  ]);

            if($request->account_from=='bank'){ 

              
                $expenseaccount=Mainaccount::find($request->account_to);
                   Bankaccount::create([
                'mainaccount_id'=>$request->account_to,
                'cr'=>$request->payment,
                'description'=>$expenseaccount->name,
                'date'=>date('Y-m-d')
                  ]);

                  Expense::create([
                    'dr'=>$request->payment,
                    'mainaccount_id'=>$request->account_to,
                    'date'=>date('Y-m-d')
                  ]);
                     //jornal for bank
     Journalentry::create(
    [
   'cr'=>$request->payment, 
    'mainaccount_id'=>$bankaccount->id,
    'payment_id'=>$payment->id,
    'date'=>date('Y-m-d'),
   'service_type'=>'expenses']
                                   
    ); 
    
     //jornal for expenses account            

   Journalentry::create(
    [
   'dr'=>$request->payment, 
    'mainaccount_id'=>$expenseaccount->id,
    'payment_id'=>$payment->id,
    'date'=>date('Y-m-d'),
   'service_type'=>'expenses']
                                   
    );


      return back()->with('status','Successfully paid');

            
                 }elseif($request->account_from=='cash'){

                $cashaccount=Mainaccount::where('name','=','Cash Account')
                                            ->first();
                                            
                              $expenseaccount=Mainaccount::find($request->account_to);
                   Bankaccount::create([
                'mainaccount_id'=>$request->account_to,
                'cr'=>$request->payment,
                'description'=>$expenseaccount->name,
                'date'=>date('Y-m-d')
                  ]);

                  Expenses::create([
                    'dr'=>$request->payment,
                    'mainaccount_id'=>$request->account_to,
                    'date'=>date('Y-m-d')
                  ]);
                     //jornal for bank
     Journalentry::create(
    [
   'cr'=>$request->payment, 
    'mainaccount_id'=>$cashaccount->id,
    'payment_id'=>$payment->id,
    'date'=>date('Y-m-d'),
   'service_type'=>'expenses']
                                   
    ); 
    
     //jornal for expenses account            

   Journalentry::create(
    [
   'dr'=>$request->payment, 
    'mainaccount_id'=>$expenseaccount->id,
    'payment_id'=>$payment->id,
    'date'=>date('Y-m-d'),
   'service_type'=>'expenses']
                                   
    );    

         return back()->with('status','Successfully paid');             


                 }
        }



         public function test(){
                
                $array=[1,2];

                $loans=\App\Loan::find($array);
              
            return view('receipt.test',compact('loans'));     
         }


          public function test2(){

                    $vouchers=\App\Voucher::all();

                  
                return view('test.test2',compact('vouchers'));
          }


          public function assetregister(){

           

           $mainaccounts=Categoryaccount::where('name','Asset')->first()->mainaccounts;

         
              return view('asset.register',compact('mainaccounts'));
          }


           public function store_asset(Request $request){

                      
               $bankaccount=Mainaccount::where('name','=','Bank Account')
                                            ->first();
                   $this->validate($request,[
                      'asset_name'=>'required',
                      'category'=>'required',
                      'amount'=>'required',
                      'narration'=>'required',
                      'date'=>'required'
                   ]);   

                   $payment=Payment::create([
 
                            'amount'=>$request->amount,
                            'narration'=>$request->narration,
                            'paid_by'=>Auth::guard('member')->user()->member_id,  //loan payment verificat
                            'payment_type'=>'bank',
                            'state'=>'out',
                            'date'=>date('Y-m-d')        
                         ]);


                    Asset::create([
                      'name'=>$request->asset_name,
                      'mainaccount_id'=>$request->category,
                      'amount'=>$request->amount,
                      'description'=>$request->narration,
                      'created_date'=>$request->date,
                      'date'=>date('Y-m-d'),
                      'status'=>'active'
                    ]);

                       //no importance found
                  /*  Assetaccount::create([
                      'dr'=>$request->amount,
                      'mainaccount_id'=>$request->category,
                      'date'=>date('Y-m-d'),
                      'created_date'=>$request->date
                    ]);*/

                     Bankaccount::create([
                                  'mainaccount_id'=>$request->category,
                                  'cr'=>$request->amount,
                                  'description'=>$request->asset_name,
                                  'date'=>date('Y-m-d')
                                ]);

                          Journalentry::create(
                              [       
                               'dr'=>$request->amount, 
                                 'mainaccount_id'=>$request->category,
                                  'payment_id'=>$payment->id,
                                    'date'=>$request->date,
                                'service_type'=>'Asset']
                                   
                             );


                          Journalentry::create(
                              [       
                               'cr'=>$request->amount, 
                                 'mainaccount_id'=>$bankaccount->id,
                                  'payment_id'=>$payment->id,
                                    'date'=>$request->date,
                                'service_type'=>'Asset']
                                   
                             );



                    return back()->with('status','Successfully Postedh');      

                     
           }


           public function disposal(){


                  

                 $assets=Asset::where('status','active')->get();

               return view('asset.disposal',compact('assets'));
           }


            public function post_disposal(Request $request){

                   $this->validate($request,[
                    'asset'=>'required',
                     'amount'=>'required',
                     'narration'=>'required',
                     'date'=>'required'
                   ]);

                                

                         $asset_id=$request->asset;
                         $assetamount=Assetaccount::find($asset_id)->dr;
                          $asset_inputamout=$request->amount;
                          $mainaccount_id=Assetaccount::find($asset_id)->mainaccount_id;
                           $asset=Asset::find($asset_id);


                     
                      if($asset_inputamout>$assetamount){

                           $payment=Payment::create([
                            'amount'=>$request->amount,
                            'narration'=>'profit disposal',
                            'paid_by'=>Auth::guard('member')->user()->member_id,  //loan payment verificat
                            'payment_type'=>'bank',
                            'state'=>'in',
                            'date'=>date('Y-m-d')        
                         ]);


                        Bankaccount::create([
                                  'mainaccount_id'=>$mainaccount_id,
                                  'dr'=>$asset_inputamout-$assetamount,
                                  'description'=>$request->narration,
                                  'date'=>date('Y-m-d')
                                ]);

                        Disposal::create([
                              'amount'=> $asset_inputamout-$assetamount,
                              'status'=>'profit',
                              'date'=>date('Y-m-d'),
                              'asset_id'=>$asset_id
                        ]);


                          Journalentry::create(
                              [       
                               'dr'=>$asset_inputamout-$assetamount, 
                                 'mainaccount_id'=>$mainaccount_id,
                                  'payment_id'=>$payment->id,
                                    'date'=>date('Y-m-d'),
                                      'service_type'=>'Asset disposal']
                                   
                             );
                       
                             $asset->status='inactive';
                             $asset->save();

                               return back()->with('status','Successfully Disposed');

                      }elseif($asset_inputamout<$assetamount){


                         
                          $payment=Payment::create([
                            'amount'=>$request->amount,
                            'narration'=>'profit disposal',
                            'paid_by'=>Auth::guard('member')->user()->member_id,  //loan payment verificat
                            'payment_type'=>'bank',
                            'state'=>'in',
                            'date'=>date('Y-m-d')        
                         ]);


                        Bankaccount::create([
                                  'mainaccount_id'=>$mainaccount_id,
                                  'cr'=>$assetamount-$asset_inputamout,
                                  'description'=>$request->narration,
                                  'date'=>date('Y-m-d')
                                ]);

                        Disposal::create([
                              'amount'=> $assetamount-$asset_inputamout,
                              'status'=>'loss',
                              'date'=>date('Y-m-d'),
                              'asset_id'=>$asset_id
                        ]);


                          Journalentry::create(
                              [       
                               'cr'=>$assetamount-$asset_inputamout, 
                                 'mainaccount_id'=>$mainaccount_id,
                                  'payment_id'=>$payment->id,
                                    'date'=>date('Y-m-d'),
                                      'service_type'=>'Asset disposal']      
                             ); 

                               $asset->status='inactive';
                             $asset->save(); 

                              return back()->with('status','Successfully Disposed');

                      }else{



                          $payment=Payment::create([
                            'amount'=>$request->amount,
                            'narration'=>'profit disposal',
                            'paid_by'=>Auth::guard('member')->user()->member_id,  //loan payment verificat
                            'payment_type'=>'bank',
                            'state'=>'in',
                            'date'=>date('Y-m-d')        
                         ]);


                        Bankaccount::create([
                                  'mainaccount_id'=>$mainaccount_id,
                                  'cr'=>$assetamount,
                                  'description'=>$request->narration,
                                  'date'=>date('Y-m-d')
                                ]);

                        Disposal::create([
                              'amount'=> $assetamount,
                              'status'=>'loss',
                              'date'=>date('Y-m-d'),
                              'asset_id'=>$asset_id
                        ]);


                          Journalentry::create(
                              [       
                               'cr'=>$assetamount, 
                                 'mainaccount_id'=>$mainaccount_id,
                                  'payment_id'=>$payment->id,
                                    'date'=>date('Y-m-d'),
                                      'service_type'=>'Asset disposal']      
                             ); 

                                $asset->status='inactive';
                                $asset->save(); 


                                 return back()->with('status','Successfully Disposed');

                      }

                  
                          
                           

            }




}
