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
            $table->string('reg')->unique();
            $table->string('type')->unique();
            $table->enum('activity_type', ['delivery', 'redelivery']);
            $table->dateTime('ata')->nullable();
            $table->dateTime('atd')->nullable();    
            $table->string('fight_route')->nullable();
            $table->string('crews')->nullable();
            $table->string('report')->nullable();
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