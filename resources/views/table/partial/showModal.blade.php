<div x-show="showSlotModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="fixed inset-0 bg-black opacity-50" @click="showSlotModal = false"></div>
    <div x-show="showSlotModal" x-cloak x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="bg-white rounded-xl shadow-lg z-10 p-6 w-full max-w-xl">

        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h2 class="text-xl font-bold text-pink-600">Edit Slot Limit</h2>
            <button @click="showSlotModal = false"
                class="text-gray-400 hover:text-pink-600 text-2xl leading-none">&times;</button>
        </div>
        <form method="POST" action="{{ route(Auth::user()->getRoleNames()->first() . '.slot.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm text-gray-600 mb-1">Max Slots</label>
                <input type="number" name="slot" min="1" required value="{{ old('slot', $slot->slot ?? '') }}"
                    class="w-full px-3 py-2 border rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
            </div>
            <div class="flex justify-end pt-2">
                <button type="button" @click="showSlotModal = false"
                    class="px-4 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-100 mr-2">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>