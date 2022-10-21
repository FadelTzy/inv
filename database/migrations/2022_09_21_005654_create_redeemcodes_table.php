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
        Schema::create('redeemcodes', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->string('kode')->nullable();
            $table->string('start')->nullable();
            $table->string('expayer')->nullable();
            $table->string('nominal')->nullable();
            $table->string('peserta')->nullable();
            $table->string('status')->nullable()->comment('1 aktif 2 full 3 aktif');
            $table->string('jenis')->nullable()->comment('1 public 2 private');

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
        Schema::dropIfExists('redeemcodes');
    }
};
