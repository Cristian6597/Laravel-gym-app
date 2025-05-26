<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'birth_date' => $this->birth_date,
            'specialty' => $this->specialty,
            'bio' => $this->bio,
            'certifications' => $this->certifications,
            'years_experience' => $this->years_experience,
            'profile_image' => $this->profile_image
                ? url('storage/' . $this->profile_image)
                : null,  // restituisce URL completo o null
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
