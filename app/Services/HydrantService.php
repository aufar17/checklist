<?php

namespace App\Services;

use App\Models\Hydrant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class HydrantService
{

    public function hydrantPost(array $data)
    {
        $validate = $this->validateData($data);

        $validate['status'] = [
            ['status' => 0, 'timestamp' => now()->format('Y-m-d H:i:s')]
        ];

        $validate['panjang_selang'] = str_replace(',', '.', $data['panjang_selang']);

        return Hydrant::create($validate);
    }

    private function validateData(array $data)
    {
        return validator($data, [
            'no_hydrant'    => 'required|string',
            'location'      => 'required|string',
            'type'          => 'required|string',
            'status'        => 'required',
            'panjang_selang' => 'required|numeric',
            'jenis_nozle'   => 'required|string',
            'longitude'     => 'required|numeric',
            'latitude'      => 'required|numeric',
        ])->validate();
    }
}
