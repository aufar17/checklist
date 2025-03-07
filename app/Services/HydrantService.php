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

        return Hydrant::create($validate);
    }

    private function validateData(array $data)
    {
        return validator($data, [
            'no_hydrant' => 'required',
            'location' => 'required',
            'type' => 'required',
            'status' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ])->validate();
    }
}
