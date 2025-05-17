<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\User;

class UserRepository
{

    public function save(Request $request)
    {
        $user = $request->user()->Users()->create($request->except('image', 'tags'));

        // assegno i tags al veicolo creando un record nella pivot table tag_User
        $user->tags()->attach($request->tags, [
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $user;
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->except('image', 'tags'));
        $user->tags()->sync($request->tags, [
            'updated_at' => now()
        ]);
        return $user;
    }

    public function delete(User $user)
    {
        $user->delete();
        return response()->noContent();
    }
}
