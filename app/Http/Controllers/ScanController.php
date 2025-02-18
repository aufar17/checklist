<?php

namespace App\Http\Controllers;

use App\Models\HydrantQR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScanController extends Controller
{
    public function qrScan(Request $request)
    {
        $data = $request->input('qrcode_data');

        $qrCodeScan = HydrantQR::create([
            'content' => $data,
            'scanned_by' => Auth::check() ? Auth::user()->name : 'guest',
            'scanned_at' => now()
        ]);

        return response()->json([
            'message' => 'QR Code berhasil dipindai',
            'data' => $qrCodeScan
        ]);
    }
}
