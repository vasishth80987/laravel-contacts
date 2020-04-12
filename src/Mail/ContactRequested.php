<?php

namespace Vsynch\Contacts\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactRequested extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;

    public $recipient;

    /**
     * Create a new message instance.
     * @param User $user send user object
     * @param string $recipient recipient name
     *
     * @return void
     */
    public function __construct(User $user,$recipient)
    {
        $this->sender = $user;
        $this->recipient = $recipient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('vendor.vsynch.contacts.mail.send_request');
    }
}
