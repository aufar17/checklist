<?php

namespace App\Livewire;

use App\Models\Hydrant;
use Carbon\Carbon;
use Livewire\Component;

class Kpi extends Component
{
    public $jumlahHydrant, $inspected, $notInspected, $abnormal, $normal;

    public function mount()
    {
        $this->updateKpi();
    }

    public function updateKpi()
    {
        $bulanSekarang = Carbon::now()->format('Y-m');

        $hydrants = Hydrant::with('inspectionHydrants')->get(); // Tambah relasi

        $this->jumlahHydrant = $hydrants->count();
        $this->notInspected = 0;
        $this->inspected = 0;
        $this->normal = 0;
        $this->abnormal = 0;

        foreach ($hydrants as $hydrant) {
            $statusHistory = $hydrant->status ?? [];
            $statusHydrant = $hydrant->status_hydrant ?? [];

            $latestStatus = is_array($statusHistory) && !empty($statusHistory)
                ? end($statusHistory)['status']
                : 0;

            $latestInspection = $hydrant->inspectionHydrants->first();
            $latestInspectionDate = $latestInspection ? $latestInspection->inspection_date : 'Belum ada inspeksi';

            $abnormal = $hydrant->inspectionHydrants->contains('values', 0);
            $latestStatusHydrant = $abnormal ? 1 : 0;

            // Hitung KPI
            if ($latestStatus == 0) {
                $this->notInspected++;
            } elseif ($latestStatus == 1) {
                $this->inspected++;
            }

            if ($latestStatusHydrant == 1) {
                $this->abnormal++;
            } else {
                $this->normal++;
            }
        }
    }

    public function render()
    {
        return view('livewire.kpi');
    }
}
