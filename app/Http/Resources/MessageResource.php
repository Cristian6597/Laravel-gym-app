<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'content' => $this->content,
            'sent_at' => $this->sent_at,
            'read' => $this->read,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}
