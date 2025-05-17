<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkoutProgressRequest;
use App\Models\WorkoutProgress;
use App\Services\WorkoutProgressService;
use Illuminate\Http\Request;
use App\Http\Resources\WorkoutProgressResource;

class WorkoutProgressController extends Controller
{

    public function __construct(protected WorkoutProgressService $workoutProgressService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return WorkoutProgress::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkoutProgressRequest $request)
    {
        $workoutProgress = $this->workoutProgressService->create($request);
        return new WorkoutProgressResource($workoutProgress);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $workoutProgress = WorkoutProgress::findOrFail($id);
        return new WorkoutProgressResource($workoutProgress);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WorkoutProgressRequest $request, WorkoutProgress $workoutProgress)
    {
        $workoutProgress = $this->workoutProgressService->update($request, $workoutProgress);
        return new WorkoutProgressResource($workoutProgress);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkoutProgress $workoutProgress)
    {
        $this->workoutProgressService->delete($workoutProgress);
        return response()->json([
            'message' => 'Workout Progress deleted successfully'
        ]);
    }
}
