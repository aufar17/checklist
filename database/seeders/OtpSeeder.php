<?php

namespace Database\Seeders;

use App\Models\OtpVerification;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OtpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $otp = [
            [
                'id_user' => 1,
                'otp' => rand(100000, 999999),
                'expiry_date' => Carbon::now()->addMinutes(5),
                'send' => 'sent',
                'send_date' => Carbon::now(),
                'use' => false,
                'use_date' => null,
            ],
        ];

        foreach ($otp as $code) {
            OtpVerification::create($code);
        }
    }
}
