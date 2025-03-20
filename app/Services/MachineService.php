<?php

namespace App\Services;

use App\Models\Machine\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class MachineService
{

    public function machinePost(array $data)
    {
        $validate = $this->validateData($data);

            // $validate['status'] = [
            //     ['status' => 0, 'timestamp' => now()->format('Y-m-d H:i:s')],
            // ];

        return Machine::create($validate);
    }


    // public function hydrantUpdate(int $id, array $data)
    // {
    //     $validate = $this->validateData($data);

    //     $hydrant = Hydrant::find($id);
    //     if (!$hydrant) {
    //         return back()->withErrors(['error' => 'Hydrant tidak ditemukan.']);
    //     }

    //     $validate['status'] = [
    //         ['status' => 0, 'timestamp' => now()->format('Y-m-d H:i:s')],
    //         ['status_hydrant' => 0, 'timestamp' => now()->format('Y-m-d H:i:s')],
    //     ];

    //     $validate['panjang_selang'] = str_replace(',', '.', $data['panjang_selang']);

    //     $hydrant->update($validate);

    //     return redirect()->route('hydrant')->with('success', 'Hydrant berhasil diperbarui');
    // }


    private function validateData(array $data)
    {
        return validator($data, [
            'no_machine'    => 'required|string',
            'name'      => 'required|string',
            'line'          => 'required|string',
            'maker'        => 'required',
            'no_fixed_asset' => 'required|numeric',
            'status'        => 'required',
            'longitude'     => 'required|numeric',
            'latitude'      => 'required|numeric',
        ])->validate();
    }
}
