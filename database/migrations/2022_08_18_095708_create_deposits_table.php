<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->string('id_user')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('kode')->nullable();
            $table->string('buktitransfer')->nullable();
            $table->string('id_penerima')->nullable();
            $table->string('id_rekening')->nullable();

            $table->string('status_masuk')->nullable()->comment('0 proses 1 selesai');
            $table->string('status')->nullable()->comment('1 waiting 2 diterima 3 ditolak');
            $table->string('tanggal_verif')->nullable();
            $table->string('tanggal_aju_depo')->nullable();

            $table->string('jenis')->nullable()->comment('1 deposit 2 wd');
            $table->string('buktiwd')->nullable()->comment('0 proses 1 selesai');
            $table->string('tanggal_wd')->nullable()->comment('0 proses 1 selesai');
            $table->string('tanggal_aju_wd')->nullable();
            $table->string('biayaadmin')->nullable();
            $table->string('total')->nullable();

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
        Schema::dropIfExists('deposits');
    }
};
