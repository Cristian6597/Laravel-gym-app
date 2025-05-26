<?php

namespace App\Services;

use App\Models\Trainer;
use App\Repositories\TrainerRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainerService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected TrainerRepository $trainerRepository) {}

    public function create(Request $request)
    {

        // salvo i dati ricevuti dalla request nel db
        $trainer = $this->trainerRepository->save($request);


        return $trainer;
    }

    public function update(Request $request, Trainer $trainer)
    {
        $trainer = $this->trainerRepository->update($request, $trainer);

        return $trainer;
    }

    public function delete(Trainer $trainer)
    {
        $res = $this->trainerRepository->delete($trainer);

        return $res;
    }
}
