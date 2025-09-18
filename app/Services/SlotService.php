<?php

namespace App\Services;

use App\Models\Slot;

class SlotService
{
    public function storeSlot($data)
    {
        $slot = Slot::updateOrCreate(
            ['id' => 1],
            ['slot' => $data['slot']]
        );

        return $slot;
    }
}