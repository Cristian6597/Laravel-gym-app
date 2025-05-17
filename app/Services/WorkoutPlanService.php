<?php

namespace App\Services;

use App\Models\WorkoutPlan;
use App\Repositories\WorkoutPlanRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkoutPlanService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected WorkoutPlanRepository $workoutPlanRepository) {}

    public function create(Request $request)
    {

        // salvo i dati ricevuti dalla request nel db
        $workoutPlan = $this->workoutPlanRepository->save($request);


        return $workoutPlan;
    }

    public function update(Request $request, WorkoutPlan $workoutPlan)
    {
        $workoutPlan = $this->workoutPlanRepository->update($request, $workoutPlan);

        return $workoutPlan;
    }

    public function delete(WorkoutPlan $workoutPlan)
    {
        $res = $this->workoutPlanRepository->delete($workoutPlan);

        return $res;
    }
}
