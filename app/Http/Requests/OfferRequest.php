<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'features' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'عنوان العرض مطلوب',
            'price.required' => 'السعر مطلوب'
        ];
    }
}
