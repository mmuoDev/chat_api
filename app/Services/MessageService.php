<?php

namespace App\Services;

use App\Http\Requests\MessageRequest;
use App\Message;
use App\User;
use Illuminate\Http\Request;

class MessageService 
{
    protected $model;
    //
    public function __construct(Message $message)
    {
        $this->model = $message;
    }

    
    public function retrieve(User $user)
    {
        return $this->model->where('receiver_username', $user->username)->get();
    }

    public function store(array $messageData): Message
    {
        return $this->model->create($messageData);
    }
        
}