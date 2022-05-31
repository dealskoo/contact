<?php

namespace Dealskoo\Contact\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContactCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $first_name;
    public $last_name;
    public $email;
    public $title;
    public $message;

    public function __construct($first_name, $last_name, $email, $title, $message)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->title = $title;
        $this->message = $message;
    }
}
