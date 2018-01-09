<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RentalReqToOwner extends Mailable
{
    use Queueable, SerializesModels;

    public $rental;

    public function __construct($rental)
    {
        $this->rental = $rental;
    }

    public function build()
    {
        return $this->from('rudy.werner@telenet.be')
                    ->subject('PROFICIAT... U hebt een verhuur !')
                    ->view('mails.rentals.rentReqToOwnerHtml')
                    ->text('mails.rentals.rentReqToOwnerPlain');
    }
}
