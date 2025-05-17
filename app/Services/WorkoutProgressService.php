<?php

namespace App\Services;

use App\Models\WorkoutProgress;
use App\Repositories\WorkoutProgressRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkoutProgressService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected WorkoutProgressRepository $workoutProgressRepository) {}

    public function create(Request $request)
    {

        // salvo i dati ricevuti dalla request nel db
        $workoutProgress = $this->workoutProgressRepository->save($request);


        return $workoutProgress;
    }

    public function update(Request $request, WorkoutProgress $workoutProgress)
    {
        $workoutProgress = $this->workoutProgressRepository->update($request, $workoutProgress);

        return $workoutProgress;
    }

    public function delete(WorkoutProgress $workoutProgress)
    {
        $res = $this->workoutProgressRepository->delete($workoutProgress);

        return $res;
    }
}
