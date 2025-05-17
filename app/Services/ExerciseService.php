<?php

namespace App\Services;

use App\Models\Exercise;
use App\Repositories\ExerciseRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExerciseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ExerciseRepository $exerciseRepository) {}

    public function create(Request $request)
    {

        // salvo i dati ricevuti dalla request nel db
        $exercise = $this->exerciseRepository->save($request);


        return $exercise;
    }

    public function update(Request $request, Exercise $exercise)
    {
        $exercise = $this->exerciseRepository->update($request, $exercise);

        return $exercise;
    }

    public function delete(Exercise $exercise)
    {
        $res = $this->exerciseRepository->delete($exercise);

        return $res;
    }
}
