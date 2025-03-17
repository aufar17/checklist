<?php

namespace App\Services;

use App\Models\Hydrant;
use App\Models\HydrantQR;
use App\Models\Machine\Machine;
use App\Models\Machine\MachineQr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class   ScanService
{

    public function scanProcess($latitude, $longitude, $code)
    {

        $user = Auth::user();
        if (!$latitude || !$longitude || !filter_var($latitude, FILTER_VALIDATE_FLOAT) || !filter_var($longitude, FILTER_VALIDATE_FLOAT)) {
            return response()->json(['error' => 'Koordinat tidak valid!'], 400);
        }

        if (!$code) {
            return response()->json(['error' => 'QR Code tidak boleh kosong!'], 400);
        }

        if ($user->dept == 'EHS') {

            $hydrant = Hydrant::where('no_hydrant', $code)->first();

            if (!$hydrant) {
                return response()->json(['error' => 'QR Code tidak dikenali!'], 404);
            }

            if (!$hydrant->latitude || !$hydrant->longitude) {
                return response()->json(['error' => 'Data lokasi hydrant tidak tersedia!'], 500);
            }

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


            if ($distance > 10) {
                return response()->json([
                    'error' => 'Anda terlalu jauh dari lokasi hydrant!',
                    'details' => $response
                ], 403);
            }

            $hydrantData = [
                'id' => $hydrant->id,
                'code' => $hydrant->no_hydrant,
                'location' => $hydrant->location,
                'type' => $hydrant->type,
                'latitude' => $hydrant->latitude,
                'longitude' => $hydrant->longitude,
            ];


            $qrCodeScan = HydrantQR::create([
                'content' => json_encode($hydrantData),
                'scanned_by' => Auth::check() ? Auth::user()->name : 'guest',
                'scanned_at' => now()
            ]);
        }

        if ($user->dept == 'PE-2W') {

            $machine = Machine::where('no_machine', $code)->first();

            if (!$machine) {
                return response()->json(['error' => 'QR Code tidak dikenali!'], 404);
            }

            if (!$machine->latitude || !$machine->longitude) {
                return response()->json(['error' => 'Data lokasi machine tidak tersedia!'], 500);
            }

            $distance = $this->haversineDistance(
                (float) $latitude,
                (float) $longitude,
                (float) $machine->latitude,
                (float) $machine->longitude
            );


            $response = [
                'latitude sekarang' => number_format($latitude, 6),
                'longitude sekarang' => number_format($longitude, 6),
                'latitude machine' => number_format($machine->latitude, 6),
                'longitude machine' => number_format($machine->longitude, 6),
                'distance (meter)' => number_format($distance, 2),
            ];


            if ($distance > 10) {
                return response()->json([
                    'error' => 'Anda terlalu jauh dari lokasi machine!',
                    'details' => $response
                ], 403);
            }

            $machineData = [
                'id' => $machine->id,
                'code' => $machine->no_machine,
                'location' => $machine->location,
                'type' => $machine->type,
                'latitude' => $machine->latitude,
                'longitude' => $machine->longitude,
            ];


            $qrCodeScan = MachineQr::create([
                'content' => json_encode($machineData),
                'scanned_by' => Auth::check() ? Auth::user()->name : 'guest',
                'scanned_at' => now()
            ]);
        }


        session()->put('scanned', $qrCodeScan->id);

        return [
            'message' => 'Scan berhasil!',
            'data' => $qrCodeScan,
            'details' => $response,
            'status' => 200
        ];
    }

    private function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000;

        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;

        $a = sin($dlat / 2) * sin($dlat / 2) +
            cos($lat1) * cos($lat2) *
            sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
