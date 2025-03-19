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
        Schema::connection('mysql')->create('inspection_machines', function (Blueprint $table) {
            $table->id();
            $table->integer('machine_id');
            $table->integer('machine_item_id');
            $table->integer('value');
            $table->string('documentation');
            $table->string('pic_maintenance');
            $table->date('pic_maintenance_date');
            $table->string('line_guide')->nullable();
            $table->date('line_guide_date')->nullable();    
            $table->string('foreman_produksi')->nullable();
            $table->date('foreman_produksi_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_machines');
    }
};
