<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string',
            'service' => 'required|string',
            'date' => 'nullable|date',
            'notes' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'phone.required' => 'رقم الجوال مطلوب',
            'city.required' => 'يرجى اختيار المدينة',
            'service.required' => 'يرجى اختيار الخدمة',
            'date.required' => 'يرجى اختيار التاريخ',
            'notes.required' => 'يرجى إضافة ملاحظات أو تفاصيل',
        ];
    }
}
