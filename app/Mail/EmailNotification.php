<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $messageSender;

    public function __construct($messageSender)
    {
        $this->messageSender = $messageSender;
    }

    public function build()
    {
        return $this->from('rudy.werner@telenet.be')
                    ->subject('U hebt een nieuw bericht in uw INBOX')
                    ->view('mails.messaging.emailNotifHtml')
                    ->text('mails.messaging.emailNotifPlain');
    }
}
