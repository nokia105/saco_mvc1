<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Member;
use App\Loan;
use App\Voucher;
use App\Member_share;
use App\Membersaving;
use App\Loanaccount;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


          view()->composer(['loans.template','member.member_template'],function($view){

         $id=request()->segment(2);
         $view->with('member',Member::find($id));
        $view->with('submitted_loans',Member::find($id)->loanlist->where('loan_status','=','submitted')->count());
        $view->with('no_loans',Member::find($id)->loanlist->where('loan_status','=','paid')->count());
         $view->with('rejected_loans',Member::find($id)->loanlist->where('loan_status','=','rejected')->count());
          $view->with('pending_loans',Member::find($id)->loanlist->where('loan_status','=','pending')->count());
        });

          view()->composer(['layouts.master','dashboard.template'],function($view){

               
               $view->with('drafted',Loan::where('loan_status','draft')->count());
               $view->with('submitted',Loan::where('loan_status','submitted')->count());
              $view->with('reviewed',Loan::where('loan_status','reviewed')->count());
              $view->with('assessed',Loan::where('loan_status','assessed')->count());
              $view->with('approved',Loan::where('loan_status','approved')->count());
             $view->with('pending',Loan::where('loan_status','pending')->count());
              $view->with('provisioned',Loan::where('loan_status','provisioned')->count());
             $view->with('pending_vouchers',Voucher::where('status','pending')->count());
             $view->with('approved_vouchers',Voucher::where('status','approved')->count());
            // $view->with('expectedmonthinterest',Loan::where('status','paid')->loanschedule->sum('monthinterest'));
          });


     view()->composer(['dashboard.template'],function($view){

         $view->with('members',Member::where('status','=','active')->count());
         $view->with('shares',Member_share::sum('amount'));
         $view->with('savings',Membersaving::sum('amount'));
         $view->with('loans',Loanaccount::sum('cr'));
     
        });

        Schema::defaultStringLength(191);



    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
