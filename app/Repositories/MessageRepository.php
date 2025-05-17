<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageRepository
{

    public function save(Request $request)
    {
        $message = $request->message()->Messages()->create($request->except('image', 'tags'));

        // assegno i tags al veicolo creando un record nella pivot table tag_Message
        $message->tags()->attach($request->tags, [
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $message;
    }

    public function update(Request $request, Message $message)
    {
        $message->update($request->except('image', 'tags'));
        $message->tags()->sync($request->tags, [
            'updated_at' => now()
        ]);
        return $message;
    }

    public function delete(Message $message)
    {
        $message->delete();
        return response()->noContent();
    }
}
