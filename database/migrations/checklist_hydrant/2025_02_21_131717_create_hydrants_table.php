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
        Schema::create('hydrants', function (Blueprint $table) {
            $table->id();
            $table->string('no_hydrant');
            $table->string('location');
            $table->string('type');
            $table->bigInteger('longitude');
            $table->bigInteger('latitude');
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
