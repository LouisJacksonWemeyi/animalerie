<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class NewUserMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $clear_pass)
    {
        $this->user = $user;
        $this->clear_pass = $clear_pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from(config('mail.from.address'), config('mail.from.name'))->view('mails.new_user')->with(['user' => $this->user, 'clear_pass' => $this->clear_pass]);

        $mail->subject = "Inscription sur la plateforme animPhar";

        return $mail;
    }
}
