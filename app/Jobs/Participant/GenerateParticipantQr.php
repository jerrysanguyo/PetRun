<?php

namespace App\Jobs\Participant;

use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerateParticipantQr implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $participantId,
        public string $absoluteQrPath,
        public string $qrText
    ) {}

    public function handle(): void
    {
        Participant::findOrFail($this->participantId);

        $dir = dirname($this->absoluteQrPath);
        if (! is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        QrCode::format('png')
            ->size(512)
            ->margin(1)
            ->generate($this->qrText, $this->absoluteQrPath);
    }
}
