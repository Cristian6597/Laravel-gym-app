<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NotificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'sent_at' => 'nullable|date',
            'read' => 'nullable|boolean',
            'type' => ['required', Rule::in(['reminder', 'update', 'goal'])],
        ];
    }
}
