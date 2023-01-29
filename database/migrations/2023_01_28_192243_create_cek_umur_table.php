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
        Schema::create('cek_umur', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('min_tahun');
            $table->integer('max_tahun');
            $table->integer('min_bulan');
            $table->integer('max_bulan');
            $table->integer('min_tanggal');
            $table->integer('max_tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cek_umur');
    }
};