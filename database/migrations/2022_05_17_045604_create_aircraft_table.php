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
        Schema::create('aircraft', function (Blueprint $table) {
            $table->id('ID');
            $table->string('AIRCRAFT_REGISTRATION')->unique();
            $table->string('AIRCRAFT_TYPE');
            $table->string('OPERATOR');
            $table->datetime('DATE_AIRCRAFT_IN');
            $table->datetime('DATE_AIRCRAFT_OUT')->nullable();
            $table->string('RKSP')->nullable();
            $table->string('FLIGHT_ROUTE')->nullable();
            $table->string('CREWS')->nullable();
            $table->string('REPORT')->nullable();
            $table->bigInteger('ID_BARANG')->nullable();
            $table->bigInteger('ID_HEADER')->nullable();
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
        Schema::dropIfExists('aircraft');
    }
};