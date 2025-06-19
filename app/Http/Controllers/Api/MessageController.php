<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Models\User;
use App\Services\MessageService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct(protected MessageService $messageService) {}

    // Chat tra trainer e cliente
    public function getMessages(User $receiver)
    {
        $user = auth()->user();

        $messages = Message::where(function ($query) use ($user, $receiver) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', $receiver->id);
        })->orWhere(function ($query) use ($user, $receiver) {
            $query->where('sender_id', $receiver->id)
                ->where('receiver_id', $user->id);
        })->orderBy('sent_at')->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
            'sent_at' => now(), // Assicurati che sia fillable
        ]);

        return response()->json($message);
    }

    public function myClients()
    {
        $trainer = auth()->user();

        // Assumi che esista una relazione trainer->clients
        $clients = $trainer->clients()->select('id', 'name', 'email')->get();

        return response()->json($clients);
    }

    public function index(Request $request)
    {
        return Message::all();
    }

    public function store(MessageRequest $request)
    {
        $message = $this->messageService->create($request);
        return new MessageResource($message);
    }

    public function show(string $id)
    {
        $message = Message::findOrFail($id);
        return new MessageResource($message);
    }

    public function update(MessageRequest $request, Message $message)
    {
        $message = $this->messageService->update($request, $message);
        return new MessageResource($message);
    }

    public function destroy(Message $message)
    {
        $this->messageService->delete($message);

        return response()->json([
            'message' => 'Message deleted successfully'
        ]);
    }
}
