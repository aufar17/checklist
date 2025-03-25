<?php

namespace App\Http\Controllers;

use App\Models\Machine\InspectionMachine;
use App\Models\Machine\Machine;
use App\Models\Machine\MachineGroup;
use App\Models\Machine\MachineItem;
use App\Services\MachineService;
use Carbon\Carbon as CarbonCarbon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;
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

        return view('machine.new-machine', $data);
    }

    public function machinePost(Request $request)
    {
        $session = Auth::check();
        if (!$session) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }
        $hydrant = new MachineService();
        $create = $hydrant->machinePost($request->all());

        return $create
            ? redirect()->route('machine')->with('success', 'machine berhasil ditambahkan!')
            : redirect()->route('machine')->with('error', 'machine gagal ditambahkan!');
    }


    public function editMachine($id)
    {
        $session = Auth::check();
        if (!$session) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $user = Auth::user();
        $machine = Machine::where('id', $id)->first();

        $data = [
            'machine' => $machine,
            'user' => $user
        ];
        return view('machine.edit-machine', $data);
    }

    public function machineUpdate(Request $request)
    {

        $session = Auth::check();
        if (!$session) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        if (!$request->id) {
            return redirect()->route('machine')->with('error', 'ID Machine tidak ditemukan!');
        }

        $machineService = new MachineService();

        $update = $machineService->machineUpdate($request->id, $request->all());

        if ($update) {
            return redirect()->route('machine')->with('success', 'Machine berhasil diperbarui!');
        } else {
            return redirect()->route('machine')->with('error', 'Machine gagal diperbarui!');
        }
    }

    public function detailMachine($id)
    {
        abort_unless(Auth::check(), 403, 'Anda harus login terlebih dahulu.');
        $user = Auth::user();

        $machines = Machine::findOrFail($id);

        $mapping = [
            'OTM102' => [1, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14],
            'OTM101' => [1, 3, 4, 5, 7, 8, 9, 10, 11, 12, 13],
            'OTM177' => [10, 11, 15, 16, 17, 18, 2, 19, 20, 21],
            'OTM100' => [1, 3, 4, 5, 7, 8, 9, 10, 11, 12, 13],
            'OTM114' => [1, 3, 4, 12, 22, 23, 24, 25, 26],
        ];

        $itemIds = $mapping[$machines->no_machine] ?? [];
        if (empty($itemIds)) {
            return redirect()->back()->with('error', 'Item inspeksi belum dikonfigurasi untuk mesin ini.');
        }

        $machine_items = MachineItem::with('machineGroups')->whereIn('id', $itemIds)->orderBy('id')->get();
        $groups = MachineGroup::whereIn('id', $machine_items->pluck('group_id'))->get();
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();
        $daysInMonth = now()->daysInMonth;

        $inspectionsRaw = InspectionMachine::whereBetween('operator_date', [$startDate, $endDate])
            ->whereIn('machine_item_id', $itemIds)
            ->where('machine_id', $machines->id)
            ->get();


        $inspections = $inspectionsRaw->mapWithKeys(fn($item) => [
            $item->machine_item_id . '_' . Carbon::parse($item->operator_date)->day => $item
        ]);


        $imagePaths = match ($machines->id) {
            1 => ['img/1-1.jpg', 'img/1-2.jpg', 'img/1-3.png'],
            2 => ['img/2-1.png', 'img/2-2.png', 'img/2-3.png', 'img/2-4.png', 'img/2-5.png'],
            3 => ['img/3-1.png', 'img/3-2.png', 'img/3-3.png', 'img/3-4.png'],
            4 => ['img/4-1.png', 'img/4-2.png', 'img/4-3.png', 'img/4-4.png', 'img/4-5.png'],
            5 => ['img/5-1.png', 'img/5-2.png', 'img/5-3.png', 'img/5-4.png', 'img/5-5.png', 'img/5-6.png'],
            default => ['img/default1.png', 'img/default2.png'],
        };

        $data = [
            'user' => $user,
            'machines' => $machines,
            'machine_items' => $machine_items,
            'groups' => $groups,
            'daysInMonth' => $daysInMonth,
            'inspections' => $inspections,
            'imagePaths' => $imagePaths,
        ];

        return view('machine.machine-details', $data);
    }

    public function machineDelete()
    {
        if (!Auth::check()) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $id = request()->post('id');
        $machine = Machine::where('id', $id)->first();

        if (!$machine) {
            return back()->withErrors(['error' => 'Machine tidak ditemukan.']);
        }

        $machine->delete();

        return redirect()->route('machine')->with('success', 'Machine berhasil dihapus');
    }
}
