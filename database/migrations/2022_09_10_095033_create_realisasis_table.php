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
        Schema::create('realisasis', function (Blueprint $table) {
            $table->id();
            $table->string('id_user')->nullable();
            $table->string('id_pengajuan')->nullable();
            $table->string('tanggal_berlaku')->nullable();
            $table->string('tanggal_akhir')->nullable();
            $table->string('lamahari')->nullable();
            $table->string('harike')->nullable();
            $table->string('lamapenarikanbunga')->nullable();
            $table->string('penarikanbungake')->nullable();
            $table->string('totalpenarikanbunga')->nullable();
            $table->string('investasi')->nullable();
            $table->string('persenbunga')->nullable();
            $table->string('tanggalautowd')->nullable();
            $table->string('bungatertunda')->nullable();
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
        Schema::dropIfExists('realisasis');
    }
};
