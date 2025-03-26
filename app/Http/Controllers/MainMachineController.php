<?php

namespace App\Http\Controllers;

use App\Models\Machine\InspectionMachine;
use App\Models\Machine\Machine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainMachineController extends Controller
{
    public function adminMachine()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $user = Auth::user();

        $totalMachines = DB::table('machines')
            ->distinct('id')
            ->count('id');

        $inspected = DB::table('inspection_machines')
            ->whereNotNull('operator_date')
            ->distinct('machine_id')
            ->count('machine_id');

        $notInspected = DB::table('inspection_machines')
            ->whereNull('operator_date')
            ->distinct('machine_id')
            ->count('machine_id');

        $notReported = DB::table('inspection_machines')
            ->where('value', '=', 3)
            ->distinct('machine_id')
            ->count('machine_id');

        $reported = DB::table('inspection_machines')
            ->whereNotNull('pic_maintenance')
            ->distinct('machine_id')
            ->count('machine_id');

        $notOperational = DB::table('inspection_machines')
            ->where('value', '=', 0)
            ->distinct('machine_id')
            ->count('machine_id');

        return view('machine.dashboard-machine', [
            'user' => $user,
            'totalMachines' => $totalMachines,
            'inspected' => $inspected,
            'notInspected' => $notInspected,
            'notReported' => $notReported,
            'reported' => $reported,
            'notOperational' => $notOperational
        ]);
    }





    public function machine()
    {
        if (!Auth::check()) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $user = Auth::user();
        $machines = Machine::with(['lines', 'makers'])->get();
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
