@extends('layouts.auth.register')

@section('content')
<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-10" x-data="{ isSubmitting: false }">
    <div class="w-full max-w-lg bg-white rounded-lg shadow-xl dark:border dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 sm:p-8">
            @include('components.alert')
            <h1
                class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center">
                Register to join the 2025 paw run!
            </h1>
            <p class="text-sm text-center text-gray-500 dark:text-gray-400">
                Sign up your pet and get ready for a fun-filled day of running, barking, and bonding!
            </p>
            
            <form class="space-y-4" method="POST" action="{{ route('participant.store') }}"
                enctype="multipart/form-data" x-on:submit="isSubmitting = true">
                @csrf
                
                <div>
                    <label for="full_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
                        Name</label>
                    <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}"
                        class="bg-gray-50 border @error('full_name') border-red-500 @else border-gray-300 @enderror text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Juan Dela Cruz">
                    @error('full_name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="bg-gray-50 border @error('email') border-red-500 @else border-gray-300 @enderror text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="your@email.com">
                    @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="contact_number"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number</label>
                    <input type="text" name="contact_number" id="contact_number" value="{{ old('contact_number') }}"
                        class="bg-gray-50 border @error('contact_number') border-red-500 @else border-gray-300 @enderror text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="09XXXXXXXXX">
                    @error('contact_number') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="pet_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pet
                        Name</label>
                    <input type="text" name="pet_name" id="pet_name" value="{{ old('pet_name') }}"
                        class="bg-gray-50 border @error('pet_name') border-red-500 @else border-gray-300 @enderror text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Furry">
                    @error('pet_name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="pet_breed" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pet
                        Breed</label>
                    <input type="text" name="pet_breed" id="pet_breed" value="{{ old('pet_breed') }}"
                        class="bg-gray-50 border @error('pet_breed') border-red-500 @else border-gray-300 @enderror text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Golden Retriever, Aspin, etc.">
                    @error('pet_breed') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="category"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                    <select name="category" id="category"
                        class="bg-gray-50 border @error('category') border-red-500 @else border-gray-300 @enderror text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="">-- Select Category --</option>
                        <option value="1" @selected(old('category')=='1' )>1K Run (Small Pets)</option>
                        <option value="2" @selected(old('category')=='2' )>3K Run (Medium Pets)</option>
                        <option value="3" @selected(old('category')=='3' )>5K Run (Large Pets)</option>
                    </select>
                    @error('category') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="vaccination_card"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pet Vaccination
                        Card</label>
                    <input type="file" name="vaccination_card" id="vaccination_card"
                        accept=".jpg,.jpeg,.png,.webp,image/*"
                        class="block w-full text-sm text-gray-900 border @error('vaccination_card') border-red-500 @else border-gray-300 @enderror rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Accepted: JPG, PNG, WEBP (max 2MB)</p>
                    @error('vaccination_card') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <button type="submit" :disabled="isSubmitting"
                    class="w-full text-white bg-blue-600 hover:bg-blue-700 disabled:opacity-70 disabled:cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <span x-show="!isSubmitting">Register Now</span>
                    <span x-show="isSubmitting">Submitting…</span>
                </button>

                <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
                    Already registered but missed your QR code?
                    <a href="{{ route('generate.index') }}" class="font-medium text-blue-600 hover:underline">Re-generate QR Code</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection