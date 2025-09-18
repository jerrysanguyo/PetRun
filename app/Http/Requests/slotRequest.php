<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class slotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'slot' => 'required|numeric'
        ];
    }
}
