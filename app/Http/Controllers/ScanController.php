<?php

namespace App\Http\Controllers;

use App\Models\Hydrant;
use App\Models\HydrantQR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScanController extends Controller
{
    public function qrScan(Request $request)
    {
        $latitude = $request->query('lat');
        $longitude = $request->query('lon');
        $scan = $request->input('qrcode_data');

        $hydrant = Hydrant::where('no_hydrant', $scan)->first();

        if (!$hydrant) {
            return redirect()->route('admin')->withErrors(['error' => 'QR Code tidak dikenali!']);
        }

        $distance = $this->haversineDistance($latitude, $longitude, $hydrant->latitude, $hydrant->longitude);

        if ($distance > 10) {
            return redirect()->route('admin')->withErrors(['error' => 'Anda terlalu jauh dari lokasi hydrant!']);
        }

        $data = [
            'content' => $hydrant,
            'scanned_by' => Auth::check() ? Auth::user()->name : 'guest',
            'scanned_at' => now()
        ];

        $qrCodeScan = HydrantQR::create($data);

        return response()->json($qrCodeScan);
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

    private function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000;

        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        $deltaLat = $lat2 - $lat1;
        $deltaLon = $lon2 - $lon1;

        // Haversine Formula
        $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
            cos($lat1) * cos($lat2) *
            sin($deltaLon / 2) * sin($deltaLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
