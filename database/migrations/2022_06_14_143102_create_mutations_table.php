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
        Schema::create('mutations', function (Blueprint $table) {
            $table->id();
            $table->string('item_code')->nullable();
            $table->string('item_name')->nullable();
            $table->string('unit')->nullable();
            $table->string('beginning_balance')->nullable();
            $table->string('in_bc_16')->nullable();
            $table->string('in_bc_40')->nullable();
            $table->string('in_bc_27')->nullable();
            $table->string('out_bc_28')->nullable();
            $table->string('out_bc_41')->nullable();
            $table->string('out_bc_27')->nullable();
            $table->string('adjustment')->nullable();
            $table->string('book_balance')->nullable();
            $table->string('inventory_taking')->nullable();
            $table->string('difference')->nullable();
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
        Schema::dropIfExists('mutations');
    }
};
