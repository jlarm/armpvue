<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealershipRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['required', 'uuid'],
            'name' => ['required', 'string', 'min:3', 'max:255', 'unique:dealerships,name'],
            'address' => ['nullable', 'string', 'min:3', 'max:255'],
            'city' => ['nullable', 'string', 'min:3', 'max:255'],
            'state' => ['nullable', 'string', 'min:3', 'max:255'],
            'phone' => ['nullable', 'tel'],
            'created_by' => ['required', 'exists:users'],
            'is_active' => ['boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
