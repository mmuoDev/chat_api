<?php

namespace App\Observers;

use App\Message;

class MessageObserver
{
    //
    public function creating(Message $message)
    {
      $message->message_id = uniqid();
    }
}
