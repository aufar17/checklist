<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use App\Models\Hydrant;
use App\Models\HydrantQR;
use App\Models\Inspection;
use App\Models\InspectionHydrant;
use App\Models\ValidationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return DB::transaction(function () use ($request) {
            $filename = null;
            if ($request->hasFile('documentation')) {
                $file = $request->file('documentation');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('documentation', $filename, 'public');
            }

            $values = $request->input('values', []);
            $notes = $request->input('notes', []);
            $user = Auth::user();
            $hydrantId = $request->hydrant_id;
            $isAbnormal = false;

            foreach ($values as $slug => $value) {
                $inspectionId = Inspection::getIdBySlug($slug);

                if (!empty($inspectionId)) {
                    if ($value == "0") {
                        $isAbnormal = true;
                    }

                    InspectionHydrant::create([
                        'hydrant_id'      => $hydrantId,
                        'inspection_id'   => $inspectionId,
                        'inspection_date' => now(),
                        'documentation'   => $filename,
                        'notes'           => isset($notes[$slug]) && $value == "0" ? $notes[$slug] : null,
                        'values'          => $value,
                        'created_by'      => $user->name,
                        'created_date'    => now(),
                    ]);
                }
            }

            $hydrant = Hydrant::findOrFail($hydrantId);

            // Buat log aksi
            ActionLog::create([
                'hydrant_id' => $hydrant->id,
                'user'       => $user->id,
                'action'     => $request->status,
                'created_at' => now(),
            ]);

            $statusHistory = $hydrant->status ?? [];
            $statusHydrant = $hydrant->status_hydrant ?? [];

            $statusHistory[] = [
                'status'    => $request->status,
                'timestamp' => now()->format('Y-m-d H:i:s'),
            ];

            $statusHydrant[] = [
                'status'    => $isAbnormal ? 1 : 0,
                'timestamp' => now()->format('Y-m-d H:i:s'),
            ];

            $hydrant->update([
                'status'         => $statusHistory,
                'status_hydrant' => $statusHydrant,
            ]);

            return redirect()->route('detail-hydrant', ['id' => $hydrant->id])
                ->with('success', 'Data berhasil disimpan!');
        });
    }
}
