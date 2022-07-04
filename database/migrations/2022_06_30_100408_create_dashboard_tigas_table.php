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
        Schema::create('dashboard_tigas', function (Blueprint $table) {
            $table->id();
            $table->date('bulan')->nullable();
            $table->integer('total_bc28')->nullable();
            $table->bigInteger('payment_value_bc28')->nullable();
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
        Schema::dropIfExists('dashboard_tigas');
    }
};
