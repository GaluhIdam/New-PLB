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
        Schema::create('scraps', function (Blueprint $table) {
            $table->id();
            $table->string('material_document_code_gr'); // Nomor Dokumen GR
            $table->string('material_document_item_gr'); // Nomor Item GR
            $table->string('follow_up_document_code'); // Nomor Dokumen Follow Up
            $table->string('subsequent_document_code'); // Nomor Dokumen Subsequent
            $table->string('inbound_number'); // Nomor Inbound
            $table->date('posting_date_gr'); // Tanggal Posting GR
            $table->time('posting_time_gr'); // Jam Posting GR
            $table->string('purchase_order_gr'); // Nomor PO GR
            $table->string('purchase_order_type'); // Tipe PO
            $table->string('purchase_document_item'); // Nomor Item PO
            $table->string('billing_lading_101'); // Nomor Lading 101
            $table->string('billing_of_lading'); // Nomor Lading
            $table->string('vendor_code'); // Kode Vendor
            $table->string('vendor_name'); // Nama Vendor
            $table->string('vendor_country'); // Negara Vendor
            $table->string('for_tr_data_number'); // Nomor Data TR
            $table->string('prel_document_number'); // Nomor Dokumen Preliminary
            $table->date('date_prel_document'); // Tanggal Dokumen Preliminary
            $table->string('invoice_number'); // Nomor Invoice
            $table->date('invoice_date'); // Tanggal Invoice
            $table->string('movement_type'); // Tipe Movement
            $table->text('movement_type_description')->nullable(); // Deskripsi Tipe Movement
            $table->string('user_code')->nullable(); // Kode User
            $table->enum('type', ['OUTBOUND', 'REVERSAL', 'INBOUND'])->nullable(); // Tipe
            $table->string('material_document')->nullable(); // Document Material (Material Doc.)
            $table->string('material_item')->nullable(); // Nomor Item Material (Item)
            $table->string('material_code')->nullable(); // Kode Material (Material)
            $table->text('material_description')->nullable(); // Deskripsi Material (Description)
            $table->string('batch_number')->nullable(); // Nomor Batch
            $table->string('plant_code')->nullable(); // Kode Plant
            $table->string('storage_location')->nullable(); // Lokasi Penyimpanan
            $table->text('revision_description')->nullable(); // Deskripsi Revisi
            $table->string('function_location_revision')->nullable(); // Nomor Revisi Lokasi Fungsi
            $table->string('assembly')->nullable(); // Assembling
            $table->string('wbs_element')->nullable(); // WBS Element
            $table->text('wbs_description')->nullable(); // Deskripsi WBS
            $table->string('function_location_order')->nullable(); // Nomor Order Lokasi Fungsi
            $table->string('aircraft_registration_fix')->nullable(); // Registrasi Aircraft Fix
            $table->string('costumer_moveement')->nullable(); // Customer Movement
            $table->string('costumer_order')->nullable(); // Customer Order
            $table->string('costumer_name')->nullable(); // Nama Customer
            $table->string('costumer_country')->nullable(); // Negara Customer
            $table->string('costumer_fix')->nullable(); // Customer Fix
            $table->string('costumer_name_fix')->nullable(); // Nama Customer Fix
            $table->string('costumer_country_fix')->nullable(); // Negara Customer Fix
            $table->string('order_movement')->nullable(); // Order Movement
            $table->string('order_number')->nullable(); // Nomor Order
            $table->text('order_description')->nullable(); // Deskripsi Order
            $table->string('amount_in_local_currency')->nullable(); // Jumlah Local Currency
            $table->string('currency')->nullable(); // Mata Uang
            $table->date('posting_date')->nullable(); // Tanggal Pembuatan
            $table->date('created_date')->nullable(); // Tanggal Pembuatan
            $table->time('created_time')->nullable(); // Jam Pembuatan
            $table->enum('type_bc', ['BC28', 'BC30', 'EX27'])->nullable(); // Jenis BC
            $table->string('download_form')->nullable(); // Form Download
            $table->string('recepient')->nullable(); // Penerima
            $table->string('delivery')->nullable(); // Delivery
            $table->string('submission_number')->nullable(); // Nomor Aju
            $table->date('submission_date')->nullable(); // Tanggal Aju
            $table->date('registration_date')->nullable(); // Tanggal Registrasi
            $table->string('registration_number')->nullable(); // Nomor Registrasi
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
        Schema::dropIfExists('scraps');
    }
};