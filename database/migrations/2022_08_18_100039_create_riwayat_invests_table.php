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
        Schema::create('riwayat_invests', function (Blueprint $table) {
            $table->id();
            $table->string('id_user')->nullable();
            $table->string('id_pengajuan')->nullable();
            $table->string('jumlah_depo')->nullable();
            $table->string('status')->nullable()->comment('1 disetujui 2 ditolak');
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
        Schema::dropIfExists('riwayat_invests');
    }
};
