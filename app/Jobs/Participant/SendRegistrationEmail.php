<?php

namespace App\Jobs\Participant;

use App\Mail\Participant\RegistrationConfirmedMail;
use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRegistrationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $participantId) {}

    public function handle(): void
    {
        $participant = Participant::find($this->participantId);
        if (! $participant || blank($participant->email)) return;

        // $qrUrl = $participant->qr ? asset($participant->qr) : null;
        $qrUrl = public_path($participant->qr);
        Mail::to($participant->email)
            ->send(new RegistrationConfirmedMail($participant, $qrUrl));
    }
}
