<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use App\Services\AttendanceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    protected $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function index()
    {
        return view('attendance.index');
    }

    public function scanQr(AttendanceRequest $request)
    {
        $attendance = $this->attendanceService->timeIn($request->validated());

        activity()
            ->performedOn($attendance)
            ->causedBy(Auth::user())
            ->log('User ' . Auth::user()->name . ' Scanned QR for participant ID: ' . $attendance->participant->full_name);

        return redirect()
            ->route('participant.show', $attendance->participant->uuid)
            ->with('success', 'QR code successfully scanned!');
    }
}
