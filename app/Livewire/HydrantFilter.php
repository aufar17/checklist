<?php

namespace App\Livewire;

use App\Models\Hydrant;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class HydrantFilter extends Component
{
    use WithPagination;

    public $year, $month, $statusHydrant, $approval;
    public $years, $months, $user;
    public array $hydrants = [];

    public function mount()
    {
        $this->user = Auth::user();
        $this->years = range(date('Y'), date('Y') - 5);
        $this->months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];
    }

    public function updated($propertyName)
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.hydrant-filter');
    }

    public function filter()
    {
        $hydrants = Hydrant::with([
            'inspectionHydrants' => function ($query) {
                if ($this->year) {
                    $query->whereYear('inspection_date', $this->year);
                }
            }
        ])

            ->when(
                $this->statusHydrant !== null,
                fn($query) =>
                $query->where('status_hydrant', $this->statusHydrant)
            )

            ->when($this->approval && $this->approval !== 'belum-inspeksi', function ($query) {
                return match ($this->approval) {
                    'dibuat' => $query->where('status->status', 1),
                    'spv-val' => $query->where('status->status', 2),
                    'manager-val' => $query->where('status->status', 3),
                    default => $query
                };
            })

            ->when($this->approval === 'belum-inspeksi', function ($query) {
                $query->whereDoesntHave('inspectionHydrants', function ($q) {
                    if ($this->year) {
                        $q->whereYear('inspection_date', $this->year);
                    }
                });
            })

            ->orderBy('id')
            ->paginate(10);


        foreach ($hydrants as $hydrant) {
            $statusHistory = $hydrant->status ?? [];
            $hydrant->latest_status = is_array($statusHistory) && !empty($statusHistory)
                ? (int) end($statusHistory)['status']
                : 0;

            $latestInspection = $hydrant->inspectionHydrants->first();
            $hydrant->latest_inspection_date = $latestInspection ? $latestInspection->inspection_date : 'Belum ada inspeksi';

            $abnormal = $hydrant->inspectionHydrants->contains('values', 0);
            $hydrant->latest_status_hydrant = $abnormal ? 1 : 0;
        }

        $hydrants = array_map(fn($item) => $item->toArray(), $hydrants->items());
        $this->hydrants = $hydrants;
        // dd($hydrants);
    }
}
