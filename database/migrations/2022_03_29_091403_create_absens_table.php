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
        Schema::create('absens', function (Blueprint $table) {
            $table->id();
            $table->integer('absen')->default(0);
            $table->string('id_pelatih');
            $table->string('nama_pelatih');
            $table->string('id_ekskul');
            $table->string('nama_ekskul');
            $table->string('id_siswa');
            $table->string('nama_siswa');
            $table->string('tahun_ajaran');
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
        Schema::dropIfExists('absens');
    }
};