<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkoutPlanHasExerciseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'workout_plan_id' => 'required|exists:workout_plans,id',
            'name' => 'required|string|max:255',
            'sets' => 'required|integer|min:1',
            'repetitions' => 'required|integer|min:1',
            'load' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ];
    }
}
