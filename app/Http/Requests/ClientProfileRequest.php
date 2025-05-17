<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Puoi aggiungere la logica di autorizzazione se necessario
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'trainer_id' => 'required|exists:users,id',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:M,F,Other',
            'height_cm' => 'nullable|integer',
            'weight_kg' => 'nullable|numeric',
            'fitness_goals' => 'nullable|string',
            'training_preferences' => 'nullable|string',
        ];
    }
}
