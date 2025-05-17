<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkoutProgressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'client_id' => 'required|exists:users,id',
            'exercise_id' => 'required|exists:exercises,id',
            'date' => 'required|date',
            'sets_completed' => 'required|integer|min:0',
            'total_repetitions' => 'required|integer|min:0',
            'weight_used' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ];
    }
}
