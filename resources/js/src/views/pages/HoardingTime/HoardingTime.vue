<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Masa Timbun</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
              </li>
              <li class="breadcrumb-item active"><span>Masa Timbun</span></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <!-- BEGIN: Card -->
            <div class="card card-plb">
              <!-- BEGIN: Card Header -->
              <div class="card-header ui-sortable-handle">
                <h5 class="card-title card_title_margin">
                  <i class="fa-solid fa-hands-holding-circle mr-1"></i>
                  Masa Timbun
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
              <!-- END: Card Header -->

              <!-- BEGIN: Card Body -->
              <div class="card-body">
                <!-- BEGIN: Cari Data -->
                <div class="row justify-content-center">
                  <div class="col-md-6">
                    <form @submit.prevent class="form-horizontal">
                      <div class="form-group row mt-4">
                        <label for="part_number" class="col-3 col-form-label"
                          >Tahun Pelaporan</label
                        >
                        <div class="col-sm-6">
                          <datepicker
                            input-class="form-control text-center"
                            :format="DatePickerFormat"
                            minimum-view="year"
                            placeholder="Pilih Tahun Pelaporan"
                            type="year"
                            v-model="search_reporting_year"
                            autofocus
                          />
                        </div>
                      </div>
                      <div class="form-group row justify-content-center">
                        <div class="col-sm-4">
                          <button class="btn btn-primary" @click="filterYear">
                            <i class="fa-solid fa-magnifying-glass"></i> Filter
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

                <hr v-if="year_selected" />
                <!-- BEGIN: Tampil Data -->
                <div class="form-group mt-4" v-if="year_selected">
                  <div class="vgt-inner-wrap">
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
                      <div class="vgt-global-search__actions vgt-pull-right">
                        <div>
                          <!-- <button class="btn btn-secondary ms-auto rounded-1">
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
                            </button> -->
                        </div>
                      </div>
                    </div>

                    <div class="vgt-responsive">
                      <!-- BEGIN: Table -->
                      <table
                        id="vgt-table"
                        class="vgt-table bordered polar-bear"
                      >
                        <thead>
                          <tr>
                            <!-- BEGIN: Number by ID (Table Header) -->
                            <th
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
                            <!-- BEGIN: Kode BC 1.6 (Table Header) -->
                            <th
                              v-if="order == 'bc_16_code' && by == 'asc'"
                              @click="sort('bc_16_code', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">Kode BC 1.6</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else-if="order == 'bc_16_code' && by == 'desc'"
                              @click="sort('id', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">Kode BC 1.6</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else
                              @click="sort('bc_16_code', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">Kode BC 1.6</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Kode BC 1.6 (Table Header) -->
                            <!-- BEGIN: Tanggal Daftar (Table Header) -->
                            <th
                              v-if="order == 'registration_date' && by == 'asc'"
                              @click="sort('registration_date', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">Tanggal Daftar</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else-if="
                                order == 'registration_date' && by == 'desc'
                              "
                              @click="sort('id', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">Tanggal Daftar</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else
                              @click="sort('registration_date', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">Tanggal Daftar</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Tanggal Daftar (Table Header) -->
                            <!-- BEGIN: Part Number (Table Header) -->
                            <th
                              v-if="order == 'item_code' && by == 'asc'"
                              @click="sort('item_code', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">Part Number</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else-if="order == 'item_code' && by == 'desc'"
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
                              @click="sort('item_code', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">Part Number</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Part Number (Table Header) -->
                            <!-- BEGIN: Deskripsi Barang (Table Header) -->
                            <th
                              v-if="order == 'item_name' && by == 'asc'"
                              @click="sort('item_name', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">Deskripsi Barang</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else-if="order == 'item_name' && by == 'desc'"
                              @click="sort('id', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">Deskripsi Barang</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else
                              @click="sort('item_name', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">Deskripsi Barang</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Deskripsi Barang (Table Header) -->
                            <!-- BEGIN: Kode Satuan (Table Header) -->
                            <th
                              v-if="order == 'unit' && by == 'asc'"
                              @click="sort('unit', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">Kode Satuan</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else-if="order == 'unit' && by == 'desc'"
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
                              @click="sort('unit', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">Kode Satuan</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Kode Satuan (Table Header) -->
                            <!-- BEGIN: Jumlah (Table Header) -->
                            <th
                              v-if="order == 'total' && by == 'asc'"
                              @click="sort('total', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">Jumlah</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else-if="order == 'total' && by == 'desc'"
                              @click="sort('id', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">Jumlah</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else
                              @click="sort('total', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">Jumlah</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Jumlah (Table Header) -->
                            <!-- BEGIN: Status (Table Header) -->
                            <th
                              v-if="order == 'status' && by == 'asc'"
                              @click="sort('status', 'desc')"
                              class="text-center sortable sorting sorting-asc"
                            >
                              <span class="table_header">Status</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else-if="order == 'status' && by == 'desc'"
                              @click="sort('id', 'asc')"
                              class="text-center sortable sorting sorting-desc"
                            >
                              <span class="table_header">Status</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <th
                              v-else
                              @click="sort('status', 'asc')"
                              class="text-center sortable"
                            >
                              <span class="table_header">Status</span>
                              <button>
                                <span class="sr-only"></span>
                              </button>
                            </th>
                            <!-- END: Status (Table Header) -->
                          </tr>
                          <tr>
                            <th class="filter-th"></th>
                            <th class="filter-th">
                              <div>
                                <input
                                  type="text"
                                  class="vgt-input text-center"
                                  placeholder="Kode BC 1.6"
                                  v-model="search_bc_16_code"
                                />
                              </div>
                            </th>
                            <th class="filter-th">
                              <div>
                                <input
                                  type="date"
                                  class="vgt-input text-center"
                                  v-model="search_registration_date"
                                />
                              </div>
                            </th>
                            <th class="filter-th">
                              <div>
                                <input
                                  type="text"
                                  class="vgt-input text-center"
                                  placeholder="Part Number"
                                  v-model="search_item_code"
                                />
                              </div>
                            </th>
                            <th class="filter-th">
                              <div>
                                <input
                                  type="text"
                                  class="vgt-input text-center"
                                  placeholder="Deskripsi Barang"
                                  v-model="search_item_name"
                                />
                              </div>
                            </th>
                            <th class="filter-th">
                              <div>
                                <input
                                  type="text"
                                  class="vgt-input text-center"
                                  placeholder="Satuan"
                                  v-model="search_unit"
                                />
                              </div>
                            </th>
                            <th class="filter-th">
                              <div>
                                <input
                                  type="text"
                                  class="vgt-input text-center"
                                  placeholder="Total"
                                  v-model="search_total"
                                />
                              </div>
                            </th>
                            <th class="filter-th">
                              <div>
                                <input
                                  type="text"
                                  class="vgt-input text-center"
                                  placeholder="Status"
                                  v-model="search_status"
                                />
                              </div>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr
                            v-for="(
                              hoarding_times, hoarding_times_index
                            ) in hoarding_times.data"
                            :key="hoarding_times_index"
                          >
                            <td class="text-center table-content">
                              {{ hoarding_times.id }}
                            </td>
                            <td class="text-center table-content">
                              {{ hoarding_times.bc_16_code }}
                            </td>
                            <td class="text-center table-content">
                              {{ hoarding_times.registration_date | myDate }}
                            </td>
                            <td class="text-center table-content">
                              {{ hoarding_times.item_code }}
                            </td>
                            <td class="text-center table-content">
                              {{ hoarding_times.item_name }}
                            </td>
                            <td class="text-center table-content">
                              {{ hoarding_times.unit }}
                            </td>
                            <td class="text-center table-content">
                              {{ hoarding_times.total }}
                            </td>
                            <td class="text-center table-content">
                              {{ hoarding_times.status }}
                            </td>
                          </tr>
                          <tr v-if="hoarding_times.data.length < 1">
                            <td colspan="15">
                              <div class="vgt-center-align vgt-text-disabled">
                                Data not found
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <!-- END: Table -->
                    </div>
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
                            disabled: !hoarding_times.prev_page_url,
                          }"
                          @click="
                            hoarding_times.prev_page_url &&
                              list(hoarding_times.prev_page_url)
                          "
                          style="margin-right: 0px"
                        >
                          <span aria-hidden="true" class="chevron left"></span>
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
                              {{ hoarding_times.last_page }}
                            </span>
                          </label>
                        </div>
                        <button
                          type="button"
                          class="footer__navigation__page-btn"
                          :class="{
                            disabled: !hoarding_times.next_page_url,
                          }"
                          @click="
                            hoarding_times.next_page_url &&
                              list(hoarding_times.next_page_url)
                          "
                        >
                          <span style="font-weight: 500">Next</span>
                          <span aria-hidden="true" class="chevron right"></span>
                        </button>
                      </div>
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
import moment from "moment";
moment.locale("id");

export default {
  data() {
    return {
      hoarding_times: {
        data: [],
      },
      DatePickerFormat: "yyyy",

      search: null,
      search_id: "",
      search_bc_16_code: null,
      search_registration_date: null,
      search_registration_number: null,
      search_submission_number: null,
      search_date_of_filing: null,
      search_item_code: null,
      search_item_name: null,
      search_unit: null,
      search_total: null,
      search_status: null,
      search_reporting_year: null,
      year_selected: false,
      order: "id",
      by: "asc",
      paginate: "10",
      current_page: null,
    };
  },
  // created() {
  //   this.list();
  // },

  watch: {
    search: debounce(function () {
      this.list();
    }, 500),
    search_id: debounce(function () {
      this.list();
    }, 500),
    search_bc_16_code: debounce(function () {
      this.list();
    }, 500),
    search_registration_date: debounce(function () {
      this.list();
    }, 500),
    search_registration_number: debounce(function () {
      this.list();
    }, 500),
    search_submission_number: debounce(function () {
      this.list();
    }, 500),
    search_date_of_filing: debounce(function () {
      this.list();
    }, 500),
    search_item_code: debounce(function () {
      this.list();
    }, 500),
    search_item_name: debounce(function () {
      this.list();
    }, 500),
    search_unit: debounce(function () {
      this.list();
    }, 500),
    search_total: debounce(function () {
      this.list();
    }, 500),
    search_status: debounce(function () {
      this.list();
    }, 500),
  },

  methods: {
    filterYear() {
      this.year_selected = true;
      this.list();
    },
    clearForm() {
      this.search_reporting_year = null;
      this.list();
      this.year_selected = false;
    },
    list(paginate) {
      this.$Progress.start();
      paginate = paginate || `api/hoarding-time`;
      axios
        .get(paginate, {
          params: {
            search: this.search,
            search_id: this.search_id,
            search_bc_16_code: this.search_bc_16_code,
            search_registration_date: this.search_registration_date,
            search_registration_number: this.search_registration_number,
            search_submission_number: this.search_submission_number,
            search_date_of_filing: this.search_date_of_filing,
            search_item_code: this.search_item_code,
            search_item_name: this.search_item_name,
            search_unit: this.search_unit,
            search_total: this.search_total,
            search_status: this.search_status,
            search_reporting_year: this.search_reporting_year,
            order: this.order,
            by: this.by,
            paginate: this.paginate,
          },
        })
        .then((response) => {
          this.hoarding_times = response.data;
          this.current_page = this.hoarding_times.current_page;
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
      } else if (this.current_page > this.hoarding_times.last_page) {
        this.current_page = this.hoarding_times.last_page;
      }

      let url = new URL(this.hoarding_times.first_page_url);
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
