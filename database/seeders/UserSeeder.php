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
                'name' => 'Aufar Chill Guy',
                'dept' => 'MIS',
                'sect' => 'Non BaaN',
                'golongan' => '4',
                'acting' => '1',
                'approval' => '1',
                'password' => '123',
            ],
            [
                'npk' => '131313',
                'name' => 'Aufar Crud',
                'dept' => 'HRD',
                'sect' => 'TES',
                'golongan' => '4',
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
