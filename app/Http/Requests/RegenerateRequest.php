<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegenerateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'email' => 'required|email:rfc,dns|exists:participants,email'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Please enter your registered email address.',
            'email.email'    => 'That doesn’t look like a valid email. Try again!',
            'email.exists'   => 'We couldn’t find that email in our records. Are you sure you registered?',
        ];
    }
}
