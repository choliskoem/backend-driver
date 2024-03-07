<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scandrivers', function (Blueprint $table) {
            $table->uuid('qrcode_id');
            $table->uuid('driver_id');
            $table->timestamp('waktu')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('driver_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scandrivers');
    }
};
