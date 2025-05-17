<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Services\MessageService;
use Illuminate\Http\Request;
use App\Http\Resources\MessageResource;

class MessageController extends Controller
{

    public function __construct(protected MessageService $messageService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Message::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageRequest $request)
    {
        $message = $this->messageService->create($request);
        return new MessageResource($message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $message = Message::findOrFail($id);
        return new MessageResource($message);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MessageRequest $request, Message $message)
    {
        $message = $this->messageService->update($request, $message);
        return new MessageResource($message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $this->messageService->delete($message);
        return response()->json([
            'message' => 'Message deleted successfully'
        ]);
    }
}
