<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'message'=> $this->message,
            'receiver' => $this->receiver_username,
            'sender' => $this->sender_username,
            'sent_at' => $this->created_at
        ];
    }
}
