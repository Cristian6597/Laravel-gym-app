<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationRepository
{

    public function save(Request $request)
    {
        $notification = $request->user()->Notifications()->create($request->except('image', 'tags'));

        // assegno i tags al veicolo creando un record nella pivot table tag_Notification
        $notification->tags()->attach($request->tags, [
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $notification;
    }

    public function update(Request $request, Notification $notification)
    {
        $notification->update($request->except('image', 'tags'));
        $notification->tags()->sync($request->tags, [
            'updated_at' => now()
        ]);
        return $notification;
    }

    public function delete(Notification $notification)
    {
        $notification->delete();
        return response()->noContent();
    }
}
