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
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kode_ekskul');
            $table->foreign('kode_ekskul')->references('kode')->on('data_ekskuls')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_ekskul');
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
        Schema::dropIfExists('absen_pelatihs');
    }
};
