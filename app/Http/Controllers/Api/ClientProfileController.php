<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientProfileRequest;
use App\Models\ClientProfile;
use App\Services\ClientProfileService;
use Illuminate\Http\Request;
use App\Http\Resources\ClientProfileResource;

class ClientProfileController extends Controller
{

    public function __construct(protected ClientProfileService $clientProfileService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ClientProfile::query();


        return ClientProfileResource::collection($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientProfileRequest $request)
    {
        $clientProfile = $this->clientProfileService->create($request);
        return new ClientProfileResource($clientProfile);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $clientProfile = ClientProfile::findOrFail($id);
        return new ClientProfileResource($clientProfile);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientProfileRequest $request, ClientProfile $clientProfile)
    {
        $clientProfile = $this->clientProfileService->update($request, $clientProfile);
        return new ClientProfileResource($clientProfile);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientProfile $clientProfile)
    {
        $this->clientProfileService->delete($clientProfile);
        return response()->json([
            'message' => 'Client profile deleted successfully'
        ]);
    }
}
