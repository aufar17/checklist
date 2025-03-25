<?php

namespace Database\Seeders;

use App\Models\MachineMaker;
use App\Models\MakerMachine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $makers = [
            [
                'name' => 'FANUC'
            ],
            [
                'name' => 'TONGTAI'
            ],
            [
                'name' => 'YASKAWA'
            ],
            [
                'name' => 'PRN'
            ],
        ];

        foreach ($makers as $maker) {
            MachineMaker::create($maker);
        }
    }
}
