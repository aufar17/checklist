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
                'slug' => 'kondisi-panel',
                'instruction' => 'Periksa kondisi panel operasi & kelengkapan',
                'standard' => 'Lengkap,fungsi baik',
            ],
            [
                'group_id' => 2,
                'slug' => 'tombol-emg-stop',
                'instruction' => 'Periksa tombol EMG stop',
                'standard' => 'Kondisi bagus',
            ],
            [
                'group_id' => 3,
                'slug' => 'nagara-switch',
                'instruction' => 'Cek kondisi dan fungsi nagara switch',
                'standard' => 'Berfungsi baik',
            ],
            [
                'group_id' => 4,
                'slug' => 'tekanan-angin',
                'instruction' => 'Periksa tekanan angin (Tulis dengan angka)',
                'standard' => '4-6bar(kg/cm2)/0,4-0,6 Mpa',
            ],
            [
                'group_id' => 5,
                'slug' => 'oli-lubrikasi',
                'instruction' => 'Periksa oli lubrikasi (tambah jika perlu)',
                'standard' => 'Antara batas lower & upper',
            ],
            [
                'group_id' => 6,
                'slug' => 'kebocoran-oli',
                'instruction' => 'Periksa adanya kebocoran oli',
                'standard' => 'Tidak bocor',
            ],
            [
                'group_id' => 7,
                'slug' => 'level-oli-lubrikasi',
                'instruction' => 'Periksa level oli lubrikasi, tambah jika kurang',
                'standard' => 'Terisi/tidak kosong',
            ],
            [
                'group_id' => 8,
                'slug' => 'asu-tekanan-angin',
                'instruction' => 'Periksa tekanan angin (Tulis dengan angka)',
                'standard' => '4-6bar(kg/cm2)/0,4-0,6 Mpa',
            ],
            [
                'group_id' => 8,
                'slug' => 'asu-oli-lubriaksi',
                'instruction' => 'Periksa oli lubrikasi (tambah jika perlu)',
                'standard' => 'Antara batas lower & upper',
            ],
            [
                'group_id' => 9,
                'slug' => 'kebocoran-angin',
                'instruction' => 'Periksa adanya kebocoran angin',
                'standard' => 'Tidak bocor',
            ],
            [
                'group_id' => 10,
                'slug' => 'kebocoran-angin',
                'instruction' => 'Periksa adanya kebocoran angin',
                'standard' => 'Tidak bocor',
            ],
            [
                'group_id' => 11,
                'slug' => 'guide-bash',
                'instruction' => 'Cek Guide Bash upper & lower (digoyang dengan tangan)',
                'standard' => 'Tidak goyang',
            ],
        ];

        foreach ($inspections as $inspection) {
            MachineItem::create($inspection);
        }
    }
}
