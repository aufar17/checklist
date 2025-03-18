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
                'group_id' => 1,
                'slug' => 'kondisi-push-button',
                'instruction' => 'Periksa kondisi push button',
                'standard' => 'Berfungsi, tidak pecah',
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
                'slug' => 'suara-motor',
                'instruction' => 'Periksa suara motor hidrolik',
                'standard' => 'Suara Halus',
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
                'slug' => 'tangki-coolant',
                'instruction' => 'Cek level oli coolant ( tamabah jika perlu )',
                'standard' => 'Antara batas lower & upper',
            ],
            [
                'group_id' => 11,
                'slug' => 'guide-bash',
                'instruction' => 'Cek Guide Bash upper & lower (digoyang dengan tangan)',
                'standard' => 'Tidak goyang',
            ],
            [
                'group_id' => 12,
                'slug' => 'panel-operasi',
                'instruction' => 'Cek kondisi dan fungsi panel operasi',
                'standard' => 'Kondisi baik, berfungsi normal',
            ],
            [
                'group_id' => 13,
                'slug' => 'panel-kontrol',
                'instruction' => 'Pastikan pintu panel tertutup rapat',
                'standard' => 'Tertutup rapat',
            ],
            [
                'group_id' => 14,
                'slug' => 'pendant-robot',
                'instruction' => 'Cek kondisi pendant robot',
                'standard' => 'Pendant berfungsi normal',
            ],
            [
                'group_id' => 15,
                'slug' => 'sliding-robot',
                'instruction' => 'Cek gerakan slidding robot',
                'standard' => 'Smoth, tidak seret',
            ],
            [
                'group_id' => 16,
                'slug' => 'cyl-clamp',
                'instruction' => 'Cek kebocoran angin pada cyl clamp',
                'standard' => 'Tidak bocor,gerakan smoth',
            ],
            [
                'group_id' => 17,
                'slug' => 'root-arm',
                'instruction' => 'Cek kebersihan Arm robot',
                'standard' => 'Bersih dari gram dan chip',
            ],
            [
                'group_id' => 18,
                'slug' => 'safety-plug',
                'instruction' => 'Periksa kondisi safety plug/alamr jika plug dibuka',
                'standard' => 'Berfungsi baik',
            ],
            [
                'group_id' => 19,
                'slug' => 'safety-sensor',
                'instruction' => 'Periksa fungsi safety sensor',
                'standard' => 'Mesin stop saat tangan masuk',
            ],
            [
                'group_id' => 20,
                'slug' => 'nozzle-cleaning',
                'instruction' => 'Periksa kelurusan Nozzle dengan bolt O/Tube',
                'standard' => 'Nozzle lurus dengan Bolt O/Tube',
            ],
            [
                'group_id' => 21,
                'slug' => 'mist-collector',
                'instruction' => 'Periksa kondisi mist collector',
                'standard' => 'Berfungsi baik',
            ],
            [
                'group_id' => 22,
                'slug' => 'kebocoran-pompa',
                'instruction' => 'Periksa kebocoran pompa',
                'standard' => 'Tidak bocor',
            ],
            [
                'group_id' => 23,
                'slug' => 'kebocoran-air',
                'instruction' => 'Periksa kebocoran air',
                'standard' => 'Tidak bocor',
            ],

        ];

        foreach ($inspections as $inspection) {
            MachineItem::create($inspection);
        }
    }
}
