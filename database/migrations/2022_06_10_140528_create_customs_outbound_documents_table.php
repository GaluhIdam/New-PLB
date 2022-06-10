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
        Schema::create('customs_outbound_documents', function (Blueprint $table) {
            $table->id();
            $table->string('document_type')->nullable();
            $table->string('no_aju')->nullable();
            $table->string('date_aju')->nullable();
            $table->string('no_register')->nullable();
            $table->string('date_register')->nullable();
            $table->string('date_outbound')->nullable();
            $table->string('owner')->nullable();
            $table->string('item_code')->nullable();
            $table->string('hs_code')->nullable();
            $table->string('item_name')->nullable();
            $table->string('quantity')->nullable();
            $table->string('unit')->nullable();
            $table->string('item_value')->nullable();
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('customs_outbound_documents');
    }
};
