<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkoutPlanHasExerciseRequest;
use App\Models\WorkoutPlanHasExercise;
use App\Services\WorkoutPlanHasExerciseService;
use Illuminate\Http\Request;
use App\Http\Resources\WorkoutPlanHasExerciseResource;
use App\Models\WorkoutPlan;

class WorkoutPlanHasExerciseController extends Controller
{

    public function __construct(protected WorkoutPlanHasExerciseService $workoutPlanHasExerciseService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return WorkoutPlanHasExercise::all();
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request, WorkoutPlan $workout_plan)
    {
        $validated = $request->validate([
            'exercises' => 'required|array|min:1',
            'exercises.*.name' => 'required|string|max:255',
            'exercises.*.sets' => 'nullable|integer|min:1',
            'exercises.*.repetitions' => 'nullable|integer|min:1',
            'exercises.*.load' => 'nullable|numeric|min:0',
            'exercises.*.notes' => 'nullable|string',
        ]);

        // Pulizia esercizi esistenti, se vuoi sovrascrivere
        $workout_plan->exercises()->delete();

        // Inserisci i nuovi esercizi
        foreach ($validated['exercises'] as $exerciseData) {
            $workout_plan->exercises()->create([
                'name' => $exerciseData['name'],
                'sets' => $exerciseData['sets'] ?? null,
                'repetitions' => $exerciseData['repetitions'] ?? null,
                'load' => $exerciseData['load'] ?? null,
                'notes' => $exerciseData['notes'] ?? null,
            ]);
        }

        return response()->json(['message' => 'Esercizi salvati con successo']);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $workoutPlanHasExercise = WorkoutPlanHasExercise::findOrFail($id);
        return new WorkoutPlanHasExerciseResource($workoutPlanHasExercise);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WorkoutPlanHasExerciseRequest $request, WorkoutPlanHasExercise $workoutPlanHasExercise)
    {
        $workoutPlanHasExercise = $this->workoutPlanHasExerciseService->update($request, $workoutPlanHasExercise);
        return new WorkoutPlanHasExerciseResource($workoutPlanHasExercise);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkoutPlanHasExercise $workoutPlanHasExercise)
    {
        $this->workoutPlanHasExerciseService->delete($workoutPlanHasExercise);
        return response()->json([
            'message' => 'Workout Plan Has Exercise deleted successfully'
        ]);
    }
}
