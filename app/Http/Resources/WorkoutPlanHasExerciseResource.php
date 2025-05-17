<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutPlanHasExerciseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'workout_plan_id' => $this->workout_plan_id,
            'exercise_id' => $this->exercise_id,
            'sets' => $this->sets,
            'repetitions' => $this->repetitions,
            'load' => $this->load,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
