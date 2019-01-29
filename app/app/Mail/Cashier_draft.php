<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Cashier_draft extends Mailable
{
    use Queueable, SerializesModels;
    public  $loan;
    public $cashier;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cashier,$loan)
    {
        $this->cashier=$cashier;
        $this->loan=$loan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.cashier_draft');
    }
}
