<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Report Perhitungan Mutasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item active">
                <a href="/calculation-mutation">Report Perhitungan Mutasi</a>
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
                  <i class="nav-icon fa-solid fa-file-circle-exclamation"></i>
                  Report Perhitungan Mutasi
                </h5>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item"></li>
                  </ul>
                </div>
              </div>
              <div class="card-body">
                <div class="row mb-3 d-flex justify-content-center">
                  <label class="col-sm-2 col-form-label me-0 ms-0">Date Mutations</label>
                  <div class="col-sm-3">
                    <input type="date" class="form-control" v-model="search_date" />
                  </div>
                </div>
                <div class="row mb-5 d-flex justify-content-center">
                  <div class="col d-flex justify-content-center">
                    <button class="btn btn-primary" style="margin-left: 95px">Search</button>
                    <button @click="clearForm" class="btn btn-secondary" style="margin-left: 10px">Clear</button>
                  </div>
                </div>

                <hr />

                <div class="form-group">
                  <div class="vgt-wrap polar-bear">
                    <div class="vgt-inner-wrap">
                      <div class="vgt-global-search vgt-clearfix">
                        <div class="vgt-global-search__input vgt-pull-left">
                          <label>
                            <span aria-hidden="true" class="input__icon">
                              <div class="magnifying-glass"></div>
                            </span>
                            <span class="sr-only"> Search </span>
                          </label>
                          <input type="text" placeholder="Search Data" class="vgt-input vgt-pull-left" v-model="search" />
                        </div>
                      </div>
                      <div class="vgt-responsive">
                        <table id="vgt-table" class="vgt-table bordered polar-bear">
                          <thead>
                            <tr>
                              <!--  -->
                              <th v-if="order == 'id' && by == 'asc'" @click="sort('id', 'desc')" class="text-center sortable sorting sorting-asc" rowspan="2">
                                <span class="table_header">No.</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'id' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc" rowspan="2">
                                <span class="table_header">No.</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('id', 'asc')" class="text-center sortable" rowspan="2">
                                <span class="table_header">No.</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th v-if="order == 'item_code' && by == 'asc'" @click="sort('item_code', 'desc')" class="text-center sortable sorting sorting-asc" rowspan="2">
                                <span class="table_header">Kode Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'item_code' && by == 'desc'" @click="sort('item_code', 'asc')" class="text-center sortable sorting sorting-desc" rowspan="2">
                                <span class="table_header">Kode Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('item_code', 'asc')" class="text-center sortable" rowspan="2">
                                <span class="table_header">Kode Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th v-if="order == 'item_name' && by == 'asc'" @click="sort('item_name', 'desc')" class="text-center sortable sorting sorting-asc" rowspan="2">
                                <span class="table_header">Nama Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'item_name' && by == 'desc'" @click="sort('item_name', 'asc')" class="text-center sortable sorting sorting-desc" rowspan="2">
                                <span class="table_header">Nama Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('item_name', 'asc')" class="text-center sortable" rowspan="2">
                                <span class="table_header">Nama Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th v-if="order == 'unit' && by == 'asc'" @click="sort('unit', 'desc')" class="text-center sortable sorting sorting-asc" rowspan="2">
                                <span class="table_header">Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'unit' && by == 'desc'" @click="sort('unit', 'asc')" class="text-center sortable sorting sorting-desc" rowspan="2">
                                <span class="table_header">Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('unit', 'asc')" class="text-center sortable" rowspan="2">
                                <span class="table_header">Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <!--  -->
                              <th v-if="order == 'first_balance' && by == 'asc'" @click="sort('first_balance', 'desc')" class="text-center sortable sorting sorting-asc" rowspan="2">
                                <span class="table_header">Saldo Awal</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'first_balance' && by == 'desc'" @click="sort('first_balance', 'asc')" class="text-center sortable sorting sorting-desc" rowspan="2">
                                <span class="table_header">Saldo Awal</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('first_balance', 'asc')" class="text-center sortable" rowspan="2">
                                <span class="table_header">Saldo Awal</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th colspan="3" class="text-center">
                                <span class="table_header">Pemasukan</span>
                              </th>
                              <!--  -->
                              <th colspan="4" class="text-center">
                                <span class="table_header">Pengeluaran</span>
                              </th>
                              <!--  -->
                              <th v-if="order == 'adjustment' && by == 'asc'" @click="sort('adjustment', 'desc')" class="text-center sortable sorting sorting-asc" rowspan="2">
                                <span class="table_header">Penyesuaian</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'adjustment' && by == 'desc'" @click="sort('adjustment', 'asc')" class="text-center sortable sorting sorting-desc" rowspan="2">
                                <span class="table_header">Penyesuaian</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('adjustment', 'asc')" class="text-center sortable" rowspan="2">
                                <span class="table_header">Penyesuaian</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th v-if="order == 'book_balance' && by == 'asc'" @click="sort('book_balance', 'desc')" class="text-center sortable sorting sorting-asc" rowspan="2">
                                <span class="table_header">Buku Saldo</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'book_balance' && by == 'desc'" @click="sort('book_balance', 'asc')" class="text-center sortable sorting sorting-desc" rowspan="2">
                                <span class="table_header">Buku Saldo</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('book_balance', 'asc')" class="text-center sortable" rowspan="2">
                                <span class="table_header">Buku Saldo</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th v-if="order == 'stock_opname' && by == 'asc'" @click="sort('stock_opname', 'desc')" class="text-center sortable sorting sorting-asc" rowspan="2">
                                <span class="table_header">Stock Opname</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'stock_opname' && by == 'desc'" @click="sort('stock_opname', 'asc')" class="text-center sortable sorting sorting-desc" rowspan="2">
                                <span class="table_header">Stock Opname</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('stock_opname', 'asc')" class="text-center sortable" rowspan="2">
                                <span class="table_header">Stock Opname</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th v-if="order == 'difference' && by == 'asc'" @click="sort('difference', 'desc')" class="text-center sortable sorting sorting-asc" rowspan="2">
                                <span class="table_header">Selisih</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'difference' && by == 'desc'" @click="sort('difference', 'asc')" class="text-center sortable sorting sorting-desc" rowspan="2">
                                <span class="table_header">Selisih</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('difference', 'asc')" class="text-center sortable" rowspan="2">
                                <span class="table_header">Selisih</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                            </tr>
                            <tr>
                              <th v-if="order == 'cost_bc28' && by == 'asc'" @click="sort('cost_bc28', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">BC28</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'cost_bc28' && by == 'desc'" @click="sort('cost_bc28', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">BC28</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('cost_bc28', 'asc')" class="text-center sortable">
                                <span class="table_header">BC28</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <!--  -->
                              <th v-if="order == 'income_bc40' && by == 'asc'" @click="sort('income_bc40', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">BC40</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'income_bc40' && by == 'desc'" @click="sort('income_bc40', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">BC40</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('income_bc40', 'asc')" class="text-center sortable">
                                <span class="table_header">BC40</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <!--  -->
                              <th v-if="order == 'income_bc27' && by == 'asc'" @click="sort('income_bc27', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">BC27</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'income_bc27' && by == 'desc'" @click="sort('income_bc27', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">BC27</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('income_bc27', 'asc')" class="text-center sortable">
                                <span class="table_header">BC27</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th v-if="order == 'cost_bc28' && by == 'asc'" @click="sort('cost_bc28', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">BC28</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'cost_bc28' && by == 'desc'" @click="sort('cost_bc28', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">BC28</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('cost_bc28', 'asc')" class="text-center sortable">
                                <span class="table_header">BC28</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <!--  -->
                              <th v-if="order == 'cost_bc41' && by == 'asc'" @click="sort('cost_bc41', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">BC41</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'cost_bc41' && by == 'desc'" @click="sort('cost_bc41', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">BC41</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('cost_bc41', 'asc')" class="text-center sortable">
                                <span class="table_header">BC41</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <!--  -->
                              <th v-if="order == 'cost_bc27' && by == 'asc'" @click="sort('cost_bc27', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">BC27</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'cost_bc27' && by == 'desc'" @click="sort('cost_bc27', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">BC27</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('cost_bc27', 'asc')" class="text-center sortable">
                                <span class="table_header">BC27</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th v-if="order == 'cost_bc30' && by == 'asc'" @click="sort('cost_bc30', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">BC30</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'cost_bc30' && by == 'desc'" @click="sort('cost_bc30', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">BC30</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('cost_bc30', 'asc')" class="text-center sortable">
                                <span class="table_header">BC30</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(mutations, mutations_index) in mutations.data" :key="mutations_index">
                              <td class="text-center table_content">
                                {{ mutations.id }}
                              </td>
                              <td class="text-center table_content">
                                {{ mutations.item_code }}
                              </td>
                              <td class="table_content">
                                {{ mutations.item_name }}
                              </td>
                              <td class="table_content text-center">
                                {{ mutations.unit }}
                              </td>
                              <td class="table_content text-center">
                                {{ mutations.first_balance }}
                              </td>
                              <td class="table_content text-center">
                                {{ mutations.income_bc16 }}
                              </td>
                              <td class="table_content text-center">
                                {{ mutations.income_bc40 }}
                              </td>
                              <td class="table_content text-center">
                                {{ mutations.income_bc27 }}
                              </td>
                              <td class="table_content text-center">
                                {{ mutations.cost_bc28 }}
                              </td>
                              <td class="table_content text-center">
                                {{ mutations.cost_bc41 }}
                              </td>
                              <td class="table_content text-center">
                                {{ mutations.cost_bc27 }}
                              </td>
                              <td class="table_content text-center">
                                {{ mutations.cost_bc30 }}
                              </td>
                              <td class="table_content text-center">
                                {{ mutations.adjustment }}
                              </td>
                              <td class="table_content text-center">
                                {{ mutations.book_balance }}
                              </td>
                              <td class="table_content text-center">
                                {{ mutations.stock_opname }}
                              </td>
                              <td class="table_content text-center">
                                {{ mutations.difference }}
                              </td>
                            </tr>
                            <tr v-if="mutations.data.length < 1">
                              <td colspan="16">
                                <div class="vgt-center-align vgt-text-disabled">Data not found</div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="vgt-wrap__footer vgt-clearfix">
                        <div class="footer__row-count vgt-pull-left">
                          <label class="footer__row-count__label row_per_page_label"> Rows per page: </label>
                          <select class="footer__row-count__select row_per_page_option" v-model="paginate" @change="list()">
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
                              disabled: !mutations.prev_page_url
                            }"
                            @click="mutations.prev_page_url && list(mutations.prev_page_url)"
                            style="margin-right: 0px"
                          >
                            <span aria-hidden="true" class="chevron left"></span>
                            <span class="paginate_text">Prev</span>
                          </button>
                          <div class="footer__navigation__page-info" style="color: #99a0b2">
                            <label class="page-info__label" style="margin-bottom: -5px">
                              <span class="paginate_text">page</span>
                              <input type="text" class="footer__navigation__page-info__current-entry vgt-input" v-model="current_page" @keypress="directPage" style="width: 60px" />
                              <span class="paginate_text">
                                of
                                {{ mutations.last_page }}
                              </span>
                            </label>
                          </div>
                          <button
                            type="button"
                            class="footer__navigation__page-btn"
                            :class="{
                              disabled: !mutations.next_page_url
                            }"
                            @click="mutations.next_page_url && list(mutations.next_page_url)"
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
  </div>
</template>

<script>
import axios from 'axios'
import debounce from 'lodash/debounce'
import Swal from 'sweetalert2'

export default {
  data() {
    return {
      mutations: {
        data: [],
        links: []
      },
      search_date: null,
      search: null,
      order: 'id',
      by: 'desc',
      paginate: '10',
      current_page: null
    }
  },
  created() {
    this.list()
  },
  watch: {
    search: debounce(function () {
      this.list()
    }, 500),
    search_date: debounce(function () {
      this.list()
    }, 500)
  },
  methods: {
    list(paginate) {
      this.showLoading()
      paginate = paginate || `/api/mutation-calculations`
      axios
        .get(paginate, {
          params: {
            search: this.search,
            search_date: this.search_date,
            order: this.order,
            by: this.by,
            paginate: this.paginate
          }
        })
        .then((response) => {
          this.mutations = response.data
          this.current_page = this.mutations.current_page
          Swal.close()
        })
        .catch((error) => console.log(error))
    },
    directPage: debounce(function () {
      if (this.current_page < 1) {
        this.current_page = 1
      } else if (this.current_page > this.mutations.last_page) {
        this.current_page = this.mutations.last_page
      }

      let url = new URL(this.mutations.first_page_url)
      let search_params = url.searchParams
      search_params.set('page', this.current_page)
      url.search = search_params.toString()
      let new_url = url.toString()
      this.list(new_url)
    }, 500),
    sort(order, by) {
      this.order = order
      this.by = by
      this.list()
    },
    showLoading() {
      Swal.fire({
        didOpen: () => {
          Swal.showLoading()
        },
        background: 'transparent',
        allowOutsideClick: false
      })
    },
    clearForm() {
      this.search_date = null
    }
  }
}
</script>
