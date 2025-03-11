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
                'slug' => 'posisi',
                'item' => 'Posisi Hydrant',
            ],
            [
                'group_id' => 1,
                'slug' => 'pintu',
                'item' => 'Pintu Hydrant',
            ],
            [
                'group_id' => 1,
                'slug' => 'identitas',
                'item' => 'Identitas Hydrant',
            ],
            [
                'group_id' => 2,
                'slug' => 'jumlah-selang',
                'item' => 'jumlah Selang',
            ],
            [
                'group_id' => 2,
                'slug' => 'kondisi-selang',
                'item' => 'Kondisi Selang',
            ],
            [
                'group_id' => 2,
                'slug' => 'coupling-selang',
                'item' => 'Coupling Selang',
            ],
            [
                'group_id' => 3,
                'slug' => 'jumlah-nozle',
                'item' => 'Jumlah Nozle',
            ],
            [
                'group_id' => 3,
                'slug' => 'seal-nozle',
                'item' => 'Seal Nozle',
            ],
            [
                'group_id' => 3,
                'slug' => 'body-nozle',
                'item' => 'Body Nozle',
            ],
            [
                'group_id' => 3,
                'slug' => 'coupling-nozle',
                'item' => 'Coupling Nozle',
            ],
            [
                'group_id' => 4,
                'slug' => 'jumlah-kran',
                'item' => 'Jumlah Kran',
            ],
            [
                'group_id' => 4,
                'slug' => 'kondisi-kran',
                'item' => 'Kondisi Kran',
            ],
            [
                'group_id' => 5,
                'slug' => 'jumlah-kunci',
                'item' => 'jumlah kunci',
            ],
            [
                'group_id' => 5,
                'slug' => 'kondisi-kunci',
                'item' => 'Kondisi kunci',
            ],
            [
                'group_id' => 6,
                'slug' => 'kondisi-manipold',
                'item' => 'Kondisi manipold',
            ],
            [
                'group_id' => 7,
                'slug' => 'kondisi-segel',
                'item' => 'Kondisi segel',
            ],
        ];

        foreach ($inspections as $inspection) {
            Inspection::create($inspection);
        }
    }
}
