{{-- resources/views/table/index.blade.php (your current Blade) --}}
@extends('layouts.dashboard')

@section('title', 'User tables')

@section('content')
<div class="w-full p-8 overflow-auto">
    <div class="flex justify-between items-center mb-5">
        <h1 class="text-3xl font-bold text-gray-800">{{ $page_title }} Records</h1>
        @if ($resource === 'account')
        <div x-data="{ showModal: false }">
            <button @click="showModal = true"
                class="px-5 py-2 text-white bg-pink-600 rounded-lg hover:bg-pink-700 border border-pink-700 transition-colors">
                <i class="fa-solid fa-plus"></i> Add {{ $page_title }}
            </button>
            @include('table.create')
        </div>
        @endif
    </div>

    @include('components.alert')

    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-lg rounded-lg w-full p-8">
        <div>
            <table id="{{ $resource }}-table"
                class="w-full min-w-full table-auto text-sm text-left text-gray-700 dark:text-gray-200">
                <thead class="bg-pink-600 text-white uppercase sticky top-0 z-1">
                    <tr>
                        @foreach ($columns as $column)
                        <th class="py-3 px-4 font-semibold">{{ $column }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $record)
                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-pink-50/60">
                        @if ($resource === 'accounts')
                            @include('table.partial.account')
                            @else
                            @include('table.partial.participant')
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
$(function() {
    const dt = $('#{{ $resource }}-table').DataTable({
        processing: true,
        serverSide: false,
        pageLength: 10,
        autoWidth: false,
        responsive: true,
        scrollX: false,
        order: [
            [0, 'desc']
        ],
        dom: '<"flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-3"lf>rt<"flex items-center justify-between mt-4"ip>',
        initComplete: function() {
            const $searchInput = $('div.dataTables_filter input');
            $searchInput.addClass(
                'ml-2 w-72 max-w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-pink-500 focus:ring-opacity-50'
            );

            const $lengthSelect = $('div.dataTables_length select');
            $lengthSelect.addClass(
                'px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-pink-500 focus:ring-opacity-50'
            );
        },
        drawCallback: function() {
            const $paginateButtons = $('div.dataTables_paginate .paginate_button');
            $paginateButtons.addClass(
                'px-4 py-2 text-black rounded-lg hover:bg-pink-100 disabled:opacity-50 disabled:cursor-not-allowed transition-colors'
            );
            const $currentPage = $('div.dataTables_paginate .paginate_button.current');
            $currentPage.removeClass('bg-gray-700 text-white');
            $currentPage.addClass(
                'bg-pink-600 text-white px-4 m-2 py-2 rounded-lg transition-colors hover:bg-pink-700'
            );
        }
    });

    $('.dataTables_wrapper').addClass('w-full');
});
</script>
@endpush