<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0">Summary Outbound</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active"><span>Summary Outbound</span></li>
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
              <div class="card-header">Summary Outbound</div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-5">
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Part Number</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Tanggal Outbound</label>
                      <div class="col-sm-4">
                        <input type="date" class="form-control" />
                      </div>
                      <div class="col-sm-4">
                        <input type="date" class="form-control" />
                      </div>
                    </div>
                  </div>

                  <div class="col-md-1"></div>
                </div>
                <div class="row">
                  <div class="col-md-3 col-sm-6"></div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label"></label>
                      <div class="col-sm-4">
                        <button class="btn btn-primary btn-md">Filter</button>
                        <button class="btn btn-secondary btn-md">Reset</button>
                      </div>
                    </div>
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
                            <button class="btn btn-secondary ms-auto rounded-1">
                              <i class="fa-solid fa-file-pdf"></i>
                              PDF
                            </button>
                          </div>
                        </div>
                      </div>
                      <div class="vgt-responsive">
                        <table id="vgt-table" class="vgt-table bordered polar-bear">
                          <thead>
                            <tr>
                              <!-- Part Number -->
                              <th v-if="order == 'part_number' && by == 'asc'" @click="sort('part_number', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Part Number</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'part_number' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">Part Number</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('part_number', 'asc')" class="text-center sortable">
                                <span class="table_header">Part Number</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- Kondisi -->
                              <th v-if="order == 'condition' && by == 'asc'" @click="sort('condition', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Kondisi</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'condition' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">Kondisi</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('condition', 'asc')" class="text-center sortable">
                                <span class="table_header">Kondisi</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- Qty -->
                              <th v-if="order == 'quantity' && by == 'asc'" @click="sort('quantity', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Qty</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'quantity' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">Qty</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('quantity', 'asc')" class="text-center sortable">
                                <span class="table_header">Qty</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- CIF IDR -->
                              <th v-if="order == 'cif_idr' && by == 'asc'" @click="sort('cif_idr', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">CIF IDR</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'cif_idr' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">CIF IDR</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('cif_idr', 'asc')" class="text-center sortable">
                                <span class="table_header">CIF IDR</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- BM Dibayar -->
                              <th v-if="order == 'bm_paid' && by == 'asc'" @click="sort('bm_paid', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">BM Dibayar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'bm_paid' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">BM Dibayar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('bm_paid', 'asc')" class="text-center sortable">
                                <span class="table_header">BM Dibayar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- PPN Dibayar -->
                              <th v-if="order == 'ppn_paid' && by == 'asc'" @click="sort('ppn_paid', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">PPN Dibayar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'ppn_paid' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">PPN Dibayar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('ppn_paid', 'asc')" class="text-center sortable">
                                <span class="table_header">PPN Dibayar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- PPh Dibayar -->
                              <th v-if="order == 'pph_paid' && by == 'asc'" @click="sort('pph_paid', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">PPh Dibayar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'pph_paid' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">PPh Dibayar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('pph_paid', 'asc')" class="text-center sortable">
                                <span class="table_header">PPh Dibayar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- PPN Tidak Dipungut -->
                              <th v-if="order == 'pph_paid' && by == 'asc'" @click="sort('pph_paid', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">PPN Tidak Dipungut</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'pph_paid' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">PPN Tidak Dipungut</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('pph_paid', 'asc')" class="text-center sortable">
                                <span class="table_header">PPN Tidak Dipungut</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- PPh Tidak Dipungut -->
                              <th v-if="order == 'pph_paid' && by == 'asc'" @click="sort('pph_paid', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">PPh Tidak Dipungut</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'pph_paid' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">PPh Tidak Dipungut</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('pph_paid', 'asc')" class="text-center sortable">
                                <span class="table_header">PPh Tidak Dipungut</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                            </tr>
                            <tr>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter Part Number" v-model="search_part_number" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter Kondisi" v-model="search_condition" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter Qty" v-model="search_quantity" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter CIF IDR" v-model="search_cif_idr" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter BM Dibayar" v-model="search_bm_paid" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter PPN Dibayar" v-model="search_ppn_paid" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter PPh Dibayar" v-model="search_pph_paid" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter PPN Tidak Dipungut" v-model="search_ppn_not_paid" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter PPh Tidak Dipungut" v-model="search_pph_not_paid" />
                                </div>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(transaction, transaction_index) in transactions.data" :key="transaction_index">
                              <td class="table_content">{{ transaction.part_number }}</td>
                              <td class="table_content">{{ transaction.condition }}</td>
                              <td class="table_content">{{ transaction.quantity }}</td>
                              <td class="table_content">{{ transaction.cif_idr }}</td>
                              <td class="table_content">{{ transaction.bm_paid }}</td>
                              <td class="table_content">{{ transaction.ppn_paid }}</td>
                              <td class="table_content">{{ transaction.pph_paid }}</td>
                              <td class="table_content">{{ transaction.ppn_not_paid }}</td>
                              <td class="table_content">{{ transaction.pph_not_paid }}</td>
                            </tr>
                            <tr v-if="transactions.data.length < 1">
                              <td colspan="15">
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
                              disabled: !transactions.prev_page_url
                            }"
                            @click="transactions.prev_page_url && list(transactions.prev_page_url)"
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
                                {{ transactions.last_page }}
                              </span>
                            </label>
                          </div>
                          <button
                            type="button"
                            class="footer__navigation__page-btn"
                            :class="{
                              disabled: !transactions.next_page_url
                            }"
                            @click="transactions.next_page_url && list(transactions.next_page_url)"
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
      transactions: {
        data: [],
        links: []
      },
      search: null,
      search_part_number: null,
      search_condition: null,
      search_quantity: null,
      search_cif_idr: null,
      search_bm_paid: null,
      search_ppn_paid: null,
      search_pph_paid: null,
      search_ppn_not_paid: null,
      search_pph_not_paid: null,
      start_date: null,
      end_date: null,
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
    search_part_number: debounce(function () {
      this.list()
    }, 500),
    search_condition: debounce(function () {
      this.list()
    }, 500),
    search_quantity: debounce(function () {
      this.list()
    }, 500),
    search_cif_idr: debounce(function () {
      this.list()
    }, 500),
    search_bm_paid: debounce(function () {
      this.list()
    }, 500),
    search_ppn_paid: debounce(function () {
      this.list()
    }, 500),
    search_pph_paid: debounce(function () {
      this.list()
    }, 500),
    search_ppn_not_paid: debounce(function () {
      this.list()
    }, 500),
    search_pph_not_paid: debounce(function () {
      this.list()
    }, 500)
  },
  methods: {
    list(paginate) {
      this.showLoading()
      paginate = paginate || `/api/outbound/transaction-2`
      axios
        .get(paginate, {
          params: {
            search: this.search,
            part_number: this.search_part_number,
            description: this.search_description,
            quantity: this.search_quantity,
            unit_code: this.search_unit_code,
            register_ac: this.search_register_ac,
            date_install: this.search_date_install,
            date_ac_in: this.search_date_ac_in,
            date_ac_out: this.search_date_ac_out,
            type_bc_out: this.search_type_bc_out,
            no_aju: this.search_no_aju,
            date_bc_out: this.search_date_bc_out,
            cif_idr: this.search_cif_idr,
            bm_paid: this.search_bm_paid,
            ppn_paid: this.search_ppn_paid,
            pph_paid: this.search_pph_paid,
            start_date: this.start_date,
            end_date: this.end_date,
            order: this.order,
            by: this.by,
            paginate: this.paginate
          }
        })
        .then((response) => {
          this.transactions = response.data
          this.current_page = this.transactions.current_page
          // console.log(this.transactions);
          Swal.close()
        })
        .catch((error) => console.log(error))
    },
    directPage: debounce(function () {
      if (this.current_page < 1) {
        this.current_page = 1
      } else if (this.current_page > this.transactions.last_page) {
        this.current_page = this.transactions.last_page
      }

      let url = new URL(this.transactions.first_page_url)
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
    }
  }
}
</script>
