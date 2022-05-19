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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai');
            $table->string('kode_pelatih');
            $table->foreign('kode_pelatih')->references('nomor_induk')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_pelatih');
            $table->string('kode_ekskul');
            $table->foreign('kode_ekskul')->references('kode')->on('data_ekskuls')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_ekskul');
            $table->string('id_siswa');
            $table->foreign('id_siswa')->references('nomor_induk')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_siswa');
            $table->string('tahun_ajaran', 25);
            $table->string('semester', 7);
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
        Schema::dropIfExists('nilais');
    }
};
