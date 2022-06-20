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
        Schema::create('hoarding_times', function (Blueprint $table) {
            $table->id();
            $table->string('bc_16_code');
            $table->date('registration_date');
            $table->string('registration_number');
            $table->string('submission_number');
            $table->date('date_of_filing');
            $table->string('item_code');
            $table->string('item_name');
            $table->string('unit');
            $table->integer('total');
            $table->string('status');

            // Other
            $table->integer('beginning_balance')->nullable();
            $table->string('code_bc_16_in')->nullable();
            $table->string('code_bc_16_out')->nullable();
            $table->string('code_bc_27_in')->nullable();
            $table->string('code_bc_27_out')->nullable();
            $table->string('code_bc_28_in')->nullable();
            $table->string('code_bc_28_out')->nullable();
            $table->string('code_bc_30_in')->nullable();
            $table->string('code_bc_30_out')->nullable();
            $table->string('code_bc_40_in')->nullable();
            $table->string('code_bc_40_out')->nullable();
            $table->string('code_bc_41_in')->nullable();
            $table->string('code_bc_41_out')->nullable();
            $table->integer('adjustment')->nullable();
            $table->integer('book_balance')->nullable();
            $table->integer('inventory_taking')->nullable();
            $table->integer('difference')->nullable();
            $table->date('created_date')->nullable();
            $table->time('created_time')->nullable();
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
        Schema::dropIfExists('hoarding_times');
    }
};
