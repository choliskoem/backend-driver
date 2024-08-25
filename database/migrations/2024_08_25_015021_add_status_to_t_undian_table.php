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
        Schema::table('t_undian', function (Blueprint $table) {
            $table->boolean('status')->default(false); // False berarti belum keluar, true berarti sudah keluar
        });
    }

    public function down()
    {
        Schema::table('t_undian', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
