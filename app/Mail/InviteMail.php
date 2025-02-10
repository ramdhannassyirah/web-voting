<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $inviteLink;

    public function __construct($inviteLink)
    {
        $this->inviteLink = $inviteLink;
    }

    public function build()
    {
        return $this->subject('Undangan untuk Voting')
                    ->view('emails.invite')
                    ->with([
                        'inviteLink' => $this->inviteLink,
                    ]);
    }
}