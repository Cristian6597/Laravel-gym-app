<?php

namespace App\Services;

use App\Models\ClientProfile;
use App\Repositories\ClientProfileRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientProfileService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ClientProfileRepository $clientProfileRepository) {}

    public function create(Request $request)
    {

        // salvo i dati ricevuti dalla request nel db
        $clientProfile = $this->clientProfileRepository->save($request);


        return $clientProfile;
    }

    public function update(Request $request, ClientProfile $clientProfile)
    {
        $clientProfile = $this->clientProfileRepository->update($request, $clientProfile);

        return $clientProfile;
    }

    public function delete(ClientProfile $clientProfile)
    {
        $res = $this->clientProfileRepository->delete($clientProfile);

        return $res;
    }
}
