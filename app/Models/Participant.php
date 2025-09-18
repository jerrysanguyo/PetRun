<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table='participants';
    protected $fillable=[
        'uuid',
        'full_name',
        'email',
        'contact_number',
        'pet_name',
        'pet_breed',
        'category',
        'vaccination_card',
        'qr'
    ];

    public static function getAllParticipants()
    {
        return self::select('id', 'uuid', 'full_name', 'email', 'contact_number', 'pet_name', 'pet_breed', 'category', 'qr')->get();
    }

    public function attendance()
    {
        return $this->hasOne(Attendance::class, 'participant_id');
    }
}
