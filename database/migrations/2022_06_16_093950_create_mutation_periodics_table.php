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
        Schema::create('mutation_periodics', function (Blueprint $table) {
            $table->id();
            $table->date('registration_date'); // Tanggal Registrasi
            $table->string('registration_number'); // Nomor Registrasi
            $table->string('submission_number'); // Nomor Aju
            $table->date('submission_date'); // Tanggal Aju
            $table->string('item_code'); // Kode Barang
            $table->string('item_name'); // Nama Barang
            $table->string('unit')->nullable(); // Satuan
            $table->integer('total')->nullable(); // Total
            $table->string('status')->nullable(); // Status

            // Other
            $table->integer('beginning_balance')->nullable(); // Saldo Awal
            $table->string('code_bc_16_in')->nullable(); // BC 1.6 In
            $table->string('code_bc_16_out')->nullable(); // BC 1.6 Out
            $table->string('code_bc_27_in')->nullable(); // BC 2.7 In
            $table->string('code_bc_27_out')->nullable(); // BC 2.7 Out
            $table->string('code_bc_28_in')->nullable(); // BC 2.8 In
            $table->string('code_bc_28_out')->nullable(); // BC 2.8 Out
            $table->string('code_bc_30_in')->nullable();    // BC 3.0 In
            $table->string('code_bc_30_out')->nullable(); // BC 3.0 Out
            $table->string('code_bc_40_in')->nullable(); // BC 4.0 In
            $table->string('code_bc_40_out')->nullable(); // BC 4.0 Out
            $table->string('code_bc_41_in')->nullable(); // BC 4.1 In
            $table->string('code_bc_41_out')->nullable(); // BC 4.1 Out
            $table->integer('adjustment')->nullable(); // Penyesuaian
            $table->integer('book_balance')->nullable(); // Saldo Akhir
            $table->integer('inventory_taking')->nullable(); // Pemasukan
            $table->integer('difference')->nullable(); // Selisih
            $table->date('created_date')->nullable(); // Tanggal Dibuat
            $table->time('created_time')->nullable(); // Jam Dibuat
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
        Schema::dropIfExists('mutation_periodics');
    }
};
