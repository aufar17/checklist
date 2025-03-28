<?php

namespace Database\Seeders;

use App\Models\GroupInspection;
use App\Models\Machine\MachineGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PHPUnit\Framework\Attributes\Group;

class MachineGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            [
                'desc' => 'Push Button'
            ],
            [
                'desc' => 'EMG Stop'
            ],
            [
                'desc' => 'Nagara Switch'
            ],
            [
                'desc' => 'Motor Hidrolik'
            ],
            [
                'desc' => 'Tangki Hidrolik'
            ],
            [
                'desc' => 'Hidrolik'
            ],
            [
                'desc' => 'Lubrikasi'
            ],
            [
                'desc' => 'Air Service Unit'
            ],
            [
                'desc' => 'Pneumatik'
            ],

            [
                'desc' => 'Tangki Coolant'
            ],
            [
                'desc' => 'Bar'
            ],
            [
                'desc' => 'Panel Operasi'
            ],
            [
                'desc' => 'Panel Kontrol'
            ],
            [
                'desc' => 'Pendant Robot'
            ],
            [
                'desc' => 'Sliding Robot'
            ],
            [
                'desc' => 'Cyl Clamp'
            ],
            [
                'desc' => 'Robot Arm'
            ],
            [
                'desc' => 'Safety Plug'
            ],
            [
                'desc' => 'Safety Sensor'
            ],
            [
                'desc' => 'Nozzle Cleaning'
            ],
            [
                'desc' => 'Mist Collector'
            ],
            [
                'desc' => 'Pompa'
            ],
            [
                'desc' => 'Tangki Air'
            ],
        ];

        foreach ($groups as $group) {
            MachineGroup::create($group);
        }
    }
}
