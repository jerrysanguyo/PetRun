<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';
    protected $fillable = [
        'participant_id',
        'scanned_by',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id');
    }

    public function scanned()
    {
        return $this->belongsTo(User::class, 'scanned_by');
    }
}

