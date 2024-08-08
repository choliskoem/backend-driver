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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id_akun')->primary();
            $table->string('name');
            $table->string('username');
            // $table->string('id_type_fb');
            // $table->string('id_type_ig');
            // $table->string('id_level');
            // $table->foreign('id_level')->references('id_level')->on('t_level');
            // $table->foreign('id_type_fb')->references('id_type')->on('t_type');
            // $table->foreign('id_type_ig')->references('id_type')->on('t_type');
            // $table->foreignId('id_type_fb')->constrained('id_type ');
            // $table->foreignId('id_type_ig')->constrained('id_type');
            $table->string('foto_fb');
            $table->string('foto_ig');
            $table->string('status');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
