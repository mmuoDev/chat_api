<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Http\Resources\MessageResource;
use App\Message;
use App\Services\CacheService;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{

    //retrieve messages
    public function index(Request $request, CacheService $cacheService)
    {
        $messages = $cacheService->retrieve($request->user());
        return MessageResource::collection($messages);
    }

    //save messages
    public function store(MessageRequest $request, CacheService $cacheService)
    {
        $messageData = $request->getData();
        $message = $cacheService->store($messageData);
        return new MessageResource($message);
    }
   
}
