<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function userDetails($uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        return $user;
    }

    protected function throttleKey(string $email): string
    {
        return Str::lower($email) . '|' . request()->ip();
    }

    protected function hitThrottle(string $key): void
    {
        RateLimiter::hit($key, 60);
    }
    
    public function authenticate(array $data): User
    {
        $email = strtolower(trim($data['email']));
        $password = (string) ($data['password']);
        $remember = (bool) ($data['remember'] ?? false);

        $key = $this->throttleKey($email);

        if(RateLimiter::tooManyAttempts($key, 5))
        {
            $seconds = RateLimiter::availableIn($key);
            throw new AuthenticationException(
                "Too many attempts. Try again in {$seconds} seconds."
            );
        } 

        $credentials = ['email' => $email, 'password' => $password];

        if(Auth::guard('web')->attempt($credentials, $remember))
        {
            $user = Auth::guard('web')->user();

            request()->session()->regenerate();
            RateLimiter::clear($key);

            return $user;
        }

        $this->hitThrottle($key);

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.'
        ]);
    }

    public function logout(): void
    {
        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

    public function accountStore(array $data)
    {
        $user = DB::transaction(function () use ($data) {
            $user = User::create([
                'uuid'  => (string) Str::uuid(),
                'name'  => $data['name'],
                'email' => $data['email'],
                'contact_number'    => $data['contact_number'],
                'password'          => bcrypt($data['password'])
            ]);

            $user->syncRoles($data['role']);

            return $user;
        });

        return $user;
    }

    public function accountUpdate(array $data, $uuid)
    {
        $record = $this->userDetails($uuid);

        $oldValues = $record->only(['name', 'email', 'contact_number', 'password']);

        DB::transaction(function () use ($record, $data) {
            $record->update([
                'uuid'           => (string) Str::uuid(),
                'name'           => $data['name'],
                'email'          => $data['email'],
                'contact_number' => $data['contact_number'],
                'password'       => bcrypt($data['password']),
            ]);

            if (!empty($data['role'])) {
                $currentRole = $record->getRoleNames()->first();
                
                if ($currentRole !== $data['role']) {
                    $record->removeRole($currentRole);
                    $record->assignRole($data['role']);
                }
            }
        });

        $record->oldValues = $oldValues;

        return $record->fresh();
    }

    public function accountDestroy(string $uuid): User
    {
        $record = $this->userDetails($uuid);

        $record->oldValues = $record->only([
            'id', 'uuid', 'name', 'email', 'contact_number',
        ]);

        DB::transaction(function () use ($record) {
            $record->delete();
        });

        return $record;
    }
}