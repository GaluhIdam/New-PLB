<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scrap extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_document_code_gr', // Nomor Dokumen GR
        'material_document_item_gr', // Nomor Item GR
        'follow_up_document_code', // Nomor Dokumen Follow Up
        'subsequent_document_code', // Nomor Dokumen Subsequent
        'inbound_number', // Nomor Inbound
        'posting_date_gr', // Tanggal Posting GR
        'posting_time_gr', // Jam Posting GR
        'purchase_order_gr', // Nomor PO GR
        'purchase_order_type', // Tipe PO
        'purchase_document_item', // Nomor Item PO
        'billing_lading_101', // Nomor Lading 101
        'billing_of_lading', // Nomor Lading
        'vendor_code', // Kode Vendor
        'vendor_name', // Nama Vendor
        'vendor_country', // Negara Vendor
        'for_tr_data_number', // Nomor Data TR
        'prel_document_number', // Nomor Dokumen Preliminary
        'date_prel_document', // Tanggal Dokumen Preliminary
        'invoice_number', // Nomor Invoice
        'invoice_date', // Tanggal Invoice
        'movement_type', // Tipe Movement
        'movement_type_description', // Deskripsi Tipe Movement
        'user_code', // Kode User
        'type', // Tipe
        'material_document', // Kode Material (Material Doc.)
        'material_item', // Nomor Item Material (Item)
        'material_code', // Nama Material (Material)
        'material_description', // Deskripsi Material (Description)
        'batch_number', // Nomor Batch
        'plant_code', // Kode Plant
        'storage_location', // Lokasi Penyimpanan
        'purchase_order_out', // Nomor PO Outbound
        'purchase_order_item_out', // Nomor Item PO Outbound
        'equipment_order', // Nomor Equipment Order
        'equipment_function_location', // Lokasi Fungsi Equipment
        'system_status_1', // Status System 1
        'user_status_1', // Status User 1
        'equipment_revision', // Revision Equipment
        'system_status_2', // Status System 2
        'user_status_2', // Status User 2
        'revision_number', // Nomor Revisi
        'revision_description', // Deskripsi Revisi
        'function_location_extension_aircraft', // Lokasi Fungsi Ekstensi Aircraft
        'function_location_revision', // Nomor Revisi Lokasi Fungsi
        'ats_date', // Tanggal ATS
        'assembly', // Assembling
        'wbs_element', // WBS Element
        'wbs_description', // Deskripsi WBS
        'function_location_order', // Nomor Order Lokasi Fungsi
        'aircraft_registration_fix', // Registrasi Aircraft Fix
        'costumer_moveement', // Customer Movement
        'costumer_order', // Customer Order
        'costumer_name', // Nama Customer
        'costumer_country', // Negara Customer
        'costumer_fix', // Customer Fix
        'costumer_name_fix', // Nama Customer Fix
        'costumer_country_fix', // Negara Customer Fix
        'order_movement', // Order Movement
        'order_number', // Nomor Order
        'order_description', // Deskripsi Order
        'system_status_5', // Status System 5
        'teco_date', // Tanggal Teco
        'teco_time', // Jam Teco
        'teco_name', // Nama Teco
        'object_number', // Nomor Objek
        'partner', // Partner
        'sales_order', // Nomor Sales Order
        'costumer_center', // Customer Center
        'reference', // Referensi
        'recepient', // Penerima
        'posting_date', // Tanggal Posting
        'eun_quantity', // Quantity EUN
        'eun_unit', // Unit EUN
        'bun_quantity', // Quantity BUN
        'bun_unit', // Unit BUN
        'amount_in_local_currency', // Jumlah Local Currency
        'currency', // Mata Uang
        'created_date', // Tanggal Pembuatan
        'created_time', // Jam Pembuatan
        'type_bc', // Tipe BC
        'download_form', // Form Download
        'delivery', // Delivery
        'submission_number', // Nomor Aju
        'submission_date', // Tanggal Aju
        'registration_date', // Tanggal Registrasi
        'registration_number', // Nomor Registrasi
    ];
}