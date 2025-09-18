<td class="py-2 px-4">{{ $record->full_name }}</td>
<td class="py-2 px-4">{{ $record->email }}</td>
<td class="py-2 px-4">{{ $record->contact_number }}</td>
<td class="py-2 px-4">{{ $record->pet_name . ' - ' . $record->pet_breed }}</td>
<td class="py-2 px-4">{{ $record->category }}KM</td>
<td class="py-2 px-4">
    <div class="inline-flex items-center gap-2">
        <div x-data="{ showParticipantModal: false }" class="inline">
            <button @click="showParticipantModal = true" class="p-2 rounded bg-blue-50 text-blue-600 hover:bg-blue-100"
                title="Edit">
                <i class="fa-solid fa-eye"></i>
            </button>
            @include('table.partial.participantModal')
        </div>
    </div>
</td>