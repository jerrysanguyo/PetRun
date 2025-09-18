@if (session('success'))
<div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
    class="relative rounded-md bg-green-50 dark:bg-green-900/30 p-3 text-sm text-green-700 text-center dark:text-green-200 mb-5">
    {{ session('success') }}
    <button @click="show = false"
        class="absolute top-2 right-3 text-green-700 dark:text-green-200 hover:text-green-900 dark:hover:text-white text-lg leading-none"
        aria-label="Close">
        &times;
    </button>
</div>
@endif

@if ($errors->any())
<div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
    class="relative rounded-md bg-red-50 dark:bg-red-900/30 p-3 text-sm text-red-700 text-center dark:text-red-200 mb-5">
    {{ $errors->first() }}
    <button @click="show = false"
        class="absolute top-2 right-3 text-red-700 dark:text-red-200 hover:text-red-900 dark:hover:text-white text-lg leading-none"
        aria-label="Close">
        &times;
    </button>
</div>
@endif