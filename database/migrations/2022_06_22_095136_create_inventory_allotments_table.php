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
        Schema::create('inventory_allotments', function (Blueprint $table) {
            $table->id();
            $table->string('part_number')->nullable();
            $table->string('from_plant')->nullable();
            $table->string('to_plant')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('unit_code')->nullable();
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
        Schema::dropIfExists('inventory_allotments');
    }
};
