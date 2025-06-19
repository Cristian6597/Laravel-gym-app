<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainerRequest;
use App\Http\Resources\TrainerResource;
use App\Models\Trainer;
use App\Models\User;
use App\Services\TrainerService;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function __construct(protected TrainerService $trainerService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Trainer::with(['user' => function ($query) {
            $query->select('id', 'first_name', 'last_name'); // Seleziona solo i campi necessari
        }])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrainerRequest $request)
    {
        // Recupera l'utente autenticato
        $user = $request->user();

        // Controlla se l'utente è già un trainer
        if (Trainer::where('user_id', $user->id)->exists()) {
            return response([
                'message' => 'Utente è già un trainer.',
                'errors' => ['user_id' => ['L\'utente è già un trainer.']]
            ], 422);
        }

        // Crea il trainer
        $trainer = Trainer::create([
            'user_id'          => $user->id,
            'phone'            => $request->input('phone'),
            'birth_date'       => $request->input('birth_date'),
            'specialty'        => $request->input('specialty'),
            'bio'              => $request->input('bio'),
            'certifications'   => $request->input('certifications'),
            'years_experience' => $request->input('years_experience'),
        ]);

        // Dopo aver creato il trainer, aggiorna il ruolo dell'utente
        $user->role = 'trainer';
        $user->save();

        return response([
            'message' => 'Trainer creato con successo.',
            'trainer' => $trainer
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $trainer = Trainer::findOrFail($id);
        return new TrainerResource($trainer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TrainerRequest $request, Trainer $trainer)
    {
        $trainer = $this->trainerService->update($request, $trainer);
        return new TrainerResource($trainer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trainer $trainer)
    {
        $this->trainerService->delete($trainer);
        return response()->json([
            'message' => 'Client profile deleted successfully'
        ]);
    }
}
