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
        //role
        //0 = admin
        //1 = siswa
        //2 = petugas / pelatih
        //3 = kepala sekolah dan wali kelas
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('nohp', 12)->nullable();
            $table->string('jenis_kelamin', 15)->nullable();
            $table->string('kelas', 10)->nullable();
            $table->integer('role');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('nomor_induk', 20)->unique();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
