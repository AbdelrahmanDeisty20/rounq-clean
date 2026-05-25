<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $isUpdate = $this->route('id') !== null;
        
        return [
            'title' => 'nullable|string|max:255',
            'video_file' => $isUpdate ? 'nullable|file|mimes:mp4,webm,ogg,quicktime|max:102400' : 'required|file|mimes:mp4,webm,ogg,quicktime|max:102400',
            'is_active' => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'video_file.required' => 'ملف الفيديو مطلوب',
            'video_file.file' => 'يجب رفع ملف فيديو صحيح',
            'video_file.mimes' => 'يجب أن يكون الفيديو بصيغة مدعومة مثل MP4 أو WebM',
            'video_file.max' => 'أقصى حجم للفيديو هو 100 ميجابايت'
        ];
    }
}
