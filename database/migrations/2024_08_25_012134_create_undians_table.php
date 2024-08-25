<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('t_undian', function (Blueprint $table) {
            $table->uuid('kd_undian')->primary();
            $table->string('id_akun');
            $table->foreign('id_akun')->references('id_akun')->on('users');
            $table->string('kd_pembelian');
            $table->foreign('kd_pembelian')->references('kd_pembelian')->on('t_pembelian');
            $table->integer('nomor_undian')->unique();
            // $table->uuid('kd_pembelian');
            $table->timestamp('waktu');
            $table->timestamps();

            // Foreign key constraints
            // $table->foreign('id_akun')->references('id_akun')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_undian');
    }
};
