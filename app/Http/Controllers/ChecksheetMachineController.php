<?php

namespace App\Http\Controllers;

use App\Models\Machine\MachineGroup;
use App\Models\Machine\MachineItem;
use App\Models\Machine\MachineQr;
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
        $checksheet = MachineQr::find($id);

        if (!$otp || $otp !== true) {
            return redirect()->route('admin-machine')->with('error', 'Anda harus mengakses melalui scan QR Code.');
        }

        // $scanned = session('scanned');
        // if (!$scanned || (int) $scanned !== (int) $id) {
        //     return redirect()->route('admin-machine')->withErrors(['error' => 'Anda harus mengakses melalui scan QR Code.']);
        // }

        $groups = MachineGroup::with('machineItems')->get();
        $machineData = json_decode($checksheet->content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            dd('JSON Error:', json_last_error_msg(), $checksheet->content);
        }

        $data = [
            'session' => $session,
            // 'scanned' => $scanned,
            'user' => $user,
            'checksheet' => $checksheet,
            'machineData' => $machineData,
            'groups' => $groups,
        ];



        session()->remove('scanned');

        return view('machine.checksheet', $data);
    }
}
