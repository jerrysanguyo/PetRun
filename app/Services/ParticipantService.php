<?php

namespace App\Services;

use App\Jobs\Participant\GenerateParticipantQr;
use App\Jobs\Participant\SendRegistrationEmail;
use App\Models\Participant;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ParticipantService
{
    public function participantDetails($uuid)
    {
        $participantDetails  = Participant::where('uuid', $uuid)->firstOrFail();

        return $participantDetails;
    }

    public function store(array $data)
    {
        $uuid     = (string) Str::uuid();
        $slugName = Str::slug($data['full_name'] ?? 'participant');
        $folder   = "{$uuid}-{$slugName}";
        $basePath = public_path($folder);

        if (! File::exists($basePath)) {
            File::makeDirectory($basePath, 0755, true);
        }

        $vaccination = $data['vaccination_card'] ?? null;
        if ($vaccination instanceof UploadedFile && $vaccination->isValid()) {
            $ext      = $vaccination->getClientOriginalExtension();
            $vaccName = "vaccination-{$uuid}-{$slugName}.{$ext}";
            $vaccination->move($basePath, $vaccName);
            $data['vaccination_card'] = "{$folder}/{$vaccName}";
        }

        $qrName       = "qr-{$uuid}-{$slugName}.png";
        $relativeQr   = "{$folder}/{$qrName}";
        $absoluteQr   = $basePath . DIRECTORY_SEPARATOR . $qrName;
        $qrText       = $uuid;

        $data['uuid'] = $uuid;
        $data['qr']   = $relativeQr;

        $participant = DB::transaction(function () use($data) {
            return Participant::create($data);
        });

        DB::afterCommit(function() use ($participant, $absoluteQr, $qrText) {
            BUS::chain([
                new GenerateParticipantQr(
                    participantId:  $participant->id,
                    absoluteQrPath: $absoluteQr,
                    qrText:         $qrText
                ),
                new SendRegistrationEmail($participant->id)
            ])->dispatch();
        });

        return $participant;
    }

    public function destroy($uuid)
    {
        $participant = $this->participantDetails($uuid);

        $participant->delete();

        return $participant;
    }
}