<?php

namespace App\Http\Controllers;

use App\Models\Hydrant;
use App\Models\HydrantQR;
use App\Services\ScanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScanController extends Controller
{
    public function scanProcess(Request $request)
    {
        $user = Auth::user();
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $code = $request->input('qrcode_data');

        $scanService = new ScanService();
        $result = $scanService->scanProcess($latitude, $longitude, $code);

        if ($result instanceof JsonResponse) {
            return redirect()->route('scan')->with('error', $result->getData()->error);
        }

        if ($user->dept == 'EHS') {
            return redirect()->route('checksheet', ['id' => $result['data']->id])
                ->with('success', 'Scan berhasil!');
        }

        if ($user->dept == 'PE-2W') {
            return redirect()->route('checksheet-machine', ['id' => $result['data']->id])
                ->with('success', 'Scan berhasil!');
        }
    }



    public function scan(Request $request)
    {
        $latitude = $request->query('lat');
        $longitude = $request->query('lon');

        $session = Auth::check();
        if ($session) {
            $user = Auth::user();
            $data = [
                'user' => $user,
                'session' => $session,
                'longitude' => $longitude,
                'latitude' => $latitude,
            ];

            return view('scan', $data);
        }
        if (!$session) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }
    }
}
