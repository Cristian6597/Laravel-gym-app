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
    public function index(Request $request)
    {
        return WorkoutPlan::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkoutPlanRequest $request)
    {
        $workoutPlan = $this->workoutPlanService->create($request);
        return new WorkoutPlanResource($workoutPlan);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $workoutPlan = WorkoutPlan::findOrFail($id);
        return new WorkoutPlanResource($workoutPlan);
    }

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
