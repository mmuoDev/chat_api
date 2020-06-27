<?php

namespace App\Services;

use App\Message;
use App\User;
use App\Services\MessageService;
use Illuminate\Cache\CacheManager;

class CacheService 
{
    const DURATION = 3600;

    protected $messageService;

    protected $cache;

    public function __construct(MessageService $messageService, CacheManager $cache)
    {
        $this->messageService = $messageService;
        $this->cache = $cache;

    }

    //clears cache and store in DB
    public function store(array $messageData)
    {
        return tap($this->messageService->store($messageData), function(Message $message){
           $this->cache->forget($message->sender_username);
        });
    }   
    
    //retrieve from cache, DB 
    public function retrieve(User $user)
    {
        return $this->cache->remember($user->username, static::DURATION, function() use ($user){
            return $this->messageService->retrieve($user);
        });
        
    } 

}