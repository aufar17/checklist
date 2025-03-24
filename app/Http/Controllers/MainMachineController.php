<?php

namespace App\Http\Controllers;

use App\Models\Machine\InspectionMachine;
use App\Models\Machine\Machine;
use Carbon\Carbon;
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
        if (!Auth::check()) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $user = Auth::user();
        $machines = Machine::all();
        $today = Carbon::today();

        // Status tiap mesin
        $statusList = [];

        foreach ($machines as $machine) {
            $inspection = InspectionMachine::where('machine_id', $machine->id)
                ->whereDate('created_at', $today)
                ->latest()
                ->first();

            $status = 0; // Default: Tidak ada data

            if ($inspection) {
                if ($inspection->foreman_produksi && $inspection->foreman_produksi_date) {
                    $status = 4;
                } elseif ($inspection->line_guide && $inspection->line_guide_date) {
                    $status = 3;
                } elseif ($inspection->pic_maintenance && $inspection->pic_maintenance_date) {
                    $status = 2;
                } else {
                    $status = 1; // Minimal operator sudah inspeksi (ada data, tapi belum dicek siapa pun)
                }
            }

            $statusList[$machine->id] = $status;
        }

        $data = [
            'machines' => $machines,
            'user' => $user,
            'statusList' => $statusList,
        ];

        return view('machine.machine', $data);
    }
}
