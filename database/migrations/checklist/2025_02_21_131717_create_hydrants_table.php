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
        Schema::connection('mysql')->create('hydrants', function (Blueprint $table) {
            $table->id();
            $table->string('no_hydrant');
            $table->string('location');
            $table->string('type');
            $table->json('status');
            $table->json('status_hydrant');
            $table->float('panjang_selang');
            $table->string('jenis_nozle');
            $table->double('longitude');
            $table->double('latitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hydrants');
    }
};
