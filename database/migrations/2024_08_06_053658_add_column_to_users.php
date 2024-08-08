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
        Schema::table('users', function (Blueprint $table) {
              $table->string('id_type_fb');
            $table->string('id_type_ig');
            $table->string('id_level');
            $table->foreign('id_level')->references('id_level')->on('t_level');
            $table->foreign('id_type_fb')->references('id_type')->on('t_type');
            $table->foreign('id_type_ig')->references('id_type')->on('t_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
