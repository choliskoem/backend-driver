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
        Schema::create('t_pembelian', function (Blueprint $table) {
            $table->string('kd_pembelian')->primary();
            $table->string('id_periode');
            $table->foreign('id_periode')->references('id_periode')->on('t_periode');
            $table->string('id_akun');
            $table->foreign('id_akun')->references('id_akun')->on('users');
            $table->timestamp('waktu');
            $table->decimal('nominal_belanja', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pembelian');
    }
};
