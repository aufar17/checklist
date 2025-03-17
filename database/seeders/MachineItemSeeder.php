<?php

namespace Database\Seeders;

use App\Models\Machine\MachineItem;
use Illuminate\Database\Seeder;

class MachineItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inspections = [
            [
                'group_id' => 1,
                'slug' => 'tekanan-angin',
                'instruction' => 'Periksa tekanan angin (tulis dengan angka)',
                'standard' => '4-6bar(kg/cm²)/0,4-0,6MPa',
                'time' => '5',
                'frequency' => '1',
            ],
            [
                'group_id' => 1,
                'slug' => 'oli-lubrikasi',
                'instruction' => 'Periksa oli lubrikasi (tambah jika perlu)',
                'standard' => 'Antara batas lower & upper',
                'time' => '60',
                'frequency' => '1',
            ],
            [
                'group_id' => 2,
                'slug' => 'tombol-emg-stop',
                'instruction' => 'Periksa tombol EMG stop',
                'standard' => 'Saat ditekan mesin stop',
                'time' => '5',
                'frequency' => '1',
            ],
            [
                'group_id' => 3,
                'slug' => 'foot-switch',
                'instruction' => 'Periksa kondisi foot switch',
                'standard' => 'Berfungsi baik',
                'time' => '5',
                'frequency' => '1',
            ],
            [
                'group_id' => 4,
                'slug' => 'jig',
                'instruction' => 'Periksa centering jig kanan/kiri (kelurusan jig)',
                'standard' => 'Jig senter dan lurus',
                'time' => '10',
                'frequency' => '1',
            ],
            [
                'group_id' => 5,
                'slug' => 'kebocoran-oli',
                'instruction' => 'Periksa adanya kebocoran oli',
                'standard' => 'Tidak bocor',
                'time' => '10',
                'frequency' => '1',
            ],
            [
                'group_id' => 5,
                'slug' => 'tekanan-hidrolik',
                'instruction' => 'Periksa tekanan hidrolik & kondisi pressure gauge',
                'standard' => 'Normal',
                'time' => '5',
                'frequency' => '1',
            ],
            [
                'group_id' => 5,
                'slug' => 'oli-hidrolik',
                'instruction' => 'Periksa level oli hidrolik',
                'standard' => 'Antara lower & upper limit',
                'time' => '5',
                'frequency' => '1',
            ],
            [
                'group_id' => 6,
                'slug' => 'motor-hidrolik',
                'instruction' => 'Periksa suara motor hidrolik',
                'standard' => 'Suara halus',
                'time' => '5',
                'frequency' => '1',
            ],
            [
                'group_id' => 7,
                'slug' => 'sistem-pokayoke',
                'instruction' => 'Periksa fungsi sistem pokayoke',
                'standard' => 'Berfungsi baik',
                'time' => '10',
                'frequency' => '1',
            ],
            [
                'group_id' => 8,
                'slug' => 'bersihkan-mesin',
                'instruction' => 'Bersihkan mesin menggunakan majun / tisue',
                'standard' => 'Mesin bersih dari kotoran & debu',
                'time' => '120',
                'frequency' => '1',
            ],
            [
                'group_id' => 9,
                'slug' => 'valve',
                'instruction' => 'Buka valve pada bagian bawah filter',
                'standard' => 'Air pada tabung filter kosong',
                'time' => '60',
                'frequency' => '2',
            ],
        ];

        foreach ($inspections as $inspection) {
            MachineItem::create($inspection);
        }
    }
}
