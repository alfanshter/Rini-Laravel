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
            $table->string('kode_pelatih');
            $table->string('nama_pelatih');
            $table->string('id_data_ekskul');
            $table->foreign('id_data_ekskul')->references('kode')->on('data_ekskuls')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_ekskul');
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_siswa');
            $table->string('tahun_ajaran', 25);
            $table->string('semester', 7);
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
