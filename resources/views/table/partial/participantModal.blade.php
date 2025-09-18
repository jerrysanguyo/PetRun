<div x-show="showParticipantModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="fixed inset-0 bg-black opacity-50" @click="showParticipantModal = false"></div>

    <div x-show="showParticipantModal" x-cloak x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="bg-white rounded-xl shadow-lg z-10 p-6 w-full max-w-xl">

        <div class="relative mb-4 border-b pb-2">
            <h2 class="text-xl font-bold text-pink-600 text-center">{{ $record->full_name }}'s QR</h2>
            <button @click="showParticipantModal = false"
                class="absolute top-0 right-0 text-gray-400 hover:text-pink-600 text-2xl leading-none">&times;</button>
        </div>

        <div>
            <div class="flex justify-center py-2">
                <img src="{{ asset($record->qr) }}" alt="QR Code for {{ $record->name }}"
                    class="w-64 h-64 object-contain border border-gray-300 rounded-md shadow">
            </div>
        </div>

    </div>
</div>