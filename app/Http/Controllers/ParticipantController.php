<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticipantRequest;
use App\Services\ParticipantService;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{
    protected $participantService;

    public function __construct(ParticipantService $participantService)
    {
        $this->participantService = $participantService;
    }

    public function registration()
    {
        return view('participant.create');
    }

    public function store(ParticipantRequest $request)
    {
        $participant = $this->participantService->store($request->validated());

        activity()
            ->performedOn($participant)
            ->causedByAnonymous()
            ->log('Participant '.$participant->full_name.' successfully registered!');

        return redirect()
            ->route('participant.show', $participant->uuid)
            ->with('success', 'You are successfully registered, '.$participant->full_name.'!');
    }

    public function showQr($uuid)
    {
        $participant = $this->participantService->participantDetails($uuid);
        return view('participant.show', compact(
            'uuid',
            'participant',
        ));
    }
    
    public function destroy($uuid)
    {
        $participant = $this->participantService->participantDetails($uuid);
        $name = $participant->full_name;

        $record = $this->participantService->destroy($uuid);

        activity()
            ->performedOn($participant)
            ->causedBy(Auth::user())
            ->log('User ' . Auth::user()->name . ' deleted participant\'s '.  $name . ' record.');

        return redirect()
            ->route('participant.show', $participant->uuid)
            ->with('success', 'You have successfully deleted participant\'s ' . $name . ' record.');
    }
}
