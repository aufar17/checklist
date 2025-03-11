<?php

namespace App\Http\Controllers;

use App\Models\Hydrant;
use App\Models\InspectionHydrant;
use App\Services\HydrantService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HydrantController extends Controller
{
    public function newHydrant()
    {

        $session = Auth::check();
        $user = Auth::user();

        if (!$session) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $data = [
            'user' => $user,
            'session' => $session,
        ];

        return view('hydrant.new-hydrant', $data);
    }

    public function hydrantPost(Request $request)
    {

        $hydrant = new HydrantService();
        $create = $hydrant->hydrantPost($request->all());

        return $create
            ? redirect()->route('hydrant')->with('success', 'Hydrant berhasil ditambahkan!')
            : redirect()->route('hydrant')->with('error', 'Hydrant gagal ditambahkan!');
    }

    public function detailHydrant($id)
    {
        $session = Auth::check();
        $user = Auth::user();

        $hydrant = Hydrant::with(['inspectionHydrants' => function ($query) {
            $query->orderBy('inspection_date', 'asc');
        }])->where('id', $id)->first();

        if (!$hydrant) {
            return back()->withErrors(['error' => 'Data hydrant tidak ditemukan.']);
        }

        $statusHistory = $hydrant->status ?? [];
        $hydrant->latest_status = !empty($statusHistory) ? end($statusHistory)['status'] : 0;

        $inspections = $hydrant->inspectionHydrants->groupBy(function ($inspection) {
            return Carbon::parse($inspection->inspection_date)->format('m');
        });

        $allMonths = collect(range(1, 12))->mapWithKeys(function ($month) use ($inspections) {
            return [$month => $inspections->get(str_pad($month, 2, '0', STR_PAD_LEFT)) ?? collect()];
        });

        $inspectionsById = $hydrant->inspectionHydrants->groupBy('inspection_id');

        $data = [
            'user' => $user,
            'session' => $session,
            'hydrant' => $hydrant,
            'allMonths' => $allMonths,
            'inspectionsById' => $inspectionsById,
        ];

        return view('hydrant.hydrant-details', $data);
    }
}
