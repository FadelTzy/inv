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
        Schema::create('ktps', function (Blueprint $table) {
            $table->id();
            $table->string('id_user')->nullable();
            $table->string('nama')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('jk')->nullable();
            $table->string('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('kel_des')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kabupaten_kota')->nullable();
            $table->string('agama')->nullable();
            $table->string('goldar')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('nik')->nullable();
            $table->string('foto')->nullable();
            $table->string('status_kawin')->nullable();
            $table->string('warganegara')->nullable();
            $table->timestamps();
            $table->string('bank')->nullable();
            $table->string('rekening')->nullable();
            $table->string('kode_referal')->nullable();
            $table->string('kode_referal_orang')->nullable();

            $table->string('status_referal')->nullable()->comment('1 sudah digunakan');
            $table->string('status_bonus')->nullable()->comment('1 belum 2 sudah dibagi');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ktps');
    }
};
