<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotificationRequest;
use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;

class NotificationController extends Controller
{

    public function __construct(protected NotificationService $notificationService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Notification::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NotificationRequest $request)
    {
        $notification = $this->notificationService->create($request);
        return new NotificationResource($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $notification = Notification::findOrFail($id);
        return new NotificationResource($notification);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NotificationRequest $request, Notification $notification)
    {
        $notification = $this->notificationService->update($request, $notification);
        return new NotificationResource($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        $this->notificationService->delete($notification);
        return response()->json([
            'message' => 'Notification deleted successfully'
        ]);
    }
}
