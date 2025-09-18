<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'uuid' => 'required|string|exists:participants,uuid',
        ];
    }

    public function messages(): array
    {
        return [
            'uuid.required' => 'QR code is required.',
            'uuid.string' => 'QR code must be a valid string.',
            'uuid.exists' => 'The scanned QR code does not match any registered participant.',
        ];
    }
}
