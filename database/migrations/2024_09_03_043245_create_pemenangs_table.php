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
        Schema::create('t_pemenang', function (Blueprint $table) {
            $table->id();
            $table->uuid('id_akun');
            $table->string('kd_pembelian');
            $table->foreign('id_akun')->references('id_akun')->on('users')->onDelete('cascade');
            $table->foreign('kd_pembelian')->references('kd_pembelian')->on('t_pembelian')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pemenang');
    }
};
