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
        Schema::create('ekskuls', function (Blueprint $table) {
            // is status = 0 belum daftar
            // is status = 1 seleksi
            // is status = 2 diterima
            // is status = 3 ditolak
            $table->id();
            $table->string('nim_siswa');
            $table->foreign('nim_siswa')->references('nim')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kode_ekskul');
            $table->foreign('kode_ekskul')->references('kode')->on('data_ekskuls')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kode_pelatih');
            $table->foreign('kode_pelatih')->references('nim')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_informasi');
            $table->foreign('id_informasi')->references('id')->on('informasi_ekskuls')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('is_status')->default(0);
            $table->string('alasan');
            $table->string('prestasi_pernah_diraih')->nullable();
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
        Schema::dropIfExists('ekskuls');
    }
};