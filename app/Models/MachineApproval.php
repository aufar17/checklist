<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class MachineApproval extends Model
{
    protected $connection = 'mysql';
    protected $table = 'machine_approvals';
    protected $fillable = [
        'machine_id',
        'approved_by',
        'status',
        'notes',
    ];


    const STATUS_PENDING           = 0;
    const STATUS_APPROVED_PIC      = 1;
    const STATUS_APPROVED_SPV      = 2;
    const STATUS_APPROVED_FOREMAN  = 3;
    const STATUS_REJECTED_PIC      = -1;
    const STATUS_REJECTED_SPV      = -2;
    const STATUS_REJECTED_FOREMAN  = -3;

    protected function statusText(): Attribute
    {
        return Attribute::get(function ($value, $attributes) {
            return match ((int) $attributes['status']) {
                self::STATUS_PENDING           => 'Pending',
                self::STATUS_APPROVED_PIC      => 'Approved by PIC',
                self::STATUS_APPROVED_SPV      => 'Approved by SPV',
                self::STATUS_APPROVED_FOREMAN  => 'Approved by Foreman',
                self::STATUS_REJECTED_PIC      => 'Rejected by PIC',
                self::STATUS_REJECTED_SPV      => 'Rejected by SPV',
                self::STATUS_REJECTED_FOREMAN  => 'Rejected by Foreman',
                default                        => 'Unknown',
            };
        });
    }

    public function statusBadge(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING           => '<span class="badge bg-warning">Pending</span>',
            self::STATUS_APPROVED_PIC      => '<span class="badge bg-success">Approved by PIC</span>',
            self::STATUS_APPROVED_SPV      => '<span class="badge bg-success">Approved by SPV</span>',
            self::STATUS_APPROVED_FOREMAN  => '<span class="badge bg-success">Approved by Foreman</span>',
            self::STATUS_REJECTED_PIC      => '<span class="badge bg-danger">Rejected by PIC</span>',
            self::STATUS_REJECTED_SPV      => '<span class="badge bg-danger">Rejected by SPV</span>',
            self::STATUS_REJECTED_FOREMAN  => '<span class="badge bg-danger">Rejected by Foreman</span>',
            default                        => '<span class="badge bg-secondary">Unknown</span>',
        };
    }
}
