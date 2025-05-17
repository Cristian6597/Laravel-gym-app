<?php

namespace App\Services;

use App\Models\Message;
use App\Repositories\MessageRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessageService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected MessageRepository $messageRepository) {}

    public function create(Request $request)
    {

        // salvo i dati ricevuti dalla request nel db
        $message = $this->messageRepository->save($request);


        return $message;
    }

    public function update(Request $request, Message $message)
    {
        $message = $this->messageRepository->update($request, $message);

        return $message;
    }

    public function delete(Message $message)
    {
        $res = $this->messageRepository->delete($message);

        return $res;
    }
}
