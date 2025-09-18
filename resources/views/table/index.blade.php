@extends('layouts.dashboard')

@section('title', 'User tables')

@section('content')
<div class="w-full px-4 sm:px-6 lg:px-8 py-6 overflow-auto">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-5">
        <h1 class="text-3xl font-bold text-gray-800 text-center sm:text-left">
            {{ $page_title }} Records
        </h1>

        @if ($resource === 'account')
        <div x-data="{ showModal: false }" class="w-full sm:w-auto">
            <button @click="showModal = true"
                class="w-full sm:w-auto px-5 py-2 text-white bg-pink-600 rounded-lg hover:bg-pink-700 border border-pink-700 transition-colors text-center">
                <i class="fa-solid fa-plus"></i> Add {{ $page_title }}
            </button>
            @include('table.create')
        </div>
        @else
        <div x-data="{ showSlotModal: false }" class="w-full sm:w-auto">
            <button @click="showSlotModal = true"
                class="w-full sm:w-auto px-5 py-2 text-white bg-pink-600 rounded-lg hover:bg-pink-700 border border-pink-700 transition-colors text-center">
                <i class="fa-solid fa-plus"></i> Add slot
            </button>
        </div>
        @endif
    </div>

    @include('components.alert')

    @if ($resource === 'owner')
    @include('table.partial.counts')
    @endif

    <div
        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-lg rounded-lg w-full p-4 sm:p-8">
        <div class="overflow-x-auto">
            <table id="{{ $resource }}-table"
                class="min-w-full table-auto text-sm text-left text-gray-700 dark:text-gray-200">
                <thead class="bg-pink-600 text-white uppercase sticky top-0 z-1">
                    <tr>
                        @foreach ($columns as $column)
                        <th class="py-3 px-4 font-semibold whitespace-nowrap">{{ $column }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $record)
                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-pink-50/60">
                        @if ($resource === 'account')
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
        columnDefs: [{
                responsivePriority: 1,
                targets: 0
            }, // First column: always show
            {
                responsivePriority: 2,
                targets: -1
            } // Last column (Action): next priority
        ],
        dom: '<"flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-3"lf>rt<"flex items-center justify-between mt-4"ip>',
        initComplete: function() {
            $('div.dataTables_filter input').addClass(
                'ml-2 w-72 max-w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-pink-500 focus:ring-opacity-50'
            );

            $('div.dataTables_length select').addClass(
                'px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-pink-500 focus:ring-opacity-50'
            );
        },
        drawCallback: function() {
            const $paginateButtons = $('div.dataTables_paginate .paginate_button');
            $paginateButtons.addClass(
                'px-4 py-2 text-black rounded-lg hover:bg-pink-100 disabled:opacity-50 disabled:cursor-not-allowed transition-colors'
            );

            $('div.dataTables_paginate .paginate_button.current')
                .removeClass('bg-gray-700 text-white')
                .addClass(
                    'bg-pink-600 text-white px-4 m-2 py-2 rounded-lg transition-colors hover:bg-pink-700'
                );
        }
    });

    $('.dataTables_wrapper').addClass('w-full');
});
</script>
@endpush