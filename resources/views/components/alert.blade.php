{{-- Success flash (optional) --}}
@if (session('success'))
<div class="rounded-md bg-green-50 dark:bg-green-900/30 p-3 text-sm text-green-700 text-center dark:text-green-200">
    {{ session('success') }}
</div>
@endif