<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RentalReqToRenter extends Mailable
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
                    ->subject('Kopie van uw huuraanvraag')
                    ->view('mails.rentals.rentReqToRenterHtml')
                    ->text('mails.rentals.rentReqToRenterPlain');
    }
}
