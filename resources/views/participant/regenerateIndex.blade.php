@extends('layouts.auth.login')

@section('content')
<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-10">

    <a href="#" class="mb-6">
        <img class="w-32 h-32 rounded-full shadow" src="{{ asset('images/cvo.webp') }}" alt="Admin Logo">
    </a>

    <div class="w-full max-w-sm bg-white rounded-lg shadow-xl dark:bg-gray-800">
        <div class="p-6 space-y-4 sm:p-8">

            <h1 class="text-2xl font-bold text-center text-gray-800 dark:text-white">
                Regenerate Your QR Code 🐾
            </h1>
            <p class="text-sm text-center text-gray-500 dark:text-gray-400">
                Already registered? Just type in your email and we’ll send you a fresh copy of your paw-some QR code!
            </p>
            
            <form class="space-y-4" method="POST" action="{{ route('generate.qr') }}">
                @csrf

                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Email Address
                    </label>
                    <input type="email" name="email" id="email" required autofocus value="{{ old('email') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="you@example.com">
                    @error('email')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full text-white bg-pink-600 hover:bg-pink-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-150 ease-in-out">
                    Fetch My QR 📨
                </button>
            </form>
        </div>
    </div>
</div>
@endsection