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
        Schema::create('t_periode', function (Blueprint $table) {
            // $table->id('id_periode');
            $table->string('id_periode')->primary();
            $table->string('periode');
            $table->timestamp('waktu_masuk')->nullable(false)->useCurrent();
            $table->timestamp('waktu_selesai')->nullable(false)->useCurrent();
            $table->decimal('nominal_bayar', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_periode');
    }
};
