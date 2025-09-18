<td class="py-2 px-4">{{ $record->name }}</td>
<td class="py-2 px-4">{{ $record->email }}</td>
<td class="py-2 px-4">{{ $record->contact_number }}</td>
<td class="py-2 px-4">{{ $record->getRoleNames()->first() ?? '' }}</td>
<td class="py-2 px-4">
    <div class="inline-flex items-center gap-2">
        <div x-data="{ showEditModal: false }" class="inline">
            <button @click="showEditModal = true" class="p-2 rounded bg-blue-50 text-blue-600 hover:bg-blue-100"
                title="Edit">
                <i class="fa-solid fa-pen-to-square"></i>
            </button>
            @include('table.edit')
        </div>
        <div x-data="{ showDeleteModal: false }" class="inline">
            <button @click="showDeleteModal = true" class="p-2 rounded bg-red-50 text-red-600 hover:bg-red-100"
                title="Delete">
                <i class="fa-solid fa-trash"></i>
            </button>
            @include('table.destroy')
        </div>
    </div>
</td>