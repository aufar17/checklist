<?php

namespace Database\Seeders;

use App\Models\Machine\Machine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $machines = [
            [
                'no_machine' => 'OTM102',
                'name' => 'L-1 BTA TONGTAI',
                'line' => '1',
                'maker' => '2',
                'no_fixed_asset' => '175062200',
                'status' => '0',
                'longitude' => '107.10052967997997',
                'latitude' => '-6.310861689995114',
            ],
            [
                'no_machine' => 'OTM101',
                'name' => 'L-1 CNC ROBODRILL',
                'line' => '1',
                'maker' => '1',
                'no_fixed_asset' => '175062100',
                'status' => '0',
                'longitude' => '107.10052967997997',
                'latitude' => '-6.310861689995114',
            ],
            [
                'no_machine' => 'OTM177',
                'name' => 'L-1 ROBOT HANDLING',
                'line' => '1',
                'maker' => '3',
                'no_fixed_asset' => '175143900',
                'status' => '0',
                'longitude' => '107.10052967997997',
                'latitude' => '-6.310861689995114',
            ],
            [
                'no_machine' => 'OTM100',
                'name' => 'L-1 CNC ROBODRILL',
                'line' => '1',
                'maker' => '1',
                'no_fixed_asset' => '175062000',
                'status' => '0',
                'longitude' => '107.10052967997997',
                'latitude' => '-6.310861689995114',
            ],
            [
                'no_machine' => 'OTM114',
                'name' => 'L-1 O/T CLEANING',
                'line' => '1',
                'maker' => '4',
                'no_fixed_asset' => '175065800',
                'status' => '0',
                'longitude' => '107.10052967997997',
                'latitude' => '-6.310861689995114',
            ],
        ];

        foreach ($machines as $machine) {
            Machine::create($machine);
        }
    }
}
