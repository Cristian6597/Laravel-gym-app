<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected UserRepository $userRepository) {}

    public function create(Request $request)
    {

        // salvo i dati ricevuti dalla request nel db
        $user = $this->userRepository->save($request);


        return $user;
    }

    public function update(Request $request, User $user)
    {
        $user = $this->userRepository->update($request, $user);

        return $user;
    }

    public function delete(User $user)
    {
        $res = $this->userRepository->delete($user);

        return $res;
    }
}
