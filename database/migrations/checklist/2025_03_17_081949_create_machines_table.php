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
        Schema::connection('mysql')->create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('no_machine')->unique();
            $table->string('name');
            $table->string('line');
            $table->string('maker');
            $table->integer('no_fixed_asset');
            $table->json('status');
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
        Schema::dropIfExists('machines');
    }
};
