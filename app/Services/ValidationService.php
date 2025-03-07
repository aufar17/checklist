<?php

namespace App\Services;

use App\Models\Hydrant;
use App\Models\InspectionHydrant;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ValidationService
{
    public function spvValidation(array $data)
    {
        $validatedData = $this->validateData($data, [2, 4]);
        $hydrant = Hydrant::findOrFail($validatedData['hydrant_id']);

        if ($validatedData['status'] == 4 && empty($validatedData['notes'])) {
            throw ValidationException::withMessages([
                'notes' => 'Catatan wajib diisi jika status adalah Reject.',
            ]);
        }

        $hydrant->update([
            'status' => $validatedData['status'],
            'notes'  => $validatedData['status'] == 4 ? $validatedData['notes'] : $hydrant->notes,
        ]);

        InspectionHydrant::where('hydrant_id', $hydrant->id)->update([
            'known_by'   => Auth::user()->name,
            'known_date' => Carbon::now(),
        ]);

        return true;
    }

    public function managerValidation(array $data)
    {
        $validatedData = $this->validateData($data, [3, 5]);
        $hydrant = Hydrant::findOrFail($validatedData['hydrant_id']);

        if ($validatedData['status'] == 5 && empty($validatedData['notes'])) {
            throw ValidationException::withMessages([
                'notes' => 'Catatan wajib diisi jika status adalah Reject.',
            ]);
        }

        $hydrant->update([
            'status' => $validatedData['status'],
            'notes'  => $validatedData['status'] == 5 ? $validatedData['notes'] : $hydrant->notes,
        ]);

        InspectionHydrant::where('hydrant_id', $hydrant->id)->update([
            'checked_by'   => Auth::user()->name,
            'checked_date' => Carbon::now(),
        ]);

        return true;
    }

    private function validateData(array $data, array $validStatuses)
    {
        return validator($data, [
            'hydrant_id' => 'required|exists:hydrants,id',
            'status'     => 'required|in:' . implode(',', $validStatuses),
            'notes'      => 'nullable|string',
        ])->validate();
    }
}
