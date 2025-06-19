<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClientProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientProfileController extends Controller
{
    // Mostra il profilo dell'utente autenticato
    public function show($id)
    {
        // Verifica che l'ID richiesto corrisponda all'utente autenticato
        if ($id != Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $profile = ClientProfile::where('user_id', $id)->first();

        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        return response()->json($profile);
    }
    // Crea un nuovo profilo per l'utente autenticato
    public function store(Request $request)
    {
        $validated = $request->validate([
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|max:300',
            'height_cm' => 'nullable|integer|min:30|max:300',
            'weight_kg' => 'nullable|integer|min:10|max:500',
            'fitness_goals' => 'nullable|string|max:1000',
            'training_preferences' => 'nullable|string|max:1000',
        ]);

        $profile = ClientProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            $validated
        );

        return response()->json($profile, $profile->wasRecentlyCreated ? 201 : 200);
    }

    // Aggiorna il profilo dell'utente autenticato
    public function update(Request $request)
    {
        $validated = $request->validate([
            'birth_date' => 'sometimes|date',
            'gender' => 'sometimes|in:male,female,other',
            'height_cm' => 'sometimes|integer|min:30|max:300',
            'weight_kg' => 'nullable|integer|min:10|max:500',
            'fitness_goals' => 'nullable|string|max:1000',
            'training_preferences' => 'nullable|string|max:1000',
        ]);

        $profile = ClientProfile::where('user_id', Auth::id())->first();

        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        $profile->update($validated);

        return response()->json($profile);
    }

    // Elimina il profilo
    public function destroy()
    {
        $profile = ClientProfile::where('user_id', Auth::id())->first();

        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        $profile->delete();

        return response()->json(['message' => 'Profile deleted']);
    }
}
