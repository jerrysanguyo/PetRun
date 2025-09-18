<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Participant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AttendanceService
{
    public function timeIn($data)
    {
        $participant = Participant::where('uuid', $data['uuid'])->firstOrFail();
        
        $alreadyScanned = Attendance::where('participant_id', $participant->id)->exists();

        if ($alreadyScanned) {
            throw ValidationException::withMessages([
                'uuid' => 'This QR code has already been scanned.',
            ]);
        }

        return Attendance::create([
            'participant_id' => $participant->id,
            'scanned_by'     => Auth::id(),
        ]);
    }
}