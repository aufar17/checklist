<?php

namespace Database\Seeders;

use App\Models\GroupInspection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PHPUnit\Framework\Attributes\Group;

class HydrantGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            [
                'name' => 'Kondisi Box Hydrant'
            ],
            [
                'name' => 'Selang'
            ],
            [
                'name' => 'Nozle'
            ],
            [
                'name' => 'Kran'
            ],
            [
                'name' => 'Kunci Pembuka Kran'
            ],
            [
                'name' => 'Manipold'
            ],
            [
                'name' => 'Segel Pemeriksaan'
            ],
        ];

        foreach ($groups as $group) {
            GroupInspection::create($group);
        }
    }
}
