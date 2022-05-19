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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('hari', 10);
            $table->string('tahun_ajaran', 25);
            $table->string('semester', 7);
            $table->string('nama_materi');
            $table->string('nama_ekskul');
            $table->string('kode_pelatih');
            $table->foreign('kode_pelatih')->references('nomor_induk')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('agendas');
    }
};
