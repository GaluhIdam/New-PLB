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
            $table->id();
            $table->string('operator');
            $table->string('reg');
            $table->string('type');
            $table->enum('activity_type', ['delivery', 'redelivery']);
            $table->datetime('actual_time')->nullable();
            $table->string('fight_route')->nullable();
            $table->string('crews')->nullable();
            $table->string('report')->nullable();
            $table->string('rksp')->nullable();
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