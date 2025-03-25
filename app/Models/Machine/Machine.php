<?php

namespace App\Models\Machine;

use App\Models\MachineApproval;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Machine extends Model
{
    protected $connection = 'mysql';
    protected $table = 'machines';

    protected $fillable = [
        'no_machine',
        'name',
        'line',
        'maker',
        'no_fixed_asset',
        'status',
        'longitude',
        'latitude',
    ];

    protected $casts = [
        'status' => 'integer',
    ];

    public function inspectionMachines(): HasMany
    {
        return $this->hasMany(InspectionMachine::class, 'machine_id', 'id');
    }

    public function machineApproval(): HasMany
    {
        return $this->hasMany(MachineApproval::class, 'machine_id', 'id');
    }

    protected function statusText(): Attribute
    {
        return Attribute::get(fn($value, $attributes) => match ((int) $attributes['status']) {
            MachineApproval::STATUS_PENDING           => 'Belum Validasi',
            MachineApproval::STATUS_APPROVED_PIC      => 'Approved by PIC',
            MachineApproval::STATUS_APPROVED_SPV      => 'Approved by SPV',
            MachineApproval::STATUS_APPROVED_FOREMAN  => 'Approved by Foreman',
            MachineApproval::STATUS_REJECTED_PIC      => 'Rejected by PIC',
            MachineApproval::STATUS_REJECTED_SPV      => 'Rejected by SPV',
            MachineApproval::STATUS_REJECTED_FOREMAN  => 'Rejected by Foreman',
            default                                   => 'Unknown',
        });
    }

    // 🖼️ Status Badge untuk view, bisa dipakai: {!! $machine->statusBadge() !!}
    public function statusBadge(): string
    {
        $status = $this->status;

        return match ($status) {
            MachineApproval::STATUS_PENDING => '<button type="button" class="badge text-badge bg-warning border-0" data-bs-toggle="modal" data-bs-target="#trackingModal-' . $this->id . '">Belum Validasi</button>',

            MachineApproval::STATUS_APPROVED_PIC => '<button type="button" class="badge text-badge bg-success border-0" data-bs-toggle="modal" data-bs-target="#trackingModal-' . $this->id . '">Approved by PIC</button>',

            MachineApproval::STATUS_APPROVED_SPV => '<button type="button" class="badge text-badge bg-success border-0" data-bs-toggle="modal" data-bs-target="#trackingModal-' . $this->id . '">Approved by SPV</button>',

            MachineApproval::STATUS_APPROVED_FOREMAN => '<button type="button" class="badge text-badge bg-success border-0" data-bs-toggle="modal" data-bs-target="#trackingModal-' . $this->id . '">Approved by Foreman</button>',

            MachineApproval::STATUS_REJECTED_PIC => '<button type="button" class="badge text-badge bg-danger border-0" data-bs-toggle="modal" data-bs-target="#trackingModal-' . $this->id . '">Rejected by PIC</button>',

            MachineApproval::STATUS_REJECTED_SPV => '<button type="button" class="badge text-badge bg-danger border-0" data-bs-toggle="modal" data-bs-target="#trackingModal-' . $this->id . '">Rejected by SPV</button>',

            MachineApproval::STATUS_REJECTED_FOREMAN => '<button type="button" class="badge text-badge bg-danger border-0" data-bs-toggle="modal" data-bs-target="#trackingModal-' . $this->id . '">Rejected by Foreman</button>',

            default => '<button type="button" class="badge text-badge bg-secondary border-0" data-bs-toggle="modal" data-bs-target="#trackingModal-' . $this->id . '">Unknown</button>',
        };
    }
}
