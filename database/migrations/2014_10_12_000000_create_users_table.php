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
            $table->string('alamat');
            $table->string('nohp')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('kelas')->nullable();
            $table->integer('role');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('nim')->unique();
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
