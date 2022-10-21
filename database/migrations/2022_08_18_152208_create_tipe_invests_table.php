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
        Schema::create('tipe_invests', function (Blueprint $table) {
            $table->id();
            $table->string('paket')->nullable();
            $table->string('investasi')->nullable();
            $table->string('persenanhari')->nullable();
            $table->string('lamapenarikanbunga')->nullable();
            $table->string('bungaperhari')->nullable();
            $table->string('total')->nullable();
            $table->string('lamapenarikan')->nullable();
            $table->string('periode')->nullable()->comment('1 hari 2 bulan 3 tahun 4 semester 5 minggu');
            $table->string('persenadmin')->nullable();
            $table->string('biayaadmin')->nullable();
            $table->string('biayawd')->nullable();
            $table->string('status')->nullable()->comment('1 limited 2 unlimited');
            $table->string('limit')->nullable();
            $table->string('status_user')->nullable()->comment('1 limited 2 unlimited');
            $table->string('limit_user')->nullable();
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
        Schema::dropIfExists('tipe_invests');
    }
};
