<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'full_name'         => 'required|string|max:255',
            'email'             => 'required|email:rfc,dns|unique:participants,email',
            'contact_number'    => 'required|string|max:11|unique:participants,contact_number',
            'pet_name'          => 'required|string|max:255',
            'pet_breed'         => 'required|string|max:255',
            'category'          => 'required|numeric|in:1,2,3',
            'vaccination_card'  => 'required|mimes:png,webp,jpg|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required'        => 'Please enter your full name.',
            'email.required'            => 'Email address is required.',
            'email.email'               => 'Please enter a valid email address with a real domain.',
            'email.unique'              => 'This email is already registered.',
            'contact_number.required'   => 'Contact number is required.',
            'contact_number.unique'     => 'This contact number is already registered.',
            'pet_name.required'         => 'Please provide your pet\'s name.',
            'pet_breed.required'        => 'Please provide your pet\'s breed.',
            'category.required'         => 'Please select a category.',
            'category.in'               => 'Category must be 1, 2, or 3.',
            'vaccination_card.required' => 'Please upload your pet\'s vaccination record.',
            'vaccination_card.mimes'    => 'Vaccination file must be a PNG, WEBP, or JPG image.',
            'vaccination_card.max'      => 'Vaccination file may not be greater than 2MB.',
        ];
    }
}
