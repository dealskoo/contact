<?php

namespace Dealskoo\Contact\Mail;

use Illuminate\Mail\Mailable;

class ContactMail extends Mailable
{
    private $first_name;
    private $last_name;
    private $mail_address;
    private $title;
    private $message;

    public function __construct($first_name, $last_name, $mail_address, $title, $message)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->mail_address = $mail_address;
        $this->title = $title;
        $this->message = $message;
    }

    public function build()
    {
        return $this->replyTo($this->mail_address, $this->first_name . ' ' . $this->last_name)
            ->subject($this->title)
            ->markdown('emails.contect', ['message' => $this->message]);
    }
}
