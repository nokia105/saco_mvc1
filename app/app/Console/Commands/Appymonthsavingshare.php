<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Appymonthsavingshare extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Appymonthsavingshare:monthsavingshare';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Month saving,share status';

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
        // 

        $members=Member::whereDoesntHave('savingamount', function ($query) {
              $curentdate=explode('-',date('Y-m-d'));
              $year=$curentdate[0];
             $month=$curentdate[1];
             
             $query->whereYear('saving_date', $year)->whereMonth('saving_date',$month);
               })->get();

                foreach($members as $key=>$member){ 

                         $noshares=$member->no_shares->where('state','in')->sum('No_shares')-$member->no_shares->where('state','out')->sum('No_shares');

                        Monthsavingshare::create([ 
                             'member_id'=>$member->member_id,
                             'saving_status'=>'unpaid',
                             'share_status'=>($noshares>=1000) ? 'paid' :'unpaid',
                             'date'=>date('Y-m-d')
                         ]);
                         }



        


          //if member does not exist in both tables in that month apply that general  status is unpaid

                    

          //if member exist compare the amount paid to amount promised per month 
            //if the mount is less the status is incomplite and take that out take (monthaount-incmpliteamount)

         //if member does not exist in one table aply unpaid to only one row
         
          //check current month to all member and aply and record saving and share status unpaid
    }
}
