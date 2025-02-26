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
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $scan = $request->input('qrcode_data');

        // Validasi input
        if (!$latitude || !$longitude || !filter_var($latitude, FILTER_VALIDATE_FLOAT) || !filter_var($longitude, FILTER_VALIDATE_FLOAT)) {
            return response()->json(['error' => 'Koordinat tidak valid!'], 400);
        }

        if (!$scan) {
            return response()->json(['error' => 'QR Code tidak boleh kosong!'], 400);
        }

        // Cek hydrant berdasarkan QR Code
        $hydrant = Hydrant::where('no_hydrant', $scan)->first();

        if (!$hydrant) {
            return response()->json(['error' => 'QR Code tidak dikenali!'], 404);
        }

        if (!$hydrant->latitude || !$hydrant->longitude) {
            return response()->json(['error' => 'Data lokasi hydrant tidak tersedia!'], 500);
        }

        // Hitung jarak dengan Haversine Formula
        $distance = $this->haversineDistance(
            (float) $latitude,
            (float) $longitude,
            (float) $hydrant->latitude,
            (float) $hydrant->longitude
        );

        $response = [
            'latitude sekarang' => number_format($latitude, 6),
            'longitude sekarang' => number_format($longitude, 6),
            'latitude hydrant' => number_format($hydrant->latitude, 6),
            'longitude hydrant' => number_format($hydrant->longitude, 6),
            'distance (meter)' => number_format($distance, 2),
        ];

        dd($response);

        if ($distance > 10) {
            return response()->json([
                'error' => 'Anda terlalu jauh dari lokasi hydrant!',
                'details' => $response
            ], 403);
        }

        // Simpan data scan ke database
        $qrCodeScan = HydrantQR::create([
            'content' => $scan,
            'scanned_by' => Auth::check() ? Auth::user()->name : 'guest',
            'scanned_at' => now()
        ]);

        return response()->json([
            'message' => 'Scan berhasil!',
            'data' => $qrCodeScan,
            'details' => $response
        ], 200);
    }





    private function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // Radius bumi dalam meter (6371 km * 1000)

        // Konversi derajat ke radian
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        // Hitung perbedaan koordinat
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;

        // Rumus Haversine
        $a = sin($dlat / 2) * sin($dlat / 2) +
            cos($lat1) * cos($lat2) *
            sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c; // Hasil dalam meter
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
