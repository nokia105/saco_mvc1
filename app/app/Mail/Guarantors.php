<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Member;
use App\Loan;

class Guarantors extends Mailable
{
    use Queueable, SerializesModels;
     public $member;
     public $loan;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Member $member, Loan $loan)
    {
        
        $this->member=$member;
        $this->loan=$loan;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.guarantors');
    }
}
