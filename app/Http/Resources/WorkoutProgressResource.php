<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutProgressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'client_id' => $this->client_id,
            'exercise_id' => $this->exercise_id,
            'date' => $this->date,
            'sets_completed' => $this->sets_completed,
            'total_repetitions' => $this->total_repetitions,
            'weight_used' => $this->weight_used,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            // Opzionale: includi relazioni se caricate
            'client' => new UserResource($this->whenLoaded('client')),
            'exercise' => new ExerciseResource($this->whenLoaded('exercise')),
        ];
    }
}
