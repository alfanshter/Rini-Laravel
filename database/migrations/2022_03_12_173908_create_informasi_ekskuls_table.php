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
        Schema::create('informasi_ekskuls', function (Blueprint $table) {
            $table->id();
            $table->string('id_data_ekskul')->unique();
            $table->foreign('id_data_ekskul')->references('kode')->on('data_ekskuls')->onDelete('cascade')->onUpdate('cascade');
            $table->string('jadwal', 11);
            $table->time('jam');
            $table->string('tempat_ekskul',20);
            $table->string('kode_pelatih')->unique();
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
        Schema::dropIfExists('informasi_ekskuls');
    }
};
