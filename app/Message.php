<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = [
        'sender_username', 'receiver_username', 'message', 'message_id', 'read_at'
    ];

}
