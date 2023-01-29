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
            $table
                ->foreignId('jenis_syarat_id')
                ->after('title')
                ->constrained('jenis_syarat')
                ->onDelete('cascade');
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