<?php

namespace App\Http\Controllers;

use App\Models\Hydrant;
use App\Models\HydrantQR;
use App\Models\Inspection;
use App\Models\InspectionHydrant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChecksheetController extends Controller
{
    public function checksheet($id)
    {
        $session = Auth::check();
        if (!$session) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $user = Auth::user();
        $otp = session()->has('otp_verified');
        $checksheet = HydrantQR::where('id', $id)->first();

        if (!$otp || $otp !== true) {
            return redirect()->route('admin')->with('error', 'Anda harus mengakses melalui scan QR Code.');
        }

        $scanned = session('scanned');
        if (!$scanned || (int) $scanned !== (int) $id) {
            return redirect()->route('admin')->withErrors(['error' => 'Anda harus mengakses melalui scan QR Code.']);
        }

        $hydrantData = json_decode($checksheet->content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            dd('JSON Error:', json_last_error_msg(), $checksheet->content);
        }

        $data = [
            'session' => $session,
            'scanned' => $scanned,
            'user' => $user,
            'checksheet' => $checksheet,
            'hydrantData' => $hydrantData,
        ];


        session()->remove('scanned');

        return view('checksheet', $data);
    }

    public function checksheetPost(Request $request)
    {
        foreach ($request->input('values', []) as $slug => $value) {
            $user = Auth::user();

            $inspectionId = Inspection::getIdBySlug($slug);

            if (!empty($inspectionId)) {
                InspectionHydrant::create([
                    'hydrant_id'      => $request->hydrant_id,
                    'inspection_id'   => $inspectionId,
                    'inspection_date' => now(),
                    'notes'           => $request->notes,
                    'values'          => $value,
                    'created_by'      => $user->name,
                    'created_date'    => now(),
                ]);
            }
        }

        return redirect()->route('hydrant')->with('success', 'Data berhasil disimpan!');
    }
}
