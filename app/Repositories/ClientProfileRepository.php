<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\ClientProfile;

class ClientProfileRepository
{
v
    public function sae(Request $request)
    {
        $clientProfile = $request->user()->ClientProfiles()->create($request->except('image', 'tags'));

        // assegno i tags al veicolo creando un record nella pivot table tag_ClientProfile
        $clientProfile->tags()->attach($request->tags, [
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $clientProfile;
    }

    public function update(Request $request, ClientProfile $clientProfile)
    {
        $clientProfile->update($request->except('image', 'tags'));
        $clientProfile->tags()->sync($request->tags, [
            'updated_at' => now()
        ]);
        return $clientProfile;
    }

    public function delete(ClientProfile $clientProfile)
    {
        $clientProfile->delete();
        return response()->noContent();
    }
}
