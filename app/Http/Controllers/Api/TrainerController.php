<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainerRequest;
use App\Http\Resources\TrainerResource;
use App\Models\Trainer;
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

        return Trainer::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrainerRequest $request)
    {
        // Prendi i dati validati
        $data = $request->validated();

        // Aggiungi user_id dall'utente loggato
        $data['user_id'] = auth()->id();

        // Crea il trainer
        $trainer = Trainer::create($data);

        return response()->json($trainer, 201);
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
