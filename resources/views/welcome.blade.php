@extends('layouts.welcome')

@section('title', 'City of Taguig Color Fun Run')

@section('content')
@include('components.alert')

<div class="max-w-7xl mx-auto mb-10">
    <div class="bg-white shadow-lg rounded-xl p-6 sm:p-8 border-l-4 border-blue-600 relative">
        <div class="text-center">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800 mb-2 uppercase">
                🎨 Paw Run 2025 – City of Taguig Office of the City Veterinarian
            </h1>
            <p class="text-sm sm:text-base font-semibold text-yellow-600 mb-1">
                🌟 Run Fur Love: Be Healthy with Your Pet! 🌟
            </p>
            <p class="text-gray-700 text-sm sm:text-base mb-4">
                Let’s come together to promote physical and mental wellness for everyone—humans and pets alike!
                This celebration is all about creating awareness, embracing diversity, and inspiring communities
                to be more inclusive, empowering, and compassionate.
            </p>
        </div>
        <div class="flex justify-center px-4">
            <div class="max-w-lg bg-gray-50 rounded-md p-4 mb-5 border border-gray-200 lg:text-left text-center w-full">
                <p class="font-semibold text-blue-700 mb-1">📍 Location:</p>
                <p class="text-gray-800 text-sm">
                    <a href="https://www.google.com/maps/search/?api=1&query=TLC+Park,+Laguna+Lake+Highway,+Lower+Bicutan,+Taguig"
                        target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">
                        TLC Park Concert ground, Laguna Lake Highway/C6 Road, Brgy. Lower Bicutan, Taguig
                    </a>
                </p>
                <p class="font-semibold text-blue-700 mt-3 mb-1">📅 Date:</p>
                <p class="text-gray-800 text-sm">September 27, 2025 (Sunday)</p>
                <p class="font-semibold text-blue-700 mt-3 mb-1">⏰ Time:</p>
                <p class="text-gray-800 text-sm">5:00 AM</p>
                <div class="mt-5 text-sm text-gray-700 bg-yellow-50 border border-yellow-200 rounded-md p-3">
                    <p>
                        Kindly note that all participants must present their unique QR code at the entrance to gain
                        access to the event area.
                        To obtain your QR code, please complete your registration using the button below. Thank you for
                        your cooperation.
                    </p>
                </div>
                <div class="mt-5 text-center">
                    <a href="{{ route('participant.index') }}"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-2 rounded-md shadow transition duration-300">
                        Register for this Event
                    </a>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <h3 class="font-bold text-green-700 mb-2">✅ REQUIREMENTS:</h3>
            <ul class="list-disc list-inside text-gray-700 text-sm space-y-1">
                <li>
                    🩺 <span class="font-semibold">Owners and pets should be in good health</span> before joining the
                    run.
                </li>
                <li>
                    💉 <span class="font-semibold">Pets must be vaccinated against rabies</span> for everyone’s safety.
                </li>
                <li>
                    🐕 <span class="font-semibold">Aggressive dogs should wear a muzzle</span> to ensure a fun and safe
                    event.
                </li>
                <li>
                    🧴 <span class="font-semibold">Pets must wear diapers</span>, and owners should bring waste bags to
                    <span class="italic">“scoop the poop”</span>. Let’s keep the venue clean!
                </li>
                <li>
                    💧 <span class="font-semibold">Bring your own water bottle</span>. Water stations will also be
                    available at the event area.
                </li>
            </ul>
        </div>
        <p class="mt-6 text-center text-pink-600 font-semibold text-sm sm:text-base">
            🎉 Let’s celebrate together with our pets and run fur love! 🎉
        </p>
    </div>
</div>
@endsection