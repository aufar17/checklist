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
        Schema::connection('mysql')->create('inspection_hydrants', function (Blueprint $table) {
            $table->id();
            $table->string('hydrant_id');
            $table->string('inspection_id');
            $table->date('inspection_date');
            $table->string('documentation')->nullable();
            $table->integer('values');
            $table->text('notes')->nullable();
            $table->string('known_by')->nullable();
            $table->string('checked_by')->nullable();
            $table->string('created_by');
            $table->date('known_date')->nullable();
            $table->date('checked_date')->nullable();
            $table->date('created_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection__hydrants');
    }
};
