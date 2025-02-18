<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtpVerification extends Model
{
    protected $table = 'otp_verification';
    protected $fillable = [
        'id_user',
        'phone_number',
        'otp',
        'expiry_date',
        'send',
        'send_date',
        'use',
        'use_date',
    ];
}
