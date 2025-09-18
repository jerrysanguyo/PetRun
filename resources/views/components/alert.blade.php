@if (session('success'))
<div class="rounded-md bg-green-50 dark:bg-green-900/30 p-3 text-sm text-green-700 text-center dark:text-green-200 mb-5">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="rounded-md bg-red-50 dark:bg-red-900/30 p-3 text-sm text-red-700 text-center dark:text-red-200 mb-5">
    {{ $errors->first() }}
</div>
@endif