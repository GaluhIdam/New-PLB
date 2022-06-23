<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Report Mutasi Berkala</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">
                <a href="/periodic-mutation">Report Mutasi Berkala</a>
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
            <div class="card">
              <div class="card-header ui-sortable-handle">
                <h5 class="card-title card_title_margin">
                  <i class="fa-solid fa-file-circle-exclamation mr-1"></i>
                  Report Mutasi Berkala
                </h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>

              <div class="card-body">
                <div
                  class="form-group row justify-content-center align-items-center mt-4"
                >
                  <label for="part_number" class="col-form-label">Tanggal Mutasi</label>
                  <div class="col-sm-3">
                    <datepicker
                      input-class="form-control"
                      placeholder="To Date"
                      format="MM/dd/yyyy"
                      v-model="start_date"
                    />
                  </div>
                  <div class="col-sm-3">
                    <datepicker
                      input-class="form-control"
                      placeholder="Form date"
                      format="MM/dd/yyyy"
                      v-model="end_date"
                    />
                  </div>
                  <div class="offset-sm-5 col-sm-10 mt-4">
                    <button class="btn btn-primary" @click="filterDate">
                      <i class="fa-solid fa-magnifying-glass"></i> Filter
                    </button>
                    <button class="btn btn-secondary">
                      <i class="fa-solid fa-rotate"></i> Reset
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <hr />

            <div class="card" v-if="date_selected">
              <div class="card-body">
                <div class="form-group">
                  <div class="vgt-wrap polar-bear"></div>
                  <div class="vgt-inner-wrap">
                    <!-- BEGIN : Global Search -->
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
                    </div>
                    <!-- END :  Global Search -->
                    <div class="vgt-responsive">
                      <table id="vgt-table" class="vgt-table bordered polar-bear">
                        <thead>
                          <tr>
                            <!-- BEGIN: Number by ID (Table Header) -->
                            <th
                              rowspan="2"
                              v-if="order == 'id' && by == 'asc'"
                              @click="sort('id', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">No.</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              rowspan="2"
                              v-else-if="order == 'id' && by == 'desc'"
                              @click="sort('id', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">No.</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              rowspan="2"
                              v-else
                              @click="sort('id', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">No.</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Number by ID (Table Header) -->
                            <!-- BEGIN: Kode Barang (Table Header) -->
                            <th
                              rowspan="2"
                              v-if="order == 'item_code' && by == 'asc'"
                              @click="sort('item_code', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">Kode Barang</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              rowspan="2"
                              v-else-if="order == 'item_code' && by == 'desc'"
                              @click="sort('item_code', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">Kode Barang</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              rowspan="2"
                              v-else
                              @click="sort('item_code', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">Kode Barang</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Kode Barang (Table Header) -->
                            <!-- BEGIN: Nama Barang (Table Header) -->
                            <th
                              rowspan="2"
                              v-if="order == 'item_name' && by == 'asc'"
                              @click="sort('item_name', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">Nama Barang</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              rowspan="2"
                              v-else-if="order == 'item_name' && by == 'desc'"
                              @click="sort('item_name', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">Nama Barang</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              rowspan="2"
                              v-else
                              @click="sort('item_name', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">Nama Barang</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Nama Barang (Table Header) -->
                            <!-- BEGIN: Satuan (Table Header) -->
                            <th
                              rowspan="2"
                              v-if="order == 'unit' && by == 'asc'"
                              @click="sort('unit', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">Satuan</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              rowspan="2"
                              v-else-if="order == 'unit' && by == 'desc'"
                              @click="sort('unit', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">Satuan</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              rowspan="2"
                              v-else
                              @click="sort('unit', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">Satuan</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Satuan (Table Header) -->
                            <!-- BEGIN: Saldo Awal (Table Header) -->
                            <th
                              rowspan="2"
                              v-if="order == 'beginning_balance' && by == 'asc'"
                              @click="sort('beginning_balance', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">Saldo Awal</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              rowspan="2"
                              v-else-if="order == 'beginning_balance' && by == 'desc'"
                              @click="sort('beginning_balance', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">Saldo Awal</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              rowspan="2"
                              v-else
                              @click="sort('beginning_balance', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">Saldo Awal</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Saldo Awal (Table Header) -->
                            <th colspan="3" class="text-center">
                              <span class="table_header">Pemasukan</span>
                            </th>
                            <th colspan="3" class="text-center">
                              <span class="table_header">Pengeluaran</span>
                            </th>
                            <!-- BEGIN: Penyesuaian (Table Header) -->
                            <th
                              rowspan="2"
                              v-if="order == 'adjustment' && by == 'asc'"
                              @click="sort('adjustment', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">Penyesuaian</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              rowspan="2"
                              v-else-if="order == 'adjustment' && by == 'desc'"
                              @click="sort('adjustment', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">Penyesuaian</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              rowspan="2"
                              v-else
                              @click="sort('adjustment', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">Penyesuaian</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Penyesuaian (Table Header) -->
                            <!-- BEGIN: Saldo Buku (Table Header) -->
                            <th
                              rowspan="2"
                              v-if="order == 'book_balance' && by == 'asc'"
                              @click="sort('book_balance', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">Saldo Buku</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              rowspan="2"
                              v-else-if="order == 'book_balance' && by == 'desc'"
                              @click="sort('book_balance', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">Saldo Buku</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              rowspan="2"
                              v-else
                              @click="sort('book_balance', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">Saldo Buku</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Saldo Buku (Table Header) -->
                            <!-- BEGIN: Stock Opname (Table Header) -->
                            <th
                              rowspan="2"
                              v-if="order == 'inventory_taking' && by == 'asc'"
                              @click="sort('inventory_taking', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">Stock Opname</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              rowspan="2"
                              v-else-if="order == 'inventory_taking' && by == 'desc'"
                              @click="sort('inventory_taking', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">Stock Opname</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              rowspan="2"
                              v-else
                              @click="sort('inventory_taking', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">Stock Opname</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Stock Opname (Table Header) -->
                            <!-- BEGIN: Selisih (Table Header) -->
                            <th
                              rowspan="2"
                              v-if="order == 'difference' && by == 'asc'"
                              @click="sort('difference', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">Selisih</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              rowspan="2"
                              v-else-if="order == 'difference' && by == 'desc'"
                              @click="sort('difference', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">Selisih</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              rowspan="2"
                              v-else
                              @click="sort('difference', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">Selisih</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Selisih (Table Header) -->
                          </tr>
                          <tr>
                            <!-- BEGIN: BC 1.6 In (Table Header) -->
                            <th
                              v-if="order == 'code_bc_16_in' && by == 'asc'"
                              @click="sort('code_bc_16_in', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">BC 1.6</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else-if="order == 'code_bc_16_in' && by == 'desc'"
                              @click="sort('id', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">BC 1.6</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else
                              @click="sort('code_bc_16_in', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">BC 1.6</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: BC 1.6 In (Table Header) -->
                            <!-- BEGIN: BC 4.0 In (Table Header) -->
                            <th
                              v-if="order == 'code_bc_40_in' && by == 'asc'"
                              @click="sort('code_bc_40_in', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">BC 4.0</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else-if="order == 'code_bc_40_in' && by == 'desc'"
                              @click="sort('id', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">BC 4.0</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else
                              @click="sort('code_bc_40_in', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">BC 4.0</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: BC 4.0 In (Table Header) -->
                            <!-- BEGIN: BC 2.7 In (Table Header) -->
                            <th
                              v-if="order == 'code_bc_27_in' && by == 'asc'"
                              @click="sort('code_bc_27_in', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">BC 2.7</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else-if="order == 'code_bc_27_in' && by == 'desc'"
                              @click="sort('id', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">BC 2.7</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else
                              @click="sort('code_bc_27_in', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">BC 2.7</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: BC 2.7 In (Table Header) -->
                            <!-- BEGIN: BC 2.8 Out (Table Header) -->
                            <th
                              v-if="order == 'code_bc_28_out' && by == 'asc'"
                              @click="sort('code_bc_28_out', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">BC 2.8</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else-if="order == 'code_bc_28_out' && by == 'desc'"
                              @click="sort('id', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">BC 2.8</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else
                              @click="sort('code_bc_28_out', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">BC 2.8</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: BC 2.8 Out (Table Header) -->
                            <!-- BEGIN: BC 4.1 Out (Table Header) -->
                            <th
                              v-if="order == 'code_bc_41_out' && by == 'asc'"
                              @click="sort('code_bc_41_out', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">BC 4.1</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else-if="order == 'code_bc_41_out' && by == 'desc'"
                              @click="sort('id', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">BC 4.1</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else
                              @click="sort('code_bc_41_out', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">BC 4.1</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: BC 4.1 Out (Table Header) -->
                            <!-- BEGIN: BC 2.7 Out (Table Header) -->
                            <th
                              v-if="order == 'code_bc_27_out' && by == 'asc'"
                              @click="sort('code_bc_27_out', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">BC 2.7</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else-if="order == 'code_bc_27_out' && by == 'desc'"
                              @click="sort('id', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">BC 2.7</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else
                              @click="sort('code_bc_27_out', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">BC 2.7</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: BC 2.7 Out (Table Header) -->
                          </tr>
                        </thead>
                        <!-- END: Table Head -->

                        <!-- BEGIN: Table Body -->
                        <tbody>
                          <tr
                            v-for="(
                              mutation_periodic, mutation_periodic_index
                            ) in mutation_periodics.data"
                            :key="mutation_periodic_index"
                          >
                            <td class="text-center table-content">
                              {{ mutation_periodic.id }}
                            </td>
                            <td class="text-center table-content">
                              {{ mutation_periodic.item_code }}
                            </td>
                            <td class="text-center table-content">
                              {{ mutation_periodic.item_name }}
                            </td>
                            <td class="text-center table-content">
                              {{ mutation_periodic.unit }}
                            </td>
                            <td class="text-center table-content">
                              {{ mutation_periodic.beginning_balance }}
                            </td>
                            <td class="text-center table-content">
                              {{ mutation_periodic.code_bc_16_in }}
                            </td>
                            <td class="text-center table-content">
                              {{ mutation_periodic.code_bc_28_out }}
                            </td>
                            <td class="text-center table-content">
                              {{ mutation_periodic.code_bc_41_out }}
                            </td>
                            <td class="text-center table-content">
                              {{ mutation_periodic.code_bc_27_out }}
                            </td>
                            <td class="text-center table-content">
                              {{ mutation_periodic.code_bc_40_in }}
                            </td>
                            <td class="text-center table-content">
                              {{ mutation_periodic.code_bc_27_in }}
                            </td>
                            <td class="text-center table-content">
                              {{ mutation_periodic.adjustment }}
                            </td>
                            <td class="text-center table-content">
                              {{ mutation_periodic.book_balance }}
                            </td>
                            <td class="text-center table-content">
                              {{ mutation_periodic.inventory_taking }}
                            </td>
                            <td class="text-center table-content">
                              {{ mutation_periodic.difference }}
                            </td>
                          </tr>
                        </tbody>

                        <!-- END: Table Body -->
                      </table>
                    </div>
                    <div class="vgt-wrap__footer vgt-clearfix">
                      <div class="footer__row-count vgt-pull-left">
                        <label class="footer__row-count__label row_per_page_label">
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
                            disabled: !mutation_periodics.prev_page_url,
                          }"
                          @click="
                            mutation_periodics.prev_page_url &&
                              list(mutation_periodics.prev_page_url)
                          "
                          style="margin-right: 0px"
                        >
                          <span aria-hidden="true" class="chevron left"></span>
                          <span class="paginate_text">Prev</span>
                        </button>
                        <div class="footer__navigation__page-info" style="color: #99a0b2">
                          <label class="page-info__label" style="margin-bottom: -5px">
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
                              {{ mutation_periodics.last_page }}
                            </span>
                          </label>
                        </div>
                        <button
                          type="button"
                          class="footer__navigation__page-btn"
                          :class="{
                            disabled: !mutation_periodics.next_page_url,
                          }"
                          @click="
                            mutation_periodics.next_page_url &&
                              list(mutation_periodics.next_page_url)
                          "
                        >
                          <span style="font-weight: 500">Next</span>
                          <span aria-hidden="true" class="chevron right"></span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import debounce from "lodash/debounce";
import moment from "moment";
moment.locale("id");

export default {
  data() {
    return {
      mutation_periodics: {
        data: [],
      },
      search: "",
      search_item_code: "",
      search_item_name: "",
      search_unit: "",
      search_beginning_balance: "",
      search_code_bc_16_in: "",
      search_code_bc_40_in: "",
      search_code_bc_27_in: "",
      search_code_bc_28_out: "",
      search_code_bc_41_out: "",
      search_code_bc_27_out: "",
      search_adjustment: "",
      search_book_balance: "",
      search_inventory_taking: "",
      search_difference: "",
      search_submission_date: "",
      search_submission_number: "",
      order: "id",
      by: "desc",
      paginate: "10",
      current_page: null,
      start_date: null,
      end_date: null,
      date_selected: false,
    };
  },
  // created() {
  //   this.list();
  //   Fire.$on("RefreshTable", () => {
  //     this.list();
  //   });
  // },
  watch: {
    // search: debounce(function () {
    //   this.list();
    // }, 500),
    search_item_code: debounce(function () {
      this.list();
    }, 500),
    search_item_name: debounce(function () {
      this.list();
    }, 500),
    search_unit: debounce(function () {
      this.list();
    }, 500),
    search_beginning_balance: debounce(function () {
      this.list();
    }, 500),
    search_code_bc_16_in: debounce(function () {
      this.list();
    }, 500),
    search_code_bc_40_in: debounce(function () {
      this.list();
    }, 500),
    search_code_bc_27_in: debounce(function () {
      this.list();
    }, 500),
    search_code_bc_28_out: debounce(function () {
      this.list();
    }, 500),
    search_code_bc_41_out: debounce(function () {
      this.list();
    }, 500),
    search_code_bc_27_out: debounce(function () {
      this.list();
    }, 500),
    search_adjustment: debounce(function () {
      this.list();
    }, 500),
    search_book_balance: debounce(function () {
      this.list();
    }, 500),

    search_inventory_taking: debounce(function () {
      this.list();
    }, 500),
    search_difference: debounce(function () {
      this.list();
    }, 500),

    search_submission_date: debounce(function () {
      this.list();
    }, 500),
    search_submission_number: debounce(function () {
      this.list();
    }, 500),
  },
  methods: {
    filterDate() {
      this.list();
      this.date_selected = true;
    },
    list(paginate) {
      this.$Progress.start();
      paginate = paginate || "/api/mutation-periodic";
      axios
        .get(paginate, {
          params: {
            search: this.search,
            search_item_code: this.search_item_code,
            search_item_name: this.search_item_name,
            search_unit: this.$search_unit,
            search_beginning_balance: this.$search_beginning_balance,
            search_code_bc_16_in: this.$search_code_bc_16_in,
            search_code_bc_40_in: this.$search_code_bc_40_in,
            search_code_bc_27_in: this.$search_code_bc_27_in,
            search_code_bc_28_out: this.$search_code_bc_28_out,
            search_code_bc_41_out: this.$search_code_bc_41_out,
            search_code_bc_27_out: this.$search_code_bc_27_out,
            search_adjustment: this.$search_adjustment,
            search_book_balance: this.$search_book_balance,
            search_inventory_taking: this.$search_inventory_taking,
            search_difference: this.$search_difference,
            search_submission_date: this.$search_submission_date,
            search_submission_number: this.$search_submission_number,
            start_date: this.start_date,
            end_date: this.end_date,
            order: this.order,
            by: this.by,
            paginate: this.paginate,
          },
        })
        .then((response) => {
          this.mutation_periodics = response.data;
          this.current_page = this.mutation_periodics.current_page;
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
      } else if (this.current_page > this.mutation_periodics.last_page) {
        this.current_page = this.mutation_periodics.last_page;
      }

      let url = new URL(this.mutation_periodics.first_page_url);
      let search_params = new URLSearchParams(url.search);
      search_params.set("page", this.current_page);
      url.search = search_params.toString();
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
