<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'اسم الخدمة مطلوب'
        ];
    }
}
