<?php

namespace Database\Seeders;

use App\Models\Inspection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InspectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inspections = [
            [
                'group_id' => 1,
                'item' => 'Panjang Selang',
            ]
        ];

        foreach ($inspections as $inspection) {
            Inspection::create($inspection);
        }
    }
}
