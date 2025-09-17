@extends('layouts.auth.register')

@section('content')
<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-10" x-data="{ showVacc: false }">
    <div class="w-full max-w-2xl bg-white rounded-lg shadow-xl dark:border dark:bg-gray-800 dark:border-gray-700">
        <div class="p-8 space-y-8">

            <div class="text-center">
                <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                    Registration Details
                </h1>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Thank you for registering! Below are your submitted details and your event QR code.
                    Kindly check your registered email for the registration confirmation and a copy of your QR code.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <div>
                        <p class="text-xs uppercase text-gray-500">Full Name</p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $participant->full_name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs uppercase text-gray-500">Email</p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $participant->email }}</p>
                    </div>

                    <div>
                        <p class="text-xs uppercase text-gray-500">Contact Number</p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white">
                            {{ $participant->contact_number }}</p>
                    </div>

                    <div>
                        <p class="text-xs uppercase text-gray-500">Pet Name</p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $participant->pet_name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs uppercase text-gray-500">Pet Breed</p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $participant->pet_breed }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs uppercase text-gray-500">Category</p>
                        <p>
                            @switch($participant->category)
                            @case(1)
                            <span
                                class="inline-block px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                1K Run (Small Pets)
                            </span>
                            @break
                            @case(2)
                            <span
                                class="inline-block px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                3K Run (Medium Pets)
                            </span>
                            @break
                            @case(3)
                            <span
                                class="inline-block px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                5K Run (Large Pets)
                            </span>
                            @break
                            @default
                            <span
                                class="inline-block px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">
                                {{ $participant->category }}
                            </span>
                            @endswitch
                        </p>
                    </div>
                </div>

                <div class="space-y-6 text-center">
                    <div>
                        <p class="text-xs uppercase text-gray-500 mb-3">Your QR Code</p>
                        <div
                            class="rounded-xl border border-gray-200 dark:border-gray-700 p-4 bg-gray-50 dark:bg-gray-900 inline-flex">
                            <img src="{{ asset($participant->qr ?? ($qrRel ?? '')) }}" alt="Participant QR"
                                class="max-h-56 w-auto" onerror="this.style.display='none';">
                        </div>
                        <p class="text-xs font-mono text-gray-700 dark:text-gray-300 break-all mt-2">
                            {{ $participant->uuid }}</p>
                    </div>

                    @if($participant->vaccination_card)
                    <p>
                        <a href="javascript:void(0)" @click="showVacc = true"
                            class="text-sm text-blue-600 hover:underline">
                            View Vaccination Card
                        </a>
                    </p>
                    @else
                    <p class="text-sm text-gray-500">No vaccination card on file.</p>
                    @endif
                </div>
            </div>

            <div class="flex items-center justify-center gap-4 pt-4">
                <a href="{{ route('participant.index') }}"
                    class="inline-flex items-center px-5 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white">
                    Back to Registration
                </a>
                @if(!empty($participant->qr ?? ($qrRel ?? '')))
                <a href="{{ asset($participant->qr ?? $qrRel) }}" download
                    class="inline-flex items-center px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium shadow">
                    Download QR
                </a>
                @endif
            </div>

        </div>
    </div>

    <template x-teleport="body">
        <div x-cloak x-show="showVacc" x-transition.opacity @keydown.escape.window="showVacc = false"
            @click.self="showVacc = false"
            class="fixed inset-0 z-[99999] flex items-center justify-center bg-black bg-opacity-90"
            style="background-color: rgba(0,0,0,0.9);" role="dialog" aria-modal="true"
            aria-labelledby="vaccination-title">
            <div x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="bg-white rounded-lg dark:bg-gray-800 rounded-xl shadow-2xl max-w-lg w-full p-6 relative">
                <button @click="showVacc = false"
                    class="absolute top-3 right-3 inline-flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500 hover:text-gray-700 dark:text-gray-300"
                    aria-label="Close vaccination card">✕</button>

                <h2 id="vaccination-title" class="text-lg font-semibold text-gray-900 dark:text-white mb-4 text-center">
                    Pet Vaccination Card
                </h2>

                @php
                $vaccPath = $participant->vaccination_card;
                $ext = $vaccPath ? strtolower(pathinfo($vaccPath, PATHINFO_EXTENSION)) : '';
                $isImage = in_array($ext, ['png','jpg','jpeg','webp','gif']);
                @endphp

                <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-3 bg-gray-50 dark:bg-gray-900">
                    @if($isImage)
                    <img src="{{ asset($vaccPath) }}" alt="Vaccination Card" class="max-h-[500px] w-auto mx-auto">
                    @else
                    <p class="text-sm text-gray-600 dark:text-gray-300 text-center">
                        Uploaded file: <span class="font-medium">{{ basename($vaccPath) }}</span>
                    </p>
                    @endif
                </div>

                <div class="mt-4 text-center">
                    <a href="{{ asset($vaccPath) }}" download
                        class="inline-flex items-center px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white text-sm font-medium shadow">
                        Download Vaccination Card
                    </a>
                </div>
            </div>
        </div>
    </template>
</div>
@endsection