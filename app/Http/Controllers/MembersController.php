<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Member;
use Auth;
use App\Memberaccount;
use App\Glaccount;
use App\Categoryaccount;
use Illuminate\Validation\Rule;
use App\Regfee; 
use App\Feescategory;
use App\Mainaccount;
use Excel;
use File;


class MembersController extends Controller
{
   
        
     function __construct(){

       return $this->middleware('auth:member');
     }  

      public function member_profile($id){

            $member=Member::findorfail($id);

          return view('member.member_profile',compact('member'));
      }

         public function index(){

            $members=Member::all()->where('status','=','inactive');

           return view('member.inactive_member',compact('members'));

         }

           public function activemembers(){

              $members=Member::all()->where('status','=','active');

           return view('member.member',compact('members'));
           }


  public function registerform(){

               $memberlastid=Member::all()->last()->member_id+1;
               if (strlen($memberlastid)==1 ) $regno='000'.$memberlastid.'';
               else if (strlen($memberlastid)==2 ) $regno='00'.$memberlastid.'';
               else if (strlen($memberlastid)==3 ) $regno='0'.$memberlastid.'';
               else if (strlen($memberlastid)>3 ) $regno=$memberlastid.'';

                $reg='TS/MR/'.$regno;

  	   return view('member.registerform',compact('reg'));
  }



   public function saveregister(Request $request, Member $member){

   	      $validator=$this->validate(request(),[
              'firstname'=>'required',
              'middlename'=>'required',
              'lastname'=>'required',
              'reg_no'=>'required',
               'phone'=> [
        'required',
        'min:10',
        'max:13',
        Rule::unique('members')->ignore($member->id,'member_id'),
    ],
               'email' => [
        'required',
        Rule::unique('members')->ignore($member->id,'member_id'),
    ],
               'bank'=>'required',
               'account'=>'required',
               'kin_name'=>'required',
               'kin_relashioship'=>'required',
               'gender'=>'required',
               'box'=>'required',
               'street'=>'required',
               'house'=>'required',
               'b_date'=>'required',
               'status'=>'required',
               'saving'=>'required',
               'share'=>'required',
               'employment_number'=>'required',
   
               'employment_date'=>'required',
               'employment_region'=>'required',
               'employment_area'=>'required',
               'employment_type'=>'required',
               'employment_depertment'=>'required',
               'employment_position'=>'required',
               'salary_amount'=>'required',
               'img'=>'required'     
           ]);


            $file_upload=$request->file('img');

              $filename=time() . '.' . $file_upload->getClientOriginalName();
          
             $file_upload->move('uploads/file',$filename);

   	  $member=Member::create([
        'first_name'=>$request->firstname,
        'middle_name'=>$request->middlename,
        'last_name'=>$request->lastname,
         'registration_no'=>$request->reg_no,
         'status'=>'inactive',
         'user_id'=>Auth::guard('member')->user()->member_id,
         'phone'=>$request->phone,
         'password'=>bcrypt('password'),
         'email'=>$request->email,
         'bank_name'=>$request->bank,
         'account_number'=>$request->account,
         'nextkin_name'=>$request->kin_name,
         'nextkin_relationship'=>$request->kin_relashioship,
         'marital_status'=>$request->status,
         'couple_names'=>$request->couple,
         'gender'=>$request->gender,
         'box_number'=>$request->box,
         'street_name'=>$request->street,
         'house_no'=>$request->house,
         'birth_date'=>$request->b_date,
         'joining_date'=>date('Y-m-d'),
         'monthsaving'=>$request->saving,
         'monthshare'=>$request->share,
         'employment_no'=>$request->employment_number,
         'employment_date'=>$request->employment_date,
         'employment_region'=>$request->employment_region,
         'employment_area'=>$request->employment_area,
         'employment_type'=>$request->employment_type,
         'employment_department'=>$request->employment_depertment,
         'employment_duration'=>$request->employment_duration,
         'employment_position'=>$request->employment_position,
         'salary_ranking'=>$request->salary_ranking,
         'salary_amount'=>$request->salary_amount,
         'employment_image'=>$filename,
         'member_image'=>'default.png'

   	  ]);

               //  rondom account number

   	         //loan account

           $loanfee=Feescategory::where('fee_name','=','Registration fee')->first();

         Regfee::create([
          'amount'=>$loanfee->fee_value,
          'member_id'=>$member->member_id,
          'status'=>'unpaid'
         ]); 


   	        $liability=Categoryaccount::where('name','=','Liability')->first();
            $asset=Categoryaccount::where('name','=','Asset')->first();
            $capital=Categoryaccount::where('name','=','Capital')->first();


             $saving=Mainaccount::where('name','=','Saving Account')->first();
             $share=Mainaccount::where('name','=','Share Account')->first();
             $loan=Mainaccount::where('name','=','Loan Account')->first();
             $interest=Mainaccount::where('name','=','Interest Account')->first();
             $penaty=Mainaccount::where('name','=','Penaty Account')->first();
             $registration=Mainaccount::where('name','=','Registration Fee')->first();
             $loanfee=Mainaccount::where('name','=','Loan Fee')->first();
             $insurance=Mainaccount::where('name','=','Insurance Account')->first();            

               //dd($asset);

   	        $memberloan=Memberaccount::create([
      
                     'member_id'=>$member->member_id,
                      
                      'categoryaccount_id'=>$liability->id,
                      'name'=>'Loan Account',
                      'account_no'=>$loan->account_no.($member->member_id),
                      'date'=>date('Y-m-d')
   	      ]);

              
   	     
   	         $membersaving=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$saving->account_no.($member->member_id),
                      'categoryaccount_id'=>$asset->id,
                      'name'=>'Saving Account',
                      'date'=>date('Y-m-d')
   	        ]);

   	      //share account 
           
   	          $membershare=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$share->account_no.($member->member_id),
                      'categoryaccount_id'=>$asset->id,
                      'name'=>'Share Account',
                      'date'=>date('Y-m-d')
   	        ]);

   	     //interest account
   	          
   	      $memberinterest=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$interest->account_no.($member->member_id),
                      'categoryaccount_id'=>$liability->id,
                      'name'=>'Interest Account',
                      'date'=>date('Y-m-d')
   	        ]); 

   	     //penalty account
            
   	        $memberpenaty=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$penaty->account_no.($member->member_id),
                      'categoryaccount_id'=>$liability->id,
                      'name'=>'Penaty Account',
                      'date'=>date('Y-m-d')
   	        ]);


            $memberloanfeeaccount=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$loanfee->account_no.($member->member_id),
                      'categoryaccount_id'=>$liability->id,
                      'name'=>'Loan Fee',
                      'date'=>date('Y-m-d')
            ]);

   	     //charges account
            
   	     //insurance account
             
   	            $memberinsurance=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$insurance->account_no.($member->member_id),
                      'categoryaccount_id'=>$capital->id,
                      'name'=>'Insurance Account',
                      'date'=>date('Y-m-d')
   	        ]);

                                 //registration
                   $memberregistration=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$registration->account_no.($member->member_id),
                      'categoryaccount_id'=>$capital->id,
                      'name'=>'Registration Fee',
                      'date'=>date('Y-m-d')
            ]);

   	             return back()->with('status','Sucessfully Registered ');
   }


       public function edit($id){

           $member=Member::findorfail($id);

           return view('member.edit',compact('member'));
       }
     
        public function update(Member $member, $id, Request $request){

                  

                 
                   if($request->has('img')){

                  $file_upload=$request->file('img');

              $filename=time() . '.' . $file_upload->getClientOriginalName();
          
             $file_upload->move('uploads/file',$filename);
                     }else{
                     
                      $filename='default.jpg';
                     }
            

            
    $validator=$this->validate(request(),[
              'firstname'=>'required',
              'middlename'=>'required',
              'lastname'=>'required',
              'reg_no'=>'required',
            /*   'phone'=>'required',*/
               'email' =>'required|email',
              /* 'bank'=>'required',*/
             //  'account'=>'required',
              // 'kin_name'=>'required',
            /*   'kin_relashioship'=>'required',*/
               'gender'=>'required',
               //'box'=>'required',
              /* 'street'=>'required',
               'house'=>'required',*/
              /* 'b_date'=>'required',*/
            /*   'status'=>'required',*/
              // 'saving'=>'required',
              // 'share'=>'required',
            /*   'employment_number'=>'required',*/
              // 'employment_date'=>'required',
              // 'employment_region'=>'required',
          /*     'employment_area'=>'required',*/
              // 'employment_type'=>'required',
           /*    'employment_depertment'=>'required',*/
             /*  'employment_position'=>'required',*/
              // 'salary_amount'=>'required'      
           ]);

              


             //$memberData=$request->all();

          $member=Member::find($id)->update([
         'first_name'=>$request->firstname,
         'middle_name'=>$request->middlename,
         'last_name'=>$request->lastname,
         'registration_no'=>$request->reg_no,
         'user_id'=>Auth::guard('member')->user()->member_id,
         'phone'=>$request->phone,
         'email'=>$request->email,
         'bank_name'=>$request->bank,
         'account_number'=>$request->account,
         'nextkin_name'=>$request->kin_name,
         'nextkin_relationship'=>$request->kin_relashioship,
         'marital_status'=>$request->status,
         'couple_names'=>$request->couple,
         'gender'=>$request->gender,
         'box_number'=>$request->box,
         'street_name'=>$request->street,
         'house_no'=>$request->house,
         'birth_date'=>$request->b_date,
         'monthsaving'=>$request->saving,
         'monthshare'=>$request->share,
         'employment_no'=>$request->employment_no,
         'employment_date'=>$request->employment_date,
         'employment_region'=>$request->employment_region,
         'employment_area'=>$request->emplyment_area,
         'employment_type'=>$request->employment_type,
         'employment_department'=>$request->employment_depertment,
         'employment_duration'=>$request->employment_duration,
         'employment_position'=>$request->employment_position,
         'salary_ranking'=>$request->salary_ranking,
         'salary_amount'=>$request->salary_amount,
         'employment_image'=>$filename

              ]);

               $member=Member::find($id);

             if($member->status=='active'){

                return redirect()->route('active_members')->with('status','Updated Successfully');
             }else{

               return redirect()->route('inactive_members');
             }              
            
        }

     
         public function delete($id){

               $member=Member::find($id);

               $member->memberaccount()->delete();

               $member->delete();





                //delete all member account

               return back()->with('status','Successfully Deleted');
         }


            public function reg_excel_download(){

                return response()->download(base_path('RegisterExcel/Register-Excel.xlsx'));
            }


           public function register_excel(){

              



              return view('member.register_excel');
           }


           public function store_reg_excel(Request $request){

             

            $liability=Categoryaccount::where('name','=','Liability')->first();
            $asset=Categoryaccount::where('name','=','Asset')->first();
            $capital=Categoryaccount::where('name','=','Capital')->first();

             $saving=Mainaccount::where('name','=','Saving Account')->first();
             $share=Mainaccount::where('name','=','Share Account')->first();
             $loan=Mainaccount::where('name','=','Loan Account')->first();
             $interest=Mainaccount::where('name','=','Interest Account')->first();
             $penaty=Mainaccount::where('name','=','Penaty Account')->first();
             $registration=Mainaccount::where('name','=','Registration Fee')->first();
             $loanfee=Mainaccount::where('name','=','Loan Fee')->first();
             $insurance=Mainaccount::where('name','=','Insurance Account')->first(); 

              $loanfee=Feescategory::where('fee_name','=','Registration fee')->first();


               $this->validate($request,[
                      'excel'=>'required|mimes:xlsx'
                  
               ]);
            
                if($request->hasFile('excel')){
                  
                     $path = $request->excel->getRealPath();
                     
                    
                     $data = Excel::load($path, function($reader) {
                })->get();
                                    //dd($data);
                        /* if(!empty($data) && $data->count()){*/
                                     
                                
                            foreach($data as $key=>$value){
                              //dd($value->Reg_no);


                           
               $member=Member::create([
        'first_name'=>$value->first_name,
        'middle_name'=>$value->middle_name,
        'last_name'=>$value->last_name,
         'registration_no'=>$value->registration_no,
         'status'=>'active',
         'user_id'=>Auth::guard('member')->user()->member_id,
         'phone'=>$value->phone,
         'password'=>bcrypt('password'),
         'email'=>$value->email,
         'bank_name'=>$value->bank_name,
         'account_number'=>$value->account_no,
         'nextkin_name'=>$value->next_kin_name,
         'nextkin_relationship'=>$value->next_kin_relashioship,
         'marital_status'=>$value->martial_status,
         'couple_names'=>$value->spouse_name,
         'gender'=>$value->gender,
         'box_number'=>$value->box_no,
         'street_name'=>$value->street_name,
         'house_no'=>$value->house_no,
         'birth_date'=>$value->birth_date,
         'joining_date'=>$value->joining_date,
         'monthsaving'=>$value->monthly_savings,
         'monthshare'=>$value->monthly_shares,
         'employment_no'=>$value->employment_no,
         'employment_date'=>$value->employment_date,
         'employment_region'=>$value->employment_region,
         'employment_area'=>$value->employment_area,
         'employment_type'=>$value->employment_type,
         'employment_department'=>$value->employment_depertment,
         'employment_duration'=>$value->employment_duration,
         'employment_position'=>$value->employment_position,
         'salary_ranking'=>$value->salary_rank,
         'salary_amount'=>$value->salary_amount,
         'member_image'=>'default.png'          
                        ]);


                  

    

                  $memberloan=Memberaccount::create([
      
                     'member_id'=>$member->member_id,
                      
                      'categoryaccount_id'=>$liability->id,
                      'name'=>'Loan Account',
                      'account_no'=>$loan->account_no.($member->member_id),
                      'date'=>date('Y-m-d')
          ]);

         
             $membersaving=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$saving->account_no.($member->member_id),
                      'categoryaccount_id'=>$asset->id,
                      'name'=>'Saving Account',
                      'date'=>date('Y-m-d')
            ]);

          //share account 
           
              $membershare=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$share->account_no.($member->member_id),
                      'categoryaccount_id'=>$asset->id,
                      'name'=>'Share Account',
                      'date'=>date('Y-m-d')
            ]);

         //interest account
              
          $memberinterest=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$interest->account_no.($member->member_id),
                      'categoryaccount_id'=>$liability->id,
                      'name'=>'Interest Account',
                      'date'=>date('Y-m-d')
            ]); 

         //penalty account
            
            $memberpenaty=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$penaty->account_no.($member->member_id),
                      'categoryaccount_id'=>$liability->id,
                      'name'=>'Penaty Account',
                      'date'=>date('Y-m-d')
            ]);


            $memberloanfeeaccount=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$loanfee->account_no.($member->member_id),
                      'categoryaccount_id'=>$liability->id,
                      'name'=>'Loan Fee',
                      'date'=>date('Y-m-d')
            ]);

         //charges account
            
         //insurance account
             
                $memberinsurance=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$insurance->account_no.($member->member_id),
                      'categoryaccount_id'=>$capital->id,
                      'name'=>'Insurance Account',
                      'date'=>date('Y-m-d')
            ]);

                                 //registration
                   $memberregistration=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$registration->account_no.($member->member_id),
                      'categoryaccount_id'=>$capital->id,
                      'name'=>'Registration Fee',
                      'date'=>date('Y-m-d')
            ]);      
                                   
                            }

                  
                  return back()->with('status','Successfully Registered');
                } 


                  
           }
      

            

            public function paymentform(){

                  $members=Member::all();
                return view('member.paymentform',compact('members'));
            }
}
