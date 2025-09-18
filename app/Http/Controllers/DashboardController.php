<?php

namespace App\Http\Controllers;

use App\DataTables\PawRunDataTable;
use App\Models\Participant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(PawRunDataTable $dataTable)
    {
        $page_title = 'Participants';
        $resource = 'owner';
        $columns = ['name', 'email', 'contact number', 'pet', 'kilometer', 'action'];
        $data = Participant::getAllParticipants();
        $totalParticipants = $data->count();
        return $dataTable->render('table.index', compact(
            'dataTable',
            'page_title',
            'resource',
            'columns',
            'data',
            'totalParticipants',
        ));
    }

    public function count()
    {
        $count = Participant::count();
        return response()->json(['count' => $count]);
    }
}