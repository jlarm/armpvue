<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'dealership_id' => ['required', 'exists:dealerships'],
            'name' => ['required'],
            'address' => ['nullable'],
            'city' => ['nullable'],
            'state' => ['nullable'],
            'phone' => ['nullable'],
            'is_main_store' => ['boolean'],
            'is_active' => ['boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
