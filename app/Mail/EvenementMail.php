<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class EvenementMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($evenement)
    {
        $this->evenement = $evenement;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from(config('mail.from.address'), config('mail.from.name'))->view('mails.evenement')->with(['evenement' => $this->evenement]);

        $mail->subject = "Ajout d'un nouvel évènement sur la plateforme animPhar de ULB";

        return $mail;
    }
}
