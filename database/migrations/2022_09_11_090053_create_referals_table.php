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
        Schema::create('referals', function (Blueprint $table) {
            $table->id();
            $table->string('id_user')->nullable();
            $table->string('nama_user')->nullable();

            $table->string('id_penerima')->nullable();
            $table->string('nama_penerima')->nullable();

            $table->string('kode_referal')->nullable();
            $table->string('harga')->nullable();
            $table->string('status')->nullable()->comment('1 diterima 2 belum');
            $table->string('urut')->nullable()->comment('1 pertama 2 kedua 3 ketiga');
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
        Schema::dropIfExists('referals');
    }
};
