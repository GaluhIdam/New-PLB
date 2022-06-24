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
        Schema::create('mutation_calculations', function (Blueprint $table) {
            $table->id();
            $table->string('item_code')->nullable();
            $table->string('item_name')->nullable();
            $table->string('unit')->nullable();
            $table->string('first_balance')->nullable();
            $table->string('income_bc16')->nullable();
            $table->string('income_bc40')->nullable();
            $table->string('income_bc27')->nullable();
            $table->string('cost_bc28')->nullable();
            $table->string('cost_bc41')->nullable();
            $table->string('cost_bc27')->nullable();
            $table->string('cost_bc30')->nullable();
            $table->string('adjustment')->nullable();
            $table->string('book_balance')->nullable();
            $table->string('stock_opname')->nullable();
            $table->string('difference')->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('mutation_calutations');
    }
};
