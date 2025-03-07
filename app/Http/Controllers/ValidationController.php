<?php

namespace App\Http\Controllers;

use App\Services\ValidationService;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function spvValidation(Request $request)
    {
        $validation = new ValidationService();
        $create = $validation->spvValidation($request->all());

        return $create
            ? redirect()->route('admin')->with('success', 'Inspeksi divalidasi!')
            : redirect()->route('admin')->with('error', 'Inspeksi ditolak!');
    }
    public function managerValidation(Request $request)
    {
        $validation = new ValidationService();
        $create = $validation->managerValidation($request->all());

        return $create
            ? redirect()->route('admin')->with('success', 'Inspeksi divalidasi!')
            : redirect()->route('admin')->with('error', 'Inspeksi ditolak!');
    }
}
