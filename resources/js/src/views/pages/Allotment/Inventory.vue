<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Inventory Allotment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item active"><a href="/inventory-allotment">Inventory Allotment</a></li>
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
                  <i class="nav-icon fa-solid fa-warehouse"></i>
                  Inventory Allotment
                </h5>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item"></li>
                  </ul>
                </div>
              </div>
              <div class="card-body">
                <form class="form-horizontal">
                  <div class="form-group row justify-content-center align-items-center">
                    <label for="part_number" class="col-form-label">Plant</label>
                    <div class="col-sm-3">
                      <input type="search" class="form-control" id="part_number" name="part_number" autofocus />
                    </div>
                  </div>
                  <div class="form-group row justify-content-center align-items-center">
                    <div class="offset-sm-5 col-sm-7">
                      <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
                      <button class="btn btn-secondary"><i class="fa-solid fa-rotate"></i> Reset</button>
                    </div>
                  </div>
                </form>
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
                              <th v-if="order == 'id' && by == 'asc'" @click="sort('id', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">No.</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'id' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">No.</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('id', 'asc')" class="text-center sortable">
                                <span class="table_header">No.</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th v-if="order == 'partnumber' && by == 'asc'" @click="sort('partnumber', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Part Number</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'partnumber' && by == 'desc'" @click="sort('partnumber', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">Part Number</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('partnumber', 'asc')" class="text-center sortable">
                                <span class="table_header">Part Number</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th v-if="order == 'plant_asal' && by == 'asc'" @click="sort('plant_asal', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Plant Asal</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'plant_asal' && by == 'desc'" @click="sort('plant_asal', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">Plant Asal</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('plant_asal', 'asc')" class="text-center sortable">
                                <span class="table_header">Plant Asal</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th v-if="order == 'plant_tujuan' && by == 'asc'" @click="sort('plant_tujuan', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Plant Tujuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'plant_tujuan' && by == 'desc'" @click="sort('plant_tujuan', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">Plant Tujuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('plant_tujuan', 'asc')" class="text-center sortable">
                                <span class="table_header">Plant Tujuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th v-if="order == 'Qty' && by == 'asc'" @click="sort('Qty', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Qty</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'Qty' && by == 'desc'" @click="sort('Qty', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">Qty</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('Qty', 'asc')" class="text-center sortable">
                                <span class="table_header">Qty</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>

                              <!--  -->
                              <th v-if="order == 'kode_satuan' && by == 'asc'" @click="sort('kode_satuan', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Kode Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'kode_satuan' && by == 'desc'" @click="sort('kode_satuan', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">Kode Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('kode_satuan', 'asc')" class="text-center sortable">
                                <span class="table_header">Kode Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                            </tr>
                            <tr>
                              <th class="filter-th"></th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter Username" v-model="search_username" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter IP Address" v-model="search_ip_address" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter IP Address" v-model="search_ip_address" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter User Agent" v-model="search_user_agent" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter IP Address" v-model="search_ip_address" />
                                </div>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(login, login_index) in login_history.data" :key="login_index">
                              <td class="table_content">{{ login.id }}</td>
                              <td class="table_content">{{ login.username }}</td>
                              <td class="table_content">{{ login.time }}</td>
                              <td class="text-center table_content">{{ login.ip_address }}</td>
                              <td class="text-center table_content">{{ login.user_agent }}</td>
                              <td class="text-center table_content">{{ login.user_agent }}</td>
                            </tr>
                            <tr v-if="login_history.data.length < 1">
                              <td colspan="8">
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
                              disabled: !login_history.prev_page_url
                            }"
                            @click="login_history.prev_page_url && list(login_history.prev_page_url)"
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
                                {{ login_history.last_page }}
                              </span>
                            </label>
                          </div>
                          <button
                            type="button"
                            class="footer__navigation__page-btn"
                            :class="{
                              disabled: !login_history.next_page_url
                            }"
                            @click="login_history.next_page_url && list(login_history.next_page_url)"
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
      login_history: {
        data: [],
        links: []
      },
      search: null,
      search_username: null,
      search_time: null,
      search_ip_address: null,
      search_user_agent: null,
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
    search_username: debounce(function () {
      this.list()
    }, 500),
    search_time: debounce(function () {
      this.list()
    }, 500),
    search_ip_address: debounce(function () {
      this.list()
    }, 500),
    search_user_agent: debounce(function () {
      this.list()
    }, 500)
  },
  methods: {
    list(paginate) {
      this.showLoading()
      paginate = paginate || `/api/login-history`
      axios
        .get(paginate, {
          params: {
            search: this.search,
            search_username: this.search_username,
            search_time: this.search_time,
            search_ip_adress: this.search_ip_address,
            start_user_agent: this.search_user_agent,
            order: this.order,
            by: this.by,
            paginate: this.paginate
          }
        })
        .then((response) => {
          this.login_history = response.data
          this.current_page = this.login_history.current_page
          Swal.close()
        })
        .catch((error) => console.log(error))
    },
    directPage: debounce(function () {
      if (this.current_page < 1) {
        this.current_page = 1
      } else if (this.current_page > this.login_history.last_page) {
        this.current_page = this.login_history.last_page
      }

      let url = new URL(this.login_history.first_page_url)
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
