<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainerRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'specialty' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'certifications' => 'nullable|string|max:255',
            'years_experience' => 'nullable|integer|min:0',
            'profile_image' => 'nullable|image|max:2048', // massimo 2MB
        ];
    }
}
