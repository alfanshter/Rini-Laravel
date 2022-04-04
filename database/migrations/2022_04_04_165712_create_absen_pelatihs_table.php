<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //absen
        // 0 == belum absen
        // 1 = sudah abse
        // 2 = tidak absen
        // 3 = ijin
        // 4 = sakit
        Schema::create('absen_pelatihs', function (Blueprint $table) {
            $table->id();
            $table->integer('absen')->default(0);
            $table->string('user_id');
            $table->string('id_ekskul');
            $table->string('nama_ekskul');
            $table->string('tahun_ajaran');
            $table->string('bulan');
            $table->string('semester');
            $table->date('tanggal');
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
        Schema::dropIfExists('absen_pelatihs');
    }
};