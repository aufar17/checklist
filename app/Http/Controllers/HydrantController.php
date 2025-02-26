<?php

namespace App\Http\Controllers;

use App\Models\Hydrant;
use App\Services\HydrantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HydrantController extends Controller
{
    public function newHydrant()
    {

        $session = Auth::check();
        $user = Auth::user();

        if (!$session) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $data = [
            'user' => $user,
            'session' => $session,
        ];

        return view('hydrant.new-hydrant', $data);
    }

    public function hydrantPost(Request $request)
    {

        $hydrant = new HydrantService();
        $create = $hydrant->hydrantPost($request->all());

        return $create
            ? redirect()->route('hydrant')->with('success', 'Hydrant berhasil ditambahkan!')
            : redirect()->route('hydrant')->with('error', 'Hydrant gagal ditambahkan!');
    }

    public function detailHydrant($id)
    {
        $session = Auth::check();
        $user = Auth::user();
        $hydrant = Hydrant::where('id', $id)->first();
        $no = 1;

        if (!$session) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $data = [
            'user' => $user,
            'session' => $session,
            'hydrant' => $hydrant,
            'no' => $no,
        ];


        return view('hydrant.hydrant-details', $data);
    }
}
