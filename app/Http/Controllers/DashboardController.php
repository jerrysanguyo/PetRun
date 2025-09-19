<?php

namespace App\Http\Controllers;

use App\DataTables\PawRunDataTable;
use App\Models\Participant;
use App\Models\Slot;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(PawRunDataTable $dataTable)
    {
        $page_title = 'Participants';
        $resource = 'owner';
        $columns = ['name', 'email', 'contact number', 'pet', 'scanned by', 'action'];
        $data = Participant::getAllParticipants();
        $totalParticipants = $data->count();
        $slot = Slot::where('id', 1)->first();
        return $dataTable->render('table.index', compact(
            'dataTable',
            'page_title',
            'resource',
            'columns',
            'data',
            'totalParticipants',
            'slot',
        ));
    }

    public function count()
    {
        $total = Participant::count();
        $scanned = Participant::whereHas('attendance')->count();
        $notScanned = $total - $scanned;

        return response()->json([
            'total' => $total,
            'scanned' => $scanned,
            'not_scanned' => $notScanned,
        ]);
    }
}