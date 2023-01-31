<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cek_umur', function (Blueprint $table) {
            $table->integer('tahun_sekarang')->nullable();
            $table->integer('bulan_sekarang')->nullable();
            $table->integer('tanggal_sekarang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cek_umur', function (Blueprint $table) {
            //
        });
    }
};