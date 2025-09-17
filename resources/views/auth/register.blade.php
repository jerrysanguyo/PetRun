@extends('layouts.auth.register')

@section('content')
<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-10">

    <div class="w-full max-w-lg bg-white rounded-lg shadow-xl dark:border dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 sm:p-8">
            <h1
                class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center">
                Register to join the 2025 paw run!
            </h1>
            <p class="text-sm text-center text-gray-500 dark:text-gray-400">
                Sign up your pet and get ready for a fun-filled day of running, barking, and bonding!
            </p>

            <form class="space-y-4" method="POST" action="#" enctype="multipart/form-data">
                @csrf

                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
                        Name</label>
                    <input type="text" name="name" id="name" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Juan Dela Cruz">
                </div>

                <div>
                    <label for="email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" name="email" id="email" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="your@email.com">
                </div>

                <div>
                    <label for="contact" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                        Number</label>
                    <input type="text" name="contact" id="contact" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="09XXXXXXXXX">
                </div>

                <div>
                    <label for="pet_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pet
                        Name</label>
                    <input type="text" name="pet_name" id="pet_name" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Furry">
                </div>

                <div>
                    <label for="breed" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pet
                        Breed</label>
                    <input type="text" name="breed" id="breed" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Golden Retriever, Aspin, etc.">
                </div>

                <div>
                    <label for="category"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                    <select name="category" id="category" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="">-- Select Category --</option>
                        <option value="1k">1K Run (Small Pets)</option>
                        <option value="3k">3K Run (Medium Pets)</option>
                        <option value="5k">5K Run (Large Pets)</option>
                    </select>
                </div>

                <div>
                    <label for="attachment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pet
                        Vaccination Card</label>
                    <input type="file" name="attachment" id="attachment" accept="image/*,.pdf"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Accepted: JPG, PNG, WEBP</p>
                </div>

                <button type="submit"
                    class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Register Now
                </button>

                <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
                    Already registered but missed your QR code? <a href="#"
                        class="font-medium text-blue-600 hover:underline">
                        Re-generate QR Code
                    </a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection