<?php

namespace App\Services;

use App\Models\WorkoutPlanHasExercise;
use App\Repositories\WorkoutPlanHasExerciseRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkoutPlanHasExerciseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected WorkoutPlanHasExerciseRepository $workoutPlanHasExerciseRepository) {}

    public function create(Request $request)
    {

        // salvo i dati ricevuti dalla request nel db
        $workoutPlanHasExercise = $this->workoutPlanHasExerciseRepository->save($request);


        return $workoutPlanHasExercise;
    }

    public function update(Request $request, WorkoutPlanHasExercise $workoutPlanHasExercise)
    {
        $workoutPlanHasExercise = $this->workoutPlanHasExerciseRepository->update($request, $workoutPlanHasExercise);

        return $workoutPlanHasExercise;
    }

    public function delete(WorkoutPlanHasExercise $workoutPlanHasExercise)
    {
        $res = $this->workoutPlanHasExerciseRepository->delete($workoutPlanHasExercise);

        return $res;
    }
}
