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
                'name' => 'Aryo Obeng',
                'dept' => 'EHS',
                'sect' => 'Non BaaN',
                'golongan' => '4',
                'acting' => '1',
                'approval' => '1',
                'password' => '123',
            ],
            [
                'npk' => '131313',
                'name' => 'Ujang Kenok',
                'dept' => 'EHS',
                'sect' => 'TES',
                'golongan' => '4',
                'acting' => '2',
                'approval' => '1',
                'password' => '123',
            ],
            [
                'npk' => '141414',
                'name' => 'Rudi Tambun',
                'dept' => 'EHS',
                'sect' => 'TES',
                'golongan' => '3',
                'acting' => '1',
                'approval' => '1',
                'password' => '123',
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
