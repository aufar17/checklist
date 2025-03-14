<?php

namespace App\Http\Controllers;

use App\Models\Hydrant;
use App\Models\InspectionHydrant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    public function index()
    {
        return view('authentication.login');
    }

    public function admin()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $user = Auth::user();
        $hydrants = Hydrant::all();

        $otpVerified = session('otp_verified', false);
        if (!$otpVerified) {
            return redirect()->route('otp-verif')->withErrors(['error' => 'Silakan verifikasi OTP terlebih dahulu.']);
        }

        foreach ($hydrants as $hydrant) {
            $statusHistory = is_array($hydrant->status) ? $hydrant->status : [];
            $hydrant->latest_status = !empty($statusHistory) ? end($statusHistory)['status'] : 0;
        }

        $data = [
            'user' => $user,
            'hydrants' => $hydrants,
        ];

        return view('dashboard', $data);
    }


    public function hydrant()
    {
        $user = Auth::user();
        if (!Auth::check()) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $hydrants = Hydrant::with('inspectionHydrants')->orderBy('id')->paginate(10);


        foreach ($hydrants as $hydrant) {
            $statusHistory = $hydrant->status ?? [];
            $statusHydrant = $hydrant->status_hydrant ?? [];

            $hydrant->latest_status = is_array($statusHistory) && !empty($statusHistory)
                ? end($statusHistory)['status']
                : 0;

            $latestInspection = $hydrant->inspectionHydrants->first();
            $hydrant->latest_inspection_date = $latestInspection ? $latestInspection->inspection_date : 'Belum ada inspeksi';

            $abnormal = $hydrant->inspectionHydrants->contains('values', 0);

            $hydrant->latest_status_hydrant = $abnormal ? 1 : 0;
        }

        $data = [
            'hydrants' => $hydrants,
            'user' => $user,
        ];

        return view('hydrant.hydrant', $data);
    }
}
