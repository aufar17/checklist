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
        Schema::connection('mysql')->create('machine_items', function (Blueprint $table) {
            $table->id();
            $table->string('group_id');
            $table->string('slug');
            $table->string('instruction');
            $table->string('standard');
            $table->integer('time');
            $table->integer('frequency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machine-items');
    }
};
