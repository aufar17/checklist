<?php

namespace App\Http\Controllers;

use App\Models\HydrantQR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScanController extends Controller
{
    public function qrScan(Request $request)
    {
        $scan = $request->input('qrcode_data');

        $data = [
            'content' => $scan,
            'scanned_by' => Auth::check() ? Auth::user()->name : 'guest',
            'scanned_at' => now()
        ];

        $qrCodeScan = HydrantQR::create($data);

        return response()->json([
            'message' => 'QR Code berhasil dipindai',
            'data' => $qrCodeScan
        ]);
    }

    public function scan()
    {
        $session = Auth::check();
        if ($session) {
            $user = Auth::user();
            $data = [
                'user' => $user,
                'session' => $session,
            ];

            return view('scan', $data);
        }
        if (!$session) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }
    }
}
