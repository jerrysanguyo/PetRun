<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>City of Taguig - Paw run</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.5/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="icon" href="{{ asset('images/cvo.webp') }}" type="image/png">
</head>

<body x-data="{ pageLoading: true }"
    x-init="window.addEventListener('beforeunload', () => pageLoading = true); pageLoading = false;"
    class="bg-gray-50 dark:bg-gray-800">
    @include('layouts.partial.navbar')

    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        @include('layouts.partial.sidebar')
        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main>
                <div class="px-4 pt-6">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <script src="{{ asset('flowbite-admin/sidebar.js') }}"></script>
    <script src="{{ asset('flowbite-admin/dark-mode.js') }}"></script>
    @stack('scripts')

    <div x-cloak x-show="pageLoading" x-transition.opacity
        class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-black/90 text-center">
        <img src="{{ asset('images/dog.gif') }}" alt="Loading…" class="w-48 h-48 object-contain mb-6"
            onerror="this.style.display='none';">
        <p class="text-lg font-semibold text-white">Loading… please wait 🐶💨</p>
    </div>
</body>

</html>