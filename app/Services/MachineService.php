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


    public function machineUpdate(int $id, array $data)
    {
        $validate = $this->validateData($data);

        $machine = Machine::find($id);
        if (!$machine) {
            return back()->withErrors(['error' => 'Machine tidak ditemukan.']);
        }



        $machine->update($validate);

        return redirect()->route('machine')->with('success', 'Machine berhasil diperbarui');
    }


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
