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
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_app')->nullable();
            $table->string('nama')->nullable();
            $table->string('groupwa')->nullable();
            $table->string('versi_app')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_app')->nullable();
            $table->string('alamat')->nullable();
            $table->string('wa')->nullable();
            $table->string('email')->nullable();
            $table->string('ig')->nullable();
            $table->string('twitter')->nullable();
            $table->string('nomor')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('persenan')->nullable();
            $table->string('biayaadmin')->nullable();
            $table->string('minimal')->nullable();
            $table->string('level1')->nullable();
            $table->string('level2')->nullable();
            $table->string('level3')->nullable();
            $table->string('investor')->nullable();
            $table->string('bonusperhari')->nullable();

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
        Schema::dropIfExists('pengaturans');
    }
};
