<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



/* Route::get('/members', function () {

   return view('member.member');

});*/
  Route::get('/savings', function () {


   return view('savings.savings');

});


    //codes

  Route::get('/codes_registration', function () {


   return view('codes.registration');

});
         
              //category
   Route::get('/category', function () {


   return view('category.index');

});
 
   //induarance

  Route::get('/insurances', function () {

    return view('Insurance.insurance');
});


   Route::get('/penalties', function () {

    return view('Penalty.penalties');

});


     Route::get('/tax', function () {
      
    return view('tax.index');

})->name('tax');


               //profit distribution
        Route::get('/profit_distribution', function () {
      
    return view('distributions.index');

})->name('profit_distribution');
   
       
        //interest method

    Route::get('/interest_methods', function () {

    return view('Methods.method');

})->name('interest_methods');


    Route::get('/Glaccount', function () {

    return view('category.accounts')->name('Glaccount');
});

      Route::get('/categoryaccountstypes', function () {

    return view('category.accountstypes');
})->name('categoryaccountstypes');


   Route::get('/main_accounts', function () {

    return view('category.main');
});

  Route::get('/loanCategory', function () {

    return view('LoanCategory.form');

});

   Route::get('/loan_fee', function () {

    return view('fee.fee');

});

     Route::get('profile/{id}/collateral', function () {

    return view('collateral.index');

});
 
  Route::get('/shares', function () {

   return view('shares.shares');
})->name('shares');
  
           //reports button in nav
     Route::get('/reports', function () {

   return view('reports.home');
})->name('reports');

  /* Route::get('/profile/{id}/membersavings', function () {

   return view('savings.membersavings');
});*/


   //membershare
  /* Route::get('', function () {

   return view('shares.membershares');
});*/

   Route::get('interestmethod','MembersProfileController@interestmethod')->name('interestmethod');
   Route::get('getprofit_distribution','ProfitdistributionController@index')->name('getprofit_distribution');

 

   
Auth::routes();

Route::get('/profile/{id}/membersavings','SavingsController@membersavings')->name('membersavings');
Route::get('/profile/{id}/member_allsavings','SavingsController@member_allsavings')->name('member_allsavings');


Route::get('/profile/{id}/membershares','SharesController@membershare')->name('memberShares');
Route::get('/profile/{id}/member_allshares','SharesController@member_allshare')->name('member_allshare');

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/memberRegister','MembersController@index')->name('memberRegister');
Route::get('/inactive_members','MembersController@index')->name('inactive_members');
Route::get('/members','MembersController@activemembers')->name('active_members');
Route::get('/member/edit/{id}','MembersController@edit')->name('member.edit');
Route::post('/member/update/{id}','MembersController@update')->name('member.update');
Route::get('member/delete/{id}','MembersController@delete')->name('member.delete');
Route::get('/memberRegister','MembersController@registerform')->name('registerform');
Route::post('saveregister','MembersController@saveregister')->name('saveregister');
Route::get('/gettax','TaxesControllers@gettax')->name('gettax');
Route::get('/register_excel','MembersController@register_excel')->name('register_excel');
Route::get('/reg_excel_download','MembersController@reg_excel_download')->name('reg_excel');
Route::post('store_reg_excel','MembersController@store_reg_excel')->name('store_reg_excel');

Route::get('/profile/{mprofileid}','MembersProfileController@cover')->name('profile');
Route::get('/profile/{id}/newloan','MembersProfileController@newloan')->name('newloan');
//Route::get('/profile/{id}/editloan/{lid}','MembersProfileController@editloan')->name('editloan');;
Route::get('/profile/{id}/schedule/{lid}','MembersProfileController@schedule')->name('schedule');
Route::get('/profile/{id}/loanlist','MembersProfileController@loanlist')->name('loanlist');
Route::get('/profile/{id}/loanlist/finished_loans','MembersProfileController@finished_loans')->name('finished_loans');
Route::get('/profile/{id}/loanlist/ongoing_loans','MembersProfileController@ongoing_loans')->name('ongoing_loans');

Route::get('/interest','MembersProfileController@interest')->name('interest');
Route::get('/membercollateral','MembersProfileController@membercollateral')->name('membercollateral');
Route::get('/loancharges','MembersProfileController@loancharges')->name('loancharges');
Route::get('/guarantors','MembersProfileController@guarantors')->name('guarantors');
Route::post('/memberloan','MembersProfileController@createloan');
Route::post('/updateloan','MembersProfileController@updateloan');


Route::get('/shareCreate','SharesController@index')->name('shareCreate');
Route::get('/savingCreate','SavingsController@index')->name('savingCreate');

Route::get('/table','TableController@table')->name('table');

Route::get('/loancat','LoancategoriesController@index')->name('loancat');
Route::get('/fee_category','LoancategoriesController@fee_category')->name('fee_category');


Route::get('/collat/{id}','CollateralsController@index')->name('collat');
Route::get('/loan','LoanController@index')->name('loan')->middleware('auth');
         
           //pdf download
Route::get('/pdf_download/{principle}/{interest}/{period}/{firstpayment}','MembersProfileController@pdfview')->name('pdfview');
Route::get('/profile/{id}/payment','MembersProfileController@payment');
Route::get('/profile/{id}/previous_payment','MembersProfileController@previous_payment')->name('previous_payment');
Route::get('/profile/previous_loan/{principle}/{interest}/{duration}/{pcategory}/{issued_date}/{startpayment}/{paidmonths}/{id}','MembersProfileController@previous_loan')->name('previous_loan');
Route::get('savings_shares_excel','MembersProfileController@savings_shares_excel')->name('savings_shares_excel');
Route::post('profile/{id}/store_shares_savings_excel','MembersProfileController@store_shares_savings_excel')->name('store_shares_savings_excel');
Route::get('/ajaxreceivepayment/{id}','MembersProfileController@ajaxreceivepayment')->name('ajaxreceivepayment');
Route::post('/payment','MembersProfileController@storepayments');
Route::get('profile/{id}/refund','MembersProfileController@refund')->name('refund');
Route::post('profile/{id}/post_refund','MembersProfileController@post_refund')->name('post_refund');
       


  //reports
  Route::get('/reports/loans','ReportsController@loanreportselection')->name('loanreportselection');
  Route::match(['get', 'post'],'reports/loans/find_report','ReportsController@find_loanreport')->name('find_loanreport');
  Route::get('/reports/shares','ReportsController@sharesreportselection')->name('sharesreportselection');
  Route::match(['get', 'post'],'reports/shares/find_report','ReportsController@find_sharesreport')->name('find_sharesreport');
  Route::get('/reports/savings','ReportsController@savingsreportselection')->name('savingsreportselection');
  Route::match(['get', 'post'],'reports/savings/find_report','ReportsController@find_savingsreport')->name('find_savingsreport');
  
        //loans
   Route::get('/drafted_loans','LoansController@drafted_loans')->name('drafted_loans');
   Route::get('/drafted/edit/{id}','LoansController@editloan')->name('drafted.edit');
   Route::post('/drafted/update/{id}','LoansController@update')->name('drafted.update');
   Route::get('/drafted/delete/{id}','LoansController@delete')->name('drafted.delete');
  Route::get('newloans_received','LoansController@newloans_received');
  Route::get('/loan_info/{id}','LoansController@loan_info')->name('loan_info');
  Route::get('/pending_loans','LoansController@appended_loans');
  Route::get('/rejected_loans','LoansController@rejected_loans');
  Route::get('/approved_loans','LoansController@approved_loans');
  Route::get('/paid_loans','LoansController@paid_loans');
  Route::get('/ready_vouchers','LoansController@ready_vouchers')->name('ready_vouchers');


  
   Route::post('/draft_submitted','LoansController@draft_submitted');
   Route::get('/submit/{id}','LoansController@submit')->name('submit');
  Route::get('/agree/{id}','LoansController@agree')->name('agree');
  Route::get('approve_voucher/{id}','LoansController@approve_voucher')->name('approve_voucher');
  Route::get('/paid/{id}','LoansController@paid')->name('paid');
  Route::get('/voucher{id}','LoansController@voucher')->name('voucher');
  Route::post('/agree_submitted','LoansController@agree_submitted');
  Route::post('approve_voucher_submitted','LoansController@approve_voucher_submitted')->name('approve_voucher_submitted');
  Route::post('/paid_submitted','LoansController@paid_submitted')->name('paid_submitted');

 Route::get('/reject/{id}','LoansController@reject')->name('reject');
 Route::get('provision/{id}','LoansController@provision')->name('provision');
 Route::post('provision_reason','LoansController@provision_reason')->name('provision_reason');
 Route::get('provisioned_loans','LoansController@provisioned_loans')->name('provisioned_loans');
 Route::get('provisioned_loans/edit/{id}','LoansController@editprovision')->name('provisioned.edit');
 Route::post('provisioned_loans/update/{id}','LoansController@provisioned_update')->name('provisioned.update');
 Route::post('/reject_submitted','LoansController@reject_submitted');
 Route::get('aging_loans','LoansController@aging_loans')->name('aging_loans');

 Route::get('/pending/{id}','LoansController@pending')->name('pending');
 Route::post('/pending_submitted','LoansController@pending_submitted');
 Route::post('/voucher_submitted','LoansController@voucher_submitted');


 //isuarance by ajax
 Route::get('/insuarance','InsurancesController@index')->name('insurance');
 Route::get('interestmethods','InterestmethodsController@index')->name('interestmethods');
 Route::get('processed_loans','LoansController@processed_loans')->name('processed_loans');
 Route::get('/unpaid_vouchers','LoansController@unpaid_vouchers');

         //penalty

 Route::get('/penalty','PenaltyController@index')->name('penalty');
                  //codes
 Route::get('/codes','CodeController@index')->name('codes');
 Route::get('/Accategory','CategoryaccountController@index')->name('category');
 Route::get('accountstypes','CategoryaccountController@accountstypes')->name('accountstypes');
 Route::get('/accounts','GlaccountController@index')->name('accounts');
 Route::get('/mainaccounts','MainaccountController@index')->name('mainaccounts');


                           //reports
 Route::get('reports/loans_month','ReportsController@loans_month')->name('loans_month');
 Route::post('reports/loans_month','ReportsController@retrive_loans_month')->name('dataloans_month');
 Route::get('reports/loans_time_range','ReportsController@loans_time_range')->name('loans_time_range');
 Route::post('reports/loans_time_range','ReportsController@retrive_loans_time_range');
 Route::get('reports/expected_profit','ReportsController@expected_profit')->name('expected_profit');
 Route::post('reports/retrive_expected_profit','ReportsController@retrive_expected_profit');
 Route::get('saving_reports','ReportsController@savings_reports')->name('savings_reports');
 Route::post('savings_reports_time','ReportsController@savings_reports_time')->name('savings_reports_time');
 Route::get('shares_reports','ReportsController@shares_reports')->name('shares_reports');
 Route::post('shares_reports_time','ReportsController@shares_reports_time')->name('shares_reports_time');


  
  Route::get('member/login','Auth\MemberloginController@showLoginForm')->name('member.login');

  Route::post('member/login','Auth\MemberloginController@login');
 // Route::post('member/logout','Auth\MemberloginController@logout')->name('member.logout');
  Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

  Route::resource('Admin_member','AdminmemberController');
 //Route::get('/admin','Admincontroller@index');
 Route::resource('permissions','permissionController');
 Route::resource('roles','RoleController');


   //print
 Route::get('/paidloans_slip/{id}','LoansController@paidloans_slip')->name('paidloans_slip');
 Route::get('/member/{id}','MemberinfoController@dashboard');
 Route::get('/repayment_slip/{member_id}/{amountinput}/{getpaymenttype}','MembersProfileController@repayment_slip')->name('repayment_slip');




          //member account 
  Route::get('/member/{id}/savings','MemberinfoController@savings');
  Route::get('/member/{id}/allsavings','MemberinfoController@allsavings')->name('allsavings');
  Route::get('/member/{id}/shares','MemberinfoController@shares');
  Route::get('/member/{id}/allshares','MemberinfoController@allshares')->name('allshares');
  Route::get('/member/{id}/collaterals','MemberinfoController@collaterals');
  Route::get('/member/{id}/payments','MemberinfoController@payments');
  Route::get('/member/{id}/loans','MemberinfoController@loans');
  Route::get('/member/{id}/loan_info/{lid}','MemberinfoController@loan_info');
  Route::get('/member/{id}/apply_loan','MemberinfoController@apply_loan')->name('apply_loan');
  Route::post('/member/store_appliedloan','MemberinfoController@store_appliedloan')->name('store_appliedloan');
  Route::get('/member/{id}/guarantor','MemberinfoController@guarantor')->name('member_guarantor');
  Route::get('/member/gurantor_approve/{id}','MemberinfoController@guarantor_approve')->name('guarantor_approve');
  Route::get('/member/gurantor_reject/{id}','MemberinfoController@guarantor_reject')->name('guarantor_reject');
  Route::post('member/save_guarantor_status/{id}','MemberinfoController@save_guarantor_status')->name('save_guarantor_status');

  Route::get('/member/{id}/profile','MemberinfoController@profile')->name('profile');
  Route::get('/member/{id}','MembersController@member_profile')->name('member_profile');

  Route::post('/member/{id}/picture_update','MemberinfoController@picture_update')->name('picture_update');
  Route::get('/member/{id}/password_modal','MemberinfoController@password_modal')->name('password_modal');
  Route::get('member/{id}/pass_change','MemberinfoController@pass_change')->name('pass_change');


        //finacial reports

    Route::get('/income_statments','ReportsController@income_statments')->name('');
    Route::get('/balance_sheets','ReportsController@balance_sheets')->name('balance_sheets');
  Route::post('/duration_incomestatment','ReportsController@duration_incomestatment')->name('duration_incomestatment');
    Route::post('/findbalance_sheets','ReportsController@findbalance_sheets')->name('findbalance_sheets');
    Route::get('/printcheck','LoansController@printcheck')->name('printcheck');
    Route::get('/printdispatch','LoansController@printdispatch')->name('printdispatch');
    Route::get('viewcheckprint','LoansController@viewcheckprint');
    Route::get('/Expenses','MainaccountController@expenses')->name('expenses');
    Route::get('expenseajax','MainaccountController@expenseajax')->name('expenseajax');
    Route::post('/storeexpenses','MainaccountController@storeexpenses')->name('storeexpenses');

                          //assets
    Route::get('/test','MainaccountController@test')->name('testreceipt');
    Route::get('test2','MainaccountController@test2')->name('test2');

    Route::get('/asset_register','MainaccountController@assetregister')->name('assetregister');
    Route::post('/store_asset','MainaccountController@store_asset')->name('store_asset');
    Route::get('/disposal','MainaccountController@disposal')->name('disposal');
    Route::post('/post_disposal','MainaccountController@post_disposal')->name('post_disposal');

    Route::get('/member_payment','MembersController@paymentform')->name('member_payment');
    Route::post('/post_previous_loan/{id}','MembersProfileController@post_previous_loan')->name('post_previous_loan');
    Route::get('/allpayments','PaymentsController@allpayments')->name('allpayments');
    Route::get('/printallmember_topay','PaymentsController@printallmember_topay')->name('printallmember_topay');
    
    Route::get('pay_allmembers','PaymentsController@pay_allmembers')->name('pay_allmembers');
   Route::get('duration_payment','PaymentsController@duration_payment')->name('duration_payment');
    Route::post('payment_list','PaymentsController@payment_list')->name('payments_list');


      //dashboards

    Route::get('/','DashboardController@index')->name('home');
    Route::get('/cash_flow','ReportsController@cash_flow')->name('cash_flow');
    Route::post('/find_cash_flow','ReportsController@find_cash_flow')->name('find_cash_flow');
    Route::get('/capital_change','ReportsController@capital_change')->name('capital_change');
    Route::post('/find_capital_change','ReportsController@find_capital_change')->name('find_capital_change');

  /*  Route::get('/dashboard/chair','DashboardController@dashboard_chair')->name('dashboard.chair');
    Route::get('/dashboard/loanofficer','DashboardController@dashboard_loanofficer')->name('dashboard_loanofficer');
    Route::get('/dashboard/cashier','DashboardController@dashboard_cashier')->name('dashboard_cashier');
    Route::get('/dashboard/accountant','DashboardController@dashboard_accountant')->name('dashboard_accountant');*/

 

 


  