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
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->foreign('nim')->references('nim')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_lomba');
            $table->string('kode_ekskul');
            $table->foreign('kode_ekskul')->references('kode')->on('data_ekskuls')->onDelete('cascade')->onUpdate('cascade');
            $table->string('prestasi');
            $table->string('nama_pelatih');
            $table->string('id_pelatih');
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
        Schema::dropIfExists('prestasis');
    }
};