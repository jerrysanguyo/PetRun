<?php

namespace App\Services;

use App\Models\Participant;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ParticipantService
{
    public function participantDetails($uuid)
    {
        $participantDetails  = Participant::where('uuid', $uuid)->firstOrFail();

        return $participantDetails;
    }

    public function store(array $data)
    {
        $uuid = (string) Str::uuid();
        $data['uuid'] = $uuid;

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
        
        $qrName = "qr-{$uuid}-{$slugName}.png";
        $qrPath = $basePath.DIRECTORY_SEPARATOR.$qrName;
        $qrText = $uuid;
        $data['qr'] = "{$folder}/{$qrName}";
        QrCode::format('png')->size(512)->margin(1)->generate($qrText, $qrPath);

        return Participant::create($data);
    }

    public function destroy($uuid)
    {
        $participant = $this->participantDetails($uuid);

        $participant->delete();

        return $participant;
    }
}