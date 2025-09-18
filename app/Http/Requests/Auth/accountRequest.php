<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class accountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    protected function currentUserId(): ?int
    {
        $uuid = $this->route('uuid');
        

        if (!$uuid) {
            return null;
        }

        $user = User::where('uuid', $uuid)->select('id')->first();
        return $user?->id;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name'            => $this->filled('name') ? trim($this->string('name')) : $this->input('name'),
            'email'           => $this->filled('email') ? strtolower(trim((string)$this->input('email'))) : $this->input('email'),
            'contact_number'  => $this->filled('contact_number') ? trim($this->string('contact_number')) : $this->input('contact_number'),
            'password'        => $this->filled('password') ? (string)$this->input('password') : null,
            'role'            => $this->filled('role') ? (string)$this->input('role') : $this->input('role'),
        ]);
    }

    public function rules(): array
    {
        $isCreate = $this->isMethod('post');
        $ignoreId = $this->currentUserId();

        return [
            'name' => array_filter([$isCreate ? 'required' : 'sometimes', 'string', 'max:255']),
            'email' => array_filter([ $isCreate ? 'required' : 'sometimes', 'email', 'max:255', Rule::unique('users', 'email')->ignore($ignoreId)]),
            'contact_number' => [ $isCreate ? 'nullable' : 'sometimes', 'nullable', 'string', Rule::unique('users', 'contact_number')->ignore($ignoreId)],
            'password' => $isCreate ? ['required', 'string', 'min:8'] : ['sometimes', 'nullable', 'string', 'min:8'],            
            'role' => array_filter([$isCreate ? 'required' : 'sometimes','string', Rule::exists('roles', 'name')->where('guard_name', 'web')]),
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique'   => 'This email is already taken.',
            'role.exists'    => 'The selected role is invalid.',
            'password.min'   => 'Password must be at least 8 characters.',
        ];
    }
}