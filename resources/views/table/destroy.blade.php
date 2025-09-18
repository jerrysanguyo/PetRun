<div x-show="showDeleteModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="fixed inset-0 bg-black opacity-50" @click="showDeleteModal = false"></div>
    <div x-show="showDeleteModal" x-cloak x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="bg-white rounded-xl shadow-lg z-10 p-6 w-full max-w-xl">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h2 class="text-xl font-bold text-pink-600">Delete {{ $resource }}</h2>
            <button @click="showDeleteModal = false"
                class="text-gray-600 hover:text-gray-800 text-2xl leading-none">&times;</button>
        </div>
        <div class="mt-5 mb-3 text-gray-700 text-200 text-md">
            <p>Are you sure you want to delete this record?</p>
            <p class="mt-2"><span class="font-semibold">{{ $page_title }}:</span>
                {{ $record->name ?? 'N/A' }}
            </p>
        </div>
        <div class="flex justify-end">
            <button type="button" @click="showDeleteModal = false"
                class="px-4 py-2 mr-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-pink-100 hover:text-pink-600 transition">Cancel</button>
            <form action="{{ route(Auth::user()->getRoleNames()->first() . '.account.destroy', $record->uuid) }}"
                method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="px-4 py-2 text-white bg-pink-600 rounded-lg hover:bg-pink-700 transition">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
</div>