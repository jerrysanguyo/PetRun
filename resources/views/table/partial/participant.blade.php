<td class="py-2 px-4">{{ $record->full_name }}</td>
<td class="py-2 px-4">{{ $record->email }}</td>
<td class="py-2 px-4">{{ $record->contact_number }}</td>
<td class="py-2 px-4">{{ $record->pet_name . ' - ' . $record->pet_breed }}</td>
<td class="py-2 px-4">
    {!! $record->attendance
    ? '<span
        class="inline-flex items-center px-2 py-1 text-sm font-medium text-green-800 bg-green-100 rounded dark:bg-green-900 dark:text-green-300">'
        . e($record->attendance->scanned->name) . '</span>'
    : '<span
        class="inline-flex items-center px-2 py-1 text-sm font-medium text-gray-800 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-300">Not
        Scanned</span>' !!}
</td>
<td class="py-2 px-4">
    <div class="inline-flex items-center gap-2">
        <div x-data="{ showParticipantModal: false, qrSrc: null, vacSrc: null }" class="inline">
            <button
                @click="showParticipantModal = true; qrSrc = '{{ asset($record->qr) }}'; vacSrc = '{{ asset($record->vaccination_card) }}'"
                class="p-2 rounded bg-blue-50 text-blue-600 hover:bg-blue-100"
                title="View QR Code">
                <i class="fa-solid fa-eye"></i>
            </button>

            @include('table.partial.participantModal')
        </div>
    </div>
</td>