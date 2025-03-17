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
                'desc' => 'Air Service Unit'
            ],
            [
                'desc' => 'EMG Stop'
            ],
            [
                'desc' => 'Foot Switch'
            ],
            [
                'desc' => 'Jig'
            ],
            [
                'desc' => 'Hidrolik'
            ],
            [
                'desc' => 'Motor Hidrolik'
            ],
            [
                'desc' => 'Pokayoke'
            ],
            [
                'desc' => 'Area Mesin'
            ],
            [
                'desc' => 'FRL Filter'
            ],
        ];

        foreach ($groups as $group) {
            MachineGroup::create($group);
        }
    }
}
