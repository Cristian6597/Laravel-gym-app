<?php

namespace App\Services;

use App\Models\Notification;
use App\Repositories\NotificationRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotificationService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected NotificationRepository $notificationRepository) {}

    public function create(Request $request)
    {

        // salvo i dati ricevuti dalla request nel db
        $notification = $this->notificationRepository->save($request);


        return $notification;
    }

    public function update(Request $request, Notification $notification)
    {
        $notification = $this->notificationRepository->update($request, $notification);

        return $notification;
    }

    public function delete(Notification $notification)
    {
        $res = $this->notificationRepository->delete($notification);

        return $res;
    }
}
