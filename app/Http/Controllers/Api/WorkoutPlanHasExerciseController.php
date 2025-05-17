<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkoutPlanHasExerciseRequest;
use App\Models\WorkoutPlanHasExercise;
use App\Services\WorkoutPlanHasExerciseService;
use Illuminate\Http\Request;
use App\Http\Resources\WorkoutPlanHasExerciseResource;

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
    public function store(WorkoutPlanHasExerciseRequest $request)
    {
        $workoutPlanHasExercise = $this->workoutPlanHasExerciseService->create($request);
        return new WorkoutPlanHasExerciseResource($workoutPlanHasExercise);
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
