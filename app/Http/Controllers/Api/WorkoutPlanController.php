<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkoutPlanRequest;
use App\Models\WorkoutPlan;
use App\Services\WorkoutPlanService;
use Illuminate\Http\Request;
use App\Http\Resources\WorkoutPlanResource;

class WorkoutPlanController extends Controller
{

    public function __construct(protected WorkoutPlanService $workoutPlanService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        // Se è un client, mostra solo i suoi piani
        if ($user->role === 'client') {
            return WorkoutPlan::where('client_id', $user->id)->with('trainer:id,first_name,last_name')->get();
        }

        // Se è un trainer, mostra quelli creati da lui
        if ($user->role === 'trainer') {
            return WorkoutPlan::where('trainer_id', $user->id)->with('client:id,first_name,last_name')->get();
        }

        // Admin: tutto
        return WorkoutPlan::with(['trainer:id,first_name,last_name', 'client:id,first_name,last_name'])->get();
    }

    public function show($id)
    {
        return WorkoutPlan::with('exercises')->findOrFail($id);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkoutPlanRequest $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'client_id' => 'required|integer|exists:users,id',
            'trainer_id' => 'required|integer|exists:users,id',
            'general_notes' => 'nullable|string',
        ]);

        $workoutPlan = WorkoutPlan::create($validated);

        return response()->json($workoutPlan, 201);
    }

    /**
     * Display the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(WorkoutPlanRequest $request, WorkoutPlan $workoutPlan)
    {
        $workoutPlan = $this->workoutPlanService->update($request, $workoutPlan);
        return new WorkoutPlanResource($workoutPlan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkoutPlan $workoutPlan)
    {
        $this->workoutPlanService->delete($workoutPlan);
        return response()->json([
            'message' => 'Workout plan deleted successfully'
        ]);
    }
}
