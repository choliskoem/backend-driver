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
        Schema::create('t_point', function (Blueprint $table) {
            $table->string('kd_karyawan');
            $table->foreign('kd_karyawan')->references('id_akun')->on('users');
            $table->string('kd_pembelian');
            $table->foreign('kd_pembelian')->references('kd_pembelian')->on('t_pembelian');
            $table->timestamp('waktu');
            $table->integer('point');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_point');
    }
};
