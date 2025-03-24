<?php

namespace App\Http\Controllers;

use App\Models\Machine\InspectionMachine;
use App\Models\Machine\Machine;
use App\Models\Machine\MachineGroup;
use App\Models\Machine\MachineItem;
use App\Models\Machine\MachineQr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChecksheetMachineController extends Controller
{
    public function checksheet($id)
    {
        $session = Auth::check();
        if (!$session) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $user = Auth::user();
        $otp = session()->has('otp_verified');
        $checksheet = MachineQr::where('id', $id)->first();

        if (!$otp || $otp !== true) {
            return redirect()->route('admin-machine')->with('error', 'Anda harus mengakses melalui scan QR Code.');
        }

        $scanned = session('scanned');
        if (!$scanned || (int) $scanned !== (int) $id) {
            return redirect()->route('admin-machine')->withErrors(['error' => 'Anda harus mengakses melalui scan QR Code.']);
        }

        $machineData = json_decode($checksheet->content, true);


        if (json_last_error() !== JSON_ERROR_NONE) {
            dd('JSON Error:', json_last_error_msg(), $checksheet->content);
        }

        $mapping = [
            'OTM102' => [1, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14],
            'OTM101' => [1, 3, 4, 5, 7, 8, 9, 10, 11, 12, 13],
            'OTM177' => [10, 11, 15, 16, 17, 18, 2, 19, 20, 21],
            'OTM100' => [1, 3, 4, 5, 7, 8, 9, 10, 11, 12, 13],
            'OTM114' => [1, 3, 4, 12, 22, 23, 24, 25, 26],
        ];

        $noMachine = $machineData['code'] ?? null;
        $itemIds = $mapping[$noMachine] ?? [];

        if (empty($itemIds)) {
            return redirect()->back()->with('error', 'Item inspeksi belum dikonfigurasi untuk mesin ini.');
        }

        $machineItems = MachineItem::whereIn('id', $itemIds)->get();

        $groupedItems = $machineItems->groupBy('group_id');

        $groups = MachineGroup::whereIn('id', $groupedItems->keys())->get();

        $data = [
            'session' => $session,
            'user' => $user,
            'checksheet' => $checksheet,
            'machineData' => $machineData,
            'groups' => $groups,
            'groupedItems' => $groupedItems,
        ];

        session()->remove('scanned');

        return view('machine.checksheet', $data);
    }

    public function checksheetPost(Request $request)
    {
        $request->validate([
            'tanggal-pemeriksaan' => 'required|date',
            'waktu-pemeriksaan' => 'required',
            'pemeriksa' => 'required|string',
            'documentation' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'values' => 'required|array',
            'machine_id' => 'required|integer',
        ]);


        $imagePath = $request->file('documentation')->store('machine', 'public');

        $today = Carbon::now()->format('Y-m-d');
        $machineId = $request->input('machine_id');

        foreach ($request->input('values') as $slug => $value) {
            $machineItem = MachineItem::where('slug', $slug)->first();

            if ($machineItem) {
                $create = InspectionMachine::create([
                    'machine_id' => $machineId,
                    'machine_item_id' => $machineItem->id,
                    'value' => $value,
                    'documentation' => $imagePath,
                    'pic_maintenance' => $request->input('pemeriksa'),
                    'pic_maintenance_date' => $today,
                    'line_guide' => null,
                    'line_guide_date' => null,
                    'foreman_produksi' => null,
                    'foreman_produksi_date' => null,
                ]);
            }
        }

        $machine = Machine::where('id', $machineId)->first();

        return redirect()->route('detail-machine', ['id' => $machine->id])->with('success', 'Checksheet berhasil disimpan!');
    }
}
