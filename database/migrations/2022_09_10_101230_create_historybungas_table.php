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
        Schema::create('historybungas', function (Blueprint $table) {
            $table->id();
            $table->string('id_user')->nullable();
            $table->string('id_pengajuan')->nullable();
            $table->string('id_realisasi')->nullable();
            $table->string('harike')->nullable();
            $table->string('jumlah')->nullable();
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
        Schema::dropIfExists('historybungas');
    }
};
