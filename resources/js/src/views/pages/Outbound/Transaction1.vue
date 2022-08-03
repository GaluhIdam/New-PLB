<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0">Transaksi Outbound 1</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link to="/dashboard">Dashboard</router-link>
              </li>
              <li class="breadcrumb-item active">
                <router-link to="/outbound-transcation"
                  >Outbound Transaction</router-link
                >
              </li>
              <li class="breadcrumb-item active">
                <span>Transaction 1</span>
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card card-plb">
              <div class="card-header ui-sortable-handle">
                <h5 class="card-title card_title_margin">
                  <i class="nav-icon fa-solid fa-money-bill-transfer"></i>
                  Outbound Transaction 1
                </h5>
                <div class="card-tools">
                  <button
                    type="button"
                    data-card-widget="collapse"
                    class="btn btn-tool"
                  >
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- BEGIN: Card Body -->
              <div class="card-body">
                <!-- BEGIN: Cari Data -->
                <div class="row justify-content-center">
                  <div class="col-md-6">
                    <form @submit.prevent class="form-horizontal">
                      <div class="form-group row mt-4">
                        <label class="col-sm-4 col-form-label"
                          >Tanggal Outbound</label
                        >
                        <div class="col-sm-4">
                          <datepicker
                            input-class="form-control"
                            placeholder="Dari Tanggal"
                            format="MM/dd/yyyy"
                            v-model="filter_start_date"
                            autofocus
                          />
                        </div>
                        <div class="col-sm-4">
                          <datepicker
                            input-class="form-control"
                            placeholder="Sampai Tanggal"
                            format="MM/dd/yyyy"
                            v-model="filter_end_date"
                          />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Customer</label>
                        <div class="col-sm-8">
                          <input
                            type="text"
                            v-model="filter_customer"
                            class="form-control"
                            placeholder="Masukkan Customer"
                          />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label"
                          >Part Number</label
                        >
                        <div class="col-sm-8">
                          <input
                            type="text"
                            v-model="filter_part_number"
                            class="form-control"
                            placeholder="Masukkan Part Number"
                          />
                        </div>
                      </div>
                      <div class="form-group row" id="dokumenList">
                        <label class="col-sm-4 col-form-label"
                          >Jenis Dokumen</label
                        >
                        <div class="col-sm-2">
                          <label class="control-label" style="margin-top: 5px">
                            <input
                              type="checkbox"
                              name="jenis_dokumen[]"
                              id="jenis_dokumen"
                              checked="checked"
                              value="27"
                            />
                            27
                          </label>
                        </div>
                        <div class="col-sm-2">
                          <label class="control-label" style="margin-top: 5px">
                            <input
                              type="checkbox"
                              name="jenis_dokumen[]"
                              id="jenis_dokumen"
                              checked="checked"
                              value="28"
                            />
                            28
                          </label>
                        </div>
                        <div class="col-sm-2">
                          <label class="control-label" style="margin-top: 5px">
                            <input
                              type="checkbox"
                              name="jenis_dokumen[]"
                              id="jenis_dokumen"
                              checked="checked"
                              value="30"
                            />
                            30
                          </label>
                        </div>
                        <div class="col-sm-2">
                          <label class="control-label" style="margin-top: 5px">
                            <input
                              type="checkbox"
                              name="jenis_dokumen[]"
                              id="jenis_dokumen"
                              checked="checked"
                              value="41"
                            />
                            41
                          </label>
                        </div>
                      </div>
                      <div class="form-group row justify-content-center">
                        <div class="col-sm-4">
                          <button class="btn btn-primary" @click="filterButton">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Filter
                          </button>
                          <button class="btn btn-secondary" @click="clearForm">
                            <i class="fa-solid fa-rotate"></i> Reset
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- END: Cari Data -->
                <hr v-if="filter_clicked" />

                <!-- BEGIN: Tampil Data -->
                <div class="form-group mt-4" v-if="filter_clicked">
                  <!-- <div class="form-group mt-4"> -->
                  <div class="vgt-wrap polar-bear">
                    <div class="vgt-inner-wrap">
                      <!-- BEGIN: Global Search -->
                      <div class="vgt-global-search vgt-clearfix">
                        <div class="vgt-global-search__input vgt-pull-left">
                          <label>
                            <span aria-hidden="true" class="input__icon">
                              <div class="magnifying-glass"></div>
                            </span>
                            <span class="sr-only"> Search </span>
                          </label>
                          <input
                            type="text"
                            placeholder="Search Data"
                            class="vgt-input vgt-pull-left"
                            v-model="search"
                          />
                        </div>
                        <!-- BEGIN: Right Button -->
                        <div class="vgt-global-search__actions vgt-pull-right">
                          <div>
                            <button class="btn btn-secondary ms-auto rounded-1">
                              <i class="fa-solid fa-file-csv"></i>
                              CSV
                            </button>
                            <button class="btn btn-secondary ms-auto rounded-1">
                              <i class="fa-solid fa-file-excel"></i>
                              Excel
                            </button>
                            <button
                              class="btn btn-secondary ms-auto rounded-1"
                              style="margin-right: 10px"
                            >
                              <i class="fa-solid fa-file-pdf"></i>
                              PDF
                            </button>
                          </div>
                        </div>
                        <!-- END: Right Button -->
                      </div>
                      <!-- END: Global Search -->

                      <!-- BEGIN: Table -->
                      <div class="vgt-responsive">
                        <table
                          id="vgt-table"
                          class="vgt-table bordered polar-bear"
                        >
                          <!-- BEGIN: Thead -->
                          <thead>
                            <!-- BEGIN: TR Description -->
                            <tr>
                              <!-- BEGIN: Part Number -->
                              <th
                                v-if="order == 'part_number' && by == 'asc'"
                                @click="sort('part_number', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Part Number</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'part_number' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Part Number</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('part_number', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Part Number</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Part Number -->
                              <!-- BEGIN: Description -->
                              <!-- Description -->
                              <th
                                v-if="order == 'description' && by == 'asc'"
                                @click="sort('description', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Description</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'description' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Description</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('description', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Description</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Description -->
                              <!-- BEGIN: Quantity -->
                              <th
                                v-if="order == 'quantity' && by == 'asc'"
                                @click="sort('quantity', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Quantity</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'quantity' && by == 'desc'"
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Quantity</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('quantity', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Quantity</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Quantity -->
                              <!-- BEGIN: Kode Satuan -->
                              <th
                                v-if="order == 'unit_measure' && by == 'asc'"
                                @click="sort('unit_measure', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Kode Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'unit_measure' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Kode Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('unit_measure', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Kode Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Kode Satuan -->
                              <!-- BEGIN: Register Aircraft -->
                              <th
                                v-if="
                                  order == 'register_aircraft' && by == 'asc'
                                "
                                @click="sort('register_aircraft', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Register A/C</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'register_aircraft' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Register A/C</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('register_aircraft', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Register A/C</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Register Aircraft -->

                              <!-- BEGIN: Customer -->
                              <th
                                v-if="order == 'customer' && by == 'asc'"
                                @click="sort('customer', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">customer</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'customer' && by == 'desc'"
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">customer</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('customer', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Customer</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Customer -->
                              <!-- BEGIN: Date Install/Consume -->
                              <th
                                v-if="order == 'date_install' && by == 'asc'"
                                @click="sort('date_install', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Date Install</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'date_install' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Date Install</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('date_install', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Date Install</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Date Install/Consume -->

                              <!-- BEGIN: Date Aircraft IN -->
                              <th
                                v-if="
                                  order == 'date_aircraft_in' && by == 'asc'
                                "
                                @click="sort('date_aircraft_in', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Date A/C In</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'date_aircraft_in' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Date A/C In</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('date_aircraft_in', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Date A/C In</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Date Aircraft IN -->
                            </tr>
                            <!-- END: TR Description-->
                            <!-- BEGIN: TR Filter -->
                            <tr>
                              <!-- BEGIN: Filter Part Number -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Part Number"
                                    v-model="search_part_number"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter Part Number -->
                              <!-- BEGIN: Filter Description -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Description"
                                    v-model="search_description"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter Description -->
                              <!-- BEGIN: Filter Quantity -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Quantity"
                                    v-model="search_quantity"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter Quantity -->
                              <!-- BEGIN: Filter Kode Satuan -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Kode Satuan"
                                    v-model="search_unit_measure"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter Kode Satuan -->
                              <!-- BEGIN: Filter Register Aircraft -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Register A/C"
                                    v-model="search_register_aircraft"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter Register Aircraft -->
                              <!-- BEGIN: Filter Customer -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Customer"
                                    v-model="search_customer"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter Customer -->
                              <!-- BEGIN: Filter Date Install -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Date Install"
                                    v-model="search_date_install"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter Date Install -->
                              <!-- BEGIN: Filter Date Aircraft IN -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Date A/C In"
                                    v-model="search_date_aircraft_in"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter Date Aircraft IN -->
                            </tr>
                            <!-- END: TR Filter -->
                          </thead>
                          <!-- END: Thead -->

                          <!-- BEGIN: Tbody -->
                          <tbody>
                            <tr
                              v-for="(
                                outbound, outbound_index
                              ) in outbounds.data"
                              :key="outbound_index"
                            >
                              <td class="table_content text-center">
                                {{ outbound.part_number }}
                              </td>
                              <td class="table_content text-center">
                                {{ outbound.description }}
                              </td>
                              <td class="table_content text-center">
                                {{ outbound.quantity }}
                              </td>
                              <td class="table_content text-center">
                                {{ outbound.unit_measure }}
                              </td>
                              <td class="table_content text-center">
                                {{ outbound.register_aircraft }}
                              </td>
                              <td class="table_content text-center">
                                {{ outbound.customer }}
                              </td>
                              <td class="table_content text-center">
                                {{ outbound.date_install | myDate }}
                              </td>
                              <td class="table_content text-center">
                                {{ outbound.date_aircraft_in | myDate }}
                              </td>
                            </tr>
                            <tr v-if="outbounds.data.length < 1">
                              <td colspan="15">
                                <div class="vgt-center-align vgt-text-disabled">
                                  Data not found
                                </div>
                              </td>
                            </tr>
                          </tbody>
                          <!-- END: Tbody -->
                        </table>
                      </div>
                      <!-- END: Table -->
                      <!-- BEGIN: Paginate -->
                      <div class="vgt-wrap__footer vgt-clearfix">
                        <div class="footer__row-count vgt-pull-left">
                          <label
                            class="footer__row-count__label row_per_page_label"
                          >
                            Rows per page:
                          </label>
                          <select
                            class="footer__row-count__select row_per_page_option"
                            v-model="paginate"
                            @change="list()"
                          >
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                          </select>
                        </div>
                        <div class="footer__navigation vgt-pull-right">
                          <button
                            type="button"
                            class="footer__navigation__page-btn"
                            :class="{
                              disabled: !outbounds.prev_page_url,
                            }"
                            @click="
                              outbounds.prev_page_url &&
                                list(outbounds.prev_page_url)
                            "
                            style="margin-right: 0px"
                          >
                            <span
                              aria-hidden="true"
                              class="chevron left"
                            ></span>
                            <span class="paginate_text">Prev</span>
                          </button>
                          <div
                            class="footer__navigation__page-info"
                            style="color: #99a0b2"
                          >
                            <label
                              class="page-info__label"
                              style="margin-bottom: -5px"
                            >
                              <span class="paginate_text">page</span>
                              <input
                                type="text"
                                class="footer__navigation__page-info__current-entry vgt-input"
                                v-model="current_page"
                                @keypress="directPage"
                                style="width: 60px"
                              />
                              <span class="paginate_text">
                                of
                                {{ outbounds.last_page }}
                              </span>
                            </label>
                          </div>
                          <button
                            type="button"
                            class="footer__navigation__page-btn"
                            :class="{
                              disabled: !outbounds.next_page_url,
                            }"
                            @click="
                              outbounds.next_page_url &&
                                list(outbounds.next_page_url)
                            "
                          >
                            <span style="font-weight: 500">Next</span>
                            <span
                              aria-hidden="true"
                              class="chevron right"
                            ></span>
                          </button>
                        </div>
                      </div>
                      <!-- END: Paginate -->
                    </div>
                  </div>
                </div>
                <!-- END: Tampil Data -->
              </div>
              <!-- END: Card Body -->
            </div>
            <!-- END: Card -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import debounce from "lodash/debounce";
import Swal from "sweetalert2";
import moment from "moment";
moment.locale("id");

export default {
  data() {
    return {
      outbounds: {
        data: [],
        links: [],
      },
      // Search Data
      search: null, // Pencarian Data
      customer: null,
      search_part_number: null, // Part Number
      search_description: null, // Description
      search_quantity: null, // Quantity
      search_unit_measure: null, // Kode Satuan
      search_register_aircraft: null, // Register Aircraft
      search_customer: null, // Customer
      search_date_install: null, // Date Install
      search_date_aircraft_in: null, // Date Aircraft In
      search_date_aircraft_out: null, // Date Aircraft Out
      search_document_type: null, // Type BC
      search_submission_number: null, // Nomor Aju
      search_submission_date: null, // Tanggal Aju
      search_registration_number: null, // Nomor Daftar
      search_registration_date: null, // Tanggal Daftar
      search_cif_idr: null, // CIF IDR
      search_bm_bayar: null, // BM Bayar
      search_ppn_bayar: null, // PPn Bayar
      search_pph_bayar: null, // PPh Bayar

      // Order By
      order: "id",
      by: "desc",
      paginate: "10",
      current_page: null,

      filter_start_date: null,
      filter_end_date: null,
      filter_customer: null,
      filter_part_number: null,
      filter_document_type: [],
      filter_clicked: false,
    };
  },
  created() {
    this.list();
    Fire.$on("RefreshTable", () => {
      this.list();
    });
  },
  watch: {
    search: debounce(function () {
      this.list();
    }, 500),
    search_part_number: debounce(function () {
      this.list();
    }, 500),
    search_description: debounce(function () {
      this.list();
    }, 500),
    search_quantity: debounce(function () {
      this.list();
    }, 500),
    search_unit_measure: debounce(function () {
      this.list();
    }, 500),
    search_register_aircraft: debounce(function () {
      this.list();
    }, 500),
    search_customer: debounce(function () {
      this.list();
    }, 500),
    search_date_install: debounce(function () {
      this.list();
    }, 500),
    search_date_aircraft_in: debounce(function () {
      this.list();
    }, 500),
    search_date_aircraft_out: debounce(function () {
      this.list();
    }, 500),
    search_document_type: debounce(function () {
      this.list();
    }, 500),
    search_submission_number: debounce(function () {
      this.list();
    }, 500),
    search_submission_date: debounce(function () {
      this.list();
    }, 500),
    search_registration_number: debounce(function () {
      this.list();
    }, 500),
    search_registration_date: debounce(function () {
      this.list();
    }, 500),
    search_cif_idr: debounce(function () {
      this.list();
    }, 500),
    search_bm_bayar: debounce(function () {
      this.list();
    }, 500),
    search_ppn_bayar: debounce(function () {
      this.list();
    }, 500),
    search_pph_bayar: debounce(function () {
      this.list();
    }, 500),
    filter_start_date: debounce(function () {
      this.list();
    }, 500),
    filter_end_date: debounce(function () {
      this.list();
    }, 500),
    filter_customer: debounce(function () {
      this.list();
    }, 500),
    filter_part_number: debounce(function () {
      this.list();
    }, 500),
    filter_document_type: debounce(function () {
      this.list();
    }, 500),
  },

  methods: {
    filterButton() {
      this.filter_clicked = true;
      this.list();
    },
    clearForm() {
      this.filter_start_date = null;
      this.filter_end_date = null;
      this.filter_customer = null;
      this.filter_part_number = null;
      this.filter_document_type = null;
      this.filter_clicked = false;
      this.list();
    },
    list(paginate) {
      this.$Progress.start();
      paginate = paginate || `/api/outbound-transaction`;
      axios
        .get(paginate, {
          params: {
            search: this.search,
            search_part_number: this.search_part_number,
            search_description: this.search_description,
            search_quantity: this.search_quantity,
            search_unit_measure: this.search_unit_measure,
            search_register_aircraft: this.search_register_aircraft,
            search_customer: this.customer,
            search_date_install: this.search_date_install,
            search_date_aircraft_in: this.search_date_aircraft_in,
            search_date_aircraft_out: this.search_date_aircraft_out,
            search_document_type: this.search_document_type,
            search_submission_number: this.search_submission_number,
            search_submission_date: this.search_submission_date,
            search_registration_number: this.search_registration_number,
            search_registration_date: this.search_registration_date,
            search_cif_idr: this.search_cif_idr,
            search_bm_bayar: this.search_bm_bayar,
            search_ppn_bayar: this.search_ppn_bayar,
            search_pph_bayar: this.search_pph_bayar,
            filter_start_date: this.filter_start_date,
            filter_end_date: this.filter_end_date,
            filter_customer: this.filter_customer,
            filter_part_number: this.filter_part_number,
            filter_document_type: this.filter_document_type,
            order: this.order,
            by: this.by,
            paginate: this.paginate,
          },
        })
        .then((response) => {
          this.outbounds = response.data;
          this.current_page = this.outbounds.current_page;
          this.$Progress.finish();
        })
        .catch((error) => {
          this.$Progress.fail();
          console.log(error);
        });
    },
    directPage: debounce(function () {
      if (this.current_page < 1) {
        this.current_page = 1;
      } else if (this.current_page > this.outbounds.last_page) {
        this.current_page = this.outbounds.last_page;
      }
      let url = new URL(this.outbounds.first_page_url);
      let search_params = url.searchParams;
      search_params.set("page", this.current_page);
      url.search = search_params.toString();
      let new_url = url.toString();
      this.list(new_url);
    }, 500),
    sort(order, by) {
      this.order = order;
      this.by = by;
      this.list();
    },
  },
};
</script>
<style scoped>
.vgt-global-search__input .input__icon .magnifying-glass {
  margin-top: -3px;
}
</style>
