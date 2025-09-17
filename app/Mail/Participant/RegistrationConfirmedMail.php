<?php

namespace App\Mail\Participant;

use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationConfirmedMail extends Mailable
{
    public function __construct(
        public Participant $participant,
        public ?string $qrPath
    ) {}

    public function build()
    {
        return $this->subject('🐾 Registration Confirmed – Paw Run 2025')
            ->view('emails.registration_confirmed')
            ->with([
                'participant' => $this->participant,
                'qrPath'      => $this->qrPath, 
            ]);
    }
}
