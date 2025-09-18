@extends('layouts.dashboard')

@section('content')
<div class="flex flex-col items-center justify-center min-h-150 px-4 py-1">
@include('components.alert')
    <div class="w-full max-w-xl bg-white dark:bg-gray-800 rounded-lg shadow-xl p-8 space-y-6">
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Scan a Paw-some QR Code 🐾
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                Scan a pet participant's QR code or enter it manually below.
            </p>
        </div>

        <form method="POST" action="{{ route(Auth::user()->getRoleNames()->first() . '.attendance.store') }}" class="space-y-4">
            @csrf

            <div>
                <label for="uuid" class="block mb-1 text-sm font-medium text-gray-700 dark:text-white">
                    QR Code
                </label>
                <input type="text" name="uuid" id="uuid" required autofocus
                    class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-900 text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-pink-500">
            </div>

            <button type="submit"
                class="w-full text-white bg-pink-600 hover:bg-pink-700 font-medium rounded-md text-sm px-5 py-2.5 transition ease-in-out duration-150">
                Fetch Pet Info 🔍
            </button>
        </form>
    </div>
</div>
@endsection