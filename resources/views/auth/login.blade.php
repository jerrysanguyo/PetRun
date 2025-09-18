@extends('layouts.auth.login')

@section('content')
<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-10">

    <a href="#" class="mb-6">
        <img class="w-32 h-32 rounded-full shadow" src="{{ asset('images/cvo.webp') }}" alt="Admin Logo">
    </a>

    <div class="w-full max-w-sm bg-white rounded-lg shadow-xl dark:bg-gray-800">
        <div class="p-6 space-y-4 sm:p-8">

            <h1 class="text-2xl font-bold text-center text-gray-800 dark:text-white">
                Admin Panel Login
            </h1>
            <p class="text-sm text-center text-gray-500 dark:text-gray-400">
                Access is restricted to authorized administrators only.
            </p>

            @include('components.alert')

            @php
            use Illuminate\Support\Facades\RateLimiter;
            use Illuminate\Support\Str;

            $emailInput = old('email', '');
            $emailIpKey = Str::lower($emailInput).'|'.request()->ip();
            $ipKey = 'ip:'.request()->ip();

            $maxEmailIp = 5;
            $maxIp = 20;

            $blockedEmailIp = RateLimiter::tooManyAttempts($emailIpKey, $maxEmailIp);
            $blockedIp = RateLimiter::tooManyAttempts($ipKey, $maxIp);

            $availableIn = max(
            $blockedEmailIp ? RateLimiter::availableIn($emailIpKey) : 0,
            $blockedIp ? RateLimiter::availableIn($ipKey) : 0
            );

            $attemptsEmailIp = RateLimiter::attempts($emailIpKey);
            $remainingEmailIp = max(0, $maxEmailIp - $attemptsEmailIp);
            @endphp

            @if ($blockedEmailIp || $blockedIp)
            <div
                class="rounded-md bg-yellow-50 dark:bg-yellow-900/30 p-3 text-sm text-yellow-700 text-center dark:text-yellow-200">
                Too many login attempts. Please try again in {{ $availableIn }} seconds.
            </div>
            @elseif ($attemptsEmailIp > 0)
            <div
                class="rounded-md bg-blue-50 dark:bg-blue-900/30 p-3 text-sm text-blue-700 text-center dark:text-blue-200">
                You have used {{ $attemptsEmailIp }} attempt{{ $attemptsEmailIp>1?'s':'' }}.
                You have {{ $remainingEmailIp }} attempt{{ $remainingEmailIp>1?'s':'' }} left before a 60-second
                lockout.
            </div>
            @endif

            <form class="space-y-4" method="POST" action="{{ route('authenticate') }}">
                @csrf

                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Email Address
                    </label>
                    <input type="email" name="email" id="email" required autofocus value="{{ old('email') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="admin@example.com">
                    @error('email')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Password
                    </label>
                    <input type="password" name="password" id="password" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="••••••••">
                    @error('password')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input id="remember" type="checkbox" name="remember" value="1"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                    <label for="remember" class="ml-2 text-sm text-gray-600 dark:text-gray-300">
                        Remember me
                    </label>
                </div>

                <button type="submit"
                    class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-150 ease-in-out">
                    Login
                </button>
            </form>
        </div>
    </div>
</div>
@endsection