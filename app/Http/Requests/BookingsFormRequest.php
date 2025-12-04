<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookingsFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            // Foreign keys
            'service_id' => ['required', 'exists:services,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            // Client info
            'client_name' => ['required', 'string', 'max:255'],
            'client_phone' => ['required', 'string', 'max:20'],
            'client_email' => ['nullable', 'email', 'max:255'],
            // Booking details
            'animal_type' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'preferred_date' => ['required', 'date'],
            'preferred_time' => ['nullable', 'date_format:H:i'],
            'issue_description' => ['required', 'string'],
            // Status enum
            'status' => [
                'nullable',
                Rule::in(['pending', 'confirmed', 'completed', 'cancelled']),
            ],
            // Admin
            'admin_notes' => ['nullable', 'string'],
        ];
    }
}
