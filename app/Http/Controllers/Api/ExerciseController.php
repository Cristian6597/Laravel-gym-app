<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExerciseRequest;
use App\Models\Exercise;
use App\Services\ExerciseService;
use Illuminate\Http\Request;
use App\Http\Resources\ExerciseResource;

class ExerciseController extends Controller
{

    public function __construct(protected ExerciseService $exerciseService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Exercise::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExerciseRequest $request)
    {
        $exercise = $this->exerciseService->create($request);
        return new ExerciseResource($exercise);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $exercise = Exercise::findOrFail($id);
        return new ExerciseResource($exercise);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExerciseRequest $request, Exercise $exercise)
    {
        $exercise = $this->exerciseService->update($request, $exercise);
        return new ExerciseResource($exercise);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $Exercise)
    {
        $this->exerciseService->delete($Exercise);
        return response()->json([
            'message' => 'Exercise deleted successfully'
        ]);
    }
}
