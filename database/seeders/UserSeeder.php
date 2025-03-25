<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'npk' => '121212',
                'name' => 'Aufar Manager',
                'dept' => 'EHS',
                'sect' => 'Non BaaN',
                'golongan' => '4',
                'acting' => '1',
                'password' => '123',
            ],
            [
                'npk' => '131313',
                'name' => 'Aufar SPV',
                'dept' => 'EHS',
                'sect' => 'TES',
                'golongan' => '4',
                'acting' => '2',
                'password' => '123',
            ],
            [
                'npk' => '141414',
                'name' => 'Aufar PIC',
                'dept' => 'EHS',
                'sect' => 'TES',
                'golongan' => '3',
                'acting' => '1',
                'password' => '123',
            ],
            [
                'npk' => '020202',
                'name' => 'Aufar Foreman',
                'dept' => 'PE-2W',
                'sect' => 'Non BaaN',
                'golongan' => '4',
                'acting' => '1',
                'password' => '123',
            ],
            [
                'npk' => '030303',
                'name' => 'Line Guide',
                'dept' => 'PE-2W',
                'sect' => 'TES',
                'golongan' => '4',
                'acting' => '2',
                'password' => '123',
            ],
            [
                'npk' => '040404',
                'name' => 'Aufar PIC',
                'dept' => 'PE-2W',
                'sect' => 'TES',
                'golongan' => '3',
                'acting' => '1',
                'password' => '123',
            ],
            [
                'npk' => '050505',
                'name' => 'Aufar Operator',
                'dept' => 'PE-2W',
                'sect' => 'TES',
                'golongan' => '2',
                'acting' => '1',
                'password' => '123',
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
