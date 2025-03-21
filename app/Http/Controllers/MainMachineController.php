<?php

namespace App\Http\Controllers;

use App\Models\Machine\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainMachineController extends Controller
{
    public function adminMachine()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $user = Auth::user();
        $dept = $user->dept;

        $data = [
            'user' => $user,
            'dept' => $dept,
        ];

        return view('machine.dashboard-machine', $data);
    }


    public function machine()
    {
        $user = Auth::user();
        if (!Auth::check()) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $machines = Machine::orderBy('id')->paginate(10);


        // foreach ($machines as $hydrant) {
        //     $statusHistory = $hydrant->status ?? [];
        //     $statusHydrant = $hydrant->status_hydrant ?? [];

        //     $hydrant->latest_status = is_array($statusHistory) && !empty($statusHistory)
        //         ? end($statusHistory)['status']
        //         : 0;

        //     $latestInspection = $hydrant->inspectionHydrants->first();
        //     $hydrant->latest_inspection_date = $latestInspection ? $latestInspection->inspection_date : 'Belum ada inspeksi';

        //     $abnormal = $hydrant->inspectionHydrants->contains('values', 0);

        //     $hydrant->latest_status_hydrant = $abnormal ? 1 : 0;
        // }

        $data = [
            'machines' => $machines,
            'user' => $user,
        ];

        return view('machine.machine', $data);
    }
}
