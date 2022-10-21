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
        Schema::create('saldo_users', function (Blueprint $table) {
            $table->id();
            $table->string('id_user')->nullable();
            $table->string('saldo_active')->nullable();
            $table->string('saldo_tertahan')->nullable();
            $table->string('total_wd')->nullable();
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
        Schema::dropIfExists('saldo_users');
    }
};
