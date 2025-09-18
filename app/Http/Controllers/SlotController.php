<?php

namespace App\Http\Controllers;

use App\Http\Requests\SlotRequest;
use App\Models\Slot;
use App\Services\SlotService;
use Illuminate\Support\Facades\Auth;

class SlotController extends Controller
{
    protected $slotService;

    public function __construct(SlotService $slotService)
    {
        $this->slotService = $slotService;
    }
    public function store(SlotRequest $request)
    {
        $this->slotService->storeSlot($request->validated());

        return redirect()
            ->route(Auth::user()->getRoleNames()->first() . '.dashboard.index')
            ->with('success', 'You have successfully saved the maximum slot!');
    }
}