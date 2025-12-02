<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        // adjust authorization as required (policies / gates)
        return true;
    }

    public function rules(): array
    {
        $serviceId = $this->route('service')?->id ?? null;

        return [
            'title'       => ['required', 'string', 'max:255'],
            'slug'        => [
                'required',
                'string',
                'max:255',
                Rule::unique('services', 'slug')->ignore($serviceId),
            ],
            'description' => ['required', 'string'],
            'details'     => ['nullable', 'string'],
            'image'       => ['nullable', 'string', 'max:1024'],
            'price'       => ['nullable', 'numeric', 'min:0'],
            'is_active'   => ['sometimes', 'boolean'],
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has('is_active')) {
            $this->merge(['is_active' => filter_var($this->input('is_active'), FILTER_VALIDATE_BOOLEAN)]);
        }
    }
}
