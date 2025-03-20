<?php

namespace App\Http\Controllers;

use App\Models\Machine\InspectionMachine;
use App\Models\Machine\Machine;
use App\Models\Machine\MachineGroup;
use App\Models\Machine\MachineItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MachineController extends Controller
{

    public function newMachine()
    {
        $session = Auth::check();
        if (!$session) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $user = Auth::user();

        $data = [
            'session' => $session,
            'user' => $user,
        ];

        return view('machine.new-machine');
    }
    public function detailMachine($id)
    {
        $session = Auth::check();
        if (!$session) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $user = Auth::user();
        $machine = Machine::find($id);


        if (!$machine) {
            return back()->withErrors(['error' => 'Mesin tidak ditemukan.']);
        }

        $mapping = [
            'OTM102' => [1, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14],
            'OTM101' => [1, 3, 4, 5, 7, 8, 9, 10, 11, 12, 13],
            'OTM177' => [10, 11, 15, 16, 17, 18, 2, 19, 20, 21],
            'OTM100' => [1, 3, 4, 5, 7, 8, 9, 10, 11, 12, 13],
            'OTM114' => [1, 3, 4, 12, 22, 23, 24, 25, 26],
        ];

        $noMachine = $machine->no_machine;
        $itemIds = $mapping[$noMachine] ?? [];

        if (empty($itemIds)) {
            return redirect()->back()->with('error', 'Item inspeksi belum dikonfigurasi untuk mesin ini.');
        }

        $machine_items = MachineItem::with('machineGroups')->whereIn('id', $itemIds)->orderBy('id')->get();

        $groupedItems = $machine_items->groupBy('group_id');
        $groups = MachineGroup::whereIn('id', $groupedItems->keys())->get();

        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $daysInMonth = Carbon::now()->daysInMonth;

        $inspectionsRaw = InspectionMachine::whereBetween('pic_maintenance_date', [$startDate, $endDate])
            ->whereIn('machine_item_id', $itemIds)
            ->get();

        $inspections = $inspectionsRaw->mapWithKeys(function ($item) {
            $day = Carbon::parse($item->pic_maintenance_date)->day;
            $key = $item->machine_item_id . '_' . $day;

            return [
                $key => $item
            ];
        });
        $data = [
            'user' => $user,
            'machines' => $machine,
            'machine_items' => $machine_items,
            'groups' => $groups,
            'daysInMonth' => $daysInMonth,
            'inspections' => $inspections,
        ];

        return view('machine.machine-details', $data);
    }
}
