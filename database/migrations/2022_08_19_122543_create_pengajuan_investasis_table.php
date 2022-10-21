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
        Schema::create('pengajuan_investasis', function (Blueprint $table) {
            $table->id();
            $table->string('id_user')->nullable();
            $table->string('nama')->nullable();

            $table->string('investasi')->nullable();
            $table->string('kode')->nullable();
            $table->string('buktitransfer')->nullable();
            $table->string('id_penerima')->nullable();

            $table->string('bungaharian')->nullable();
            $table->string('rupiahbungaharian')->nullable();
            $table->string('penarikanbunga')->nullable();
            $table->string('penarikaninvestasi')->nullable();
            $table->string('total_bonus')->nullable();
            $table->string('total_untung')->nullable();
            $table->string('tipe_investasi')->nullable();
            $table->string('biayawd')->nullable();
            $table->string('biayaadmin')->nullable();
            $table->string('status_pengajuan')->nullable()->comment('1 menunggu pembayaran 2 pengajuan/pelunasan 3 disetjui 4 ditolak 5 dibatalkan');
            $table->string('status_investasi')->nullable()->comment('0 proses 1 berjalan 2 selesai');
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
        Schema::dropIfExists('pengajuan_investasis');
    }
};
