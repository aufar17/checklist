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
        $hydrants = Hydrant::all();

        if (!$session) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        foreach ($hydrants as $hydrant) {
            $statusHistory = $hydrant->status ?? [];
            $hydrant->latest_status = !empty($statusHistory) ? end($statusHistory)['status'] : 0;
        }

        $data = [
            'user' => $user,
            'session' => $session,
            'hydrants' => $hydrants,
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

    public function editHydrant($id)
    {
        $session = Auth::check();
        $user = Auth::user();
        $hydrants = Hydrant::all();
        $hydrant = Hydrant::where('id', $id)->first();

        if (!$session) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }
        foreach ($hydrants as $hydrant) {
            $statusHistory = $hydrant->status ?? []; // Langsung gunakan tanpa json_decode
            $hydrant->latest_status = !empty($statusHistory) ? end($statusHistory)['status'] : 0;
        }

        $data = [
            'user' => $user,
            'session' => $session,
            'hydrants' => $hydrants,
            'hydrant' => $hydrant,
        ];

        return view('hydrant.edit-hydrant', $data);
    }

    public function hydrantUpdate(Request $request)
    {
        if (!$request->id) {
            return redirect()->route('hydrant')->with('error', 'ID Hydrant tidak ditemukan!');
        }

        $hydrantService = new HydrantService();

        $update = $hydrantService->hydrantUpdate($request->id, $request->all());

        if ($update) {
            return redirect()->route('hydrant')->with('success', 'Hydrant berhasil diperbarui!');
        } else {
            return redirect()->route('hydrant')->with('error', 'Hydrant gagal diperbarui!');
        }
    }


    public function hydrantDelete()
    {
        if (!Auth::check()) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $id = request()->post('id');
        $hydrant = Hydrant::find($id);

        if (!$hydrant) {
            return back()->withErrors(['error' => 'Hydrant tidak ditemukan.']);
        }

        $hydrant->delete();

        return redirect()->route('hydrant')->with('success', 'Hydrant berhasil dihapus');
    }
}
