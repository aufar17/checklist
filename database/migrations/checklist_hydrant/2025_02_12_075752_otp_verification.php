<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('mysql')->create('otp_verification', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('id_user')->unique();
            $table->string('phone_number');
            $table->string('otp');
            $table->string('expiry_date');
            $table->string('send');
            $table->string('send_date')->nullable();
            $table->string('use');
            $table->string('use_date');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
