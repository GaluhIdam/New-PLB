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
              <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
              </li>
              <li class="breadcrumb-item active">
                <span>Inventory Allotment</span>
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
            <!-- BEGIN: Card -->
            <div class="card card-plb">
              <!-- BEGIN: Card Header -->
              <div class="card-header ui-sortable-handle">
                <h5 class="card-title card_title_margin">
                  <i class="nav-icon fa-solid fa-warehouse"></i>
                  Inventory Allotment
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
                <div class="row d-flex justify-content-center">
                  <div class="col-md-6">
                    <div class="form-group row mt-4">
                      <label for="plant" class="col-sm-3 col-form-label"
                        >Plant</label
                      >
                      <div class="col-sm-6">
                        <input
                          type="text"
                          class="form-control text-center"
                          placeholder="Masukan Plant"
                          v-model="filter_from_plant"
                          autofocus
                        />
                      </div>
                    </div>
                    <div class="form-group row justify-content-center">
                      <div class="col-sm-4">
                        <button class="btn btn-primary" @click="fliterPlant">
                          <i class="fa-solid fa-magnifying-glass"></i> Filter
                        </button>
                        <button class="btn btn-secondary" @click="clearForm">
                          <i class="fa-solid fa-rotate"></i> Reset
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- END: Cari Data -->

                <hr v-if="date_selected" />
                <!-- BEGIN: Tampil Data -->
                <div class="form-group mt-4" v-if="click_filter">
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
                                @click="sort('part_number', 'asc')"
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
                              <!--  -->
                              <th
                                v-if="order == 'from_plant' && by == 'asc'"
                                @click="sort('from_plant', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Plant Asal</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'from_plant' && by == 'desc'
                                "
                                @click="sort('from_plant', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Plant Asal</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('from_plant', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Plant Asal</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th
                                v-if="order == 'to_plant' && by == 'asc'"
                                @click="sort('to_plant', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Plant Tujuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'to_plant' && by == 'desc'"
                                @click="sort('to_plant', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Plant Tujuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('to_plant', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Plant Tujuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th
                                v-if="order == 'quantity' && by == 'asc'"
                                @click="sort('quantity', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Qty</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'quantity' && by == 'desc'"
                                @click="sort('quantity', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Qty</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('quantity', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Qty</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>

                              <!--  -->
                              <th
                                v-if="order == 'unit_code' && by == 'asc'"
                                @click="sort('unit_code', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Kode Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'unit_code' && by == 'desc'"
                                @click="sort('unit_code', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Kode Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('unit_code', 'asc')"
                                class="text-center sortable"
                              >
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
                                  <input
                                    type="text"
                                    class="vgt-input"
                                    placeholder="Filter part_number"
                                    v-model="search_part_number"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input"
                                    placeholder="Filter IP Address"
                                    v-model="search_from_plant"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input"
                                    placeholder="Filter IP Address"
                                    v-model="search_to_plant"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input"
                                    placeholder="Filter User Agent"
                                    v-model="search_quantity"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input"
                                    placeholder="Filter IP Address"
                                    v-model="search_unit_code"
                                  />
                                </div>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              v-for="(
                                inventory, inventory_index
                              ) in inventory_allotment.data"
                              :key="inventory_index"
                            >
                              <td class="table_content">
                                {{ inventory.id }}
                              </td>
                              <td class="table_content">
                                {{ inventory.part_number }}
                              </td>
                              <td class="table_content">
                                {{ inventory.from_plant }}
                              </td>
                              <td class="text-center table_content">
                                {{ inventory.to_plant }}
                              </td>
                              <td class="text-center table_content">
                                {{ inventory.quantity }}
                              </td>
                              <td class="text-center table_content">
                                {{ inventory.unit_code }}
                              </td>
                            </tr>
                            <tr v-if="inventory_allotment.data.length < 1">
                              <td colspan="8">
                                <div class="vgt-center-align vgt-text-disabled">
                                  Data not found
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
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
                              disabled: !inventory_allotment.prev_page_url,
                            }"
                            @click="
                              inventory_allotment.prev_page_url &&
                                list(inventory_allotment.prev_page_url)
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
                                {{ inventory_allotment.last_page }}
                              </span>
                            </label>
                          </div>
                          <button
                            type="button"
                            class="footer__navigation__page-btn"
                            :class="{
                              disabled: !inventory_allotment.next_page_url,
                            }"
                            @click="
                              inventory_allotment.next_page_url &&
                                list(inventory_allotment.next_page_url)
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

export default {
  data() {
    return {
      inventory_allotment: {
        data: [],
        links: [],
      },
      search: null,
      search_part_number: null,
      search_from_plant: null,
      search_to_plant: null,
      search_quantity: null,
      search_unit_code: null,
      click_filter: false,
      filter_from_plant: null,
      order: "id",
      by: "desc",
      paginate: "10",
      current_page: null,
    };
  },

  created() {
    this.list();
  },
  watch: {
    search: debounce(function () {
      this.list();
    }, 500),
    search_part_number: debounce(function () {
      this.list();
    }, 500),
    search_form_plant: debounce(function () {
      this.list();
    }, 500),
    search_to_plant: debounce(function () {
      this.list();
    }, 500),
    search_quantity: debounce(function () {
      this.list();
    }, 500),
    search_unit_code: debounce(function () {
      this.list();
    }, 500),
  },
  methods: {
    list(paginate) {
      this.showLoading();
      paginate = paginate || `/api/inventory-allotment`;
      axios
        .get(paginate, {
          params: {
            filter_from_plant: this.filter_from_plant,
            search: this.search,
            search_part_number: this.search_part_number,
            search_from_plant: this.search_from_plant,
            search_to_plant: this.search_to_plant,
            start_quantity: this.search_quantity,
            start_unit_code: this.search_unit_code,
            order: this.order,
            by: this.by,
            paginate: this.paginate,
          },
        })
        .then((response) => {
          this.inventory_allotment = response.data;
          this.current_page = this.inventory_allotment.current_page;
          //console.log(this.inventory_allotment)
          Swal.close();
        })
        .catch((error) => console.log(error));
    },
    fliterPlant() {
      this.click_filter = true;
      this.list();
    },
    clearForm() {
      this.filter_from_plant = null;
      this.list();
      this.click_filter = false;
    },
    directPage: debounce(function () {
      if (this.current_page < 1) {
        this.current_page = 1;
      } else if (this.current_page > this.inventory_allotment.last_page) {
        this.current_page = this.inventory_allotment.last_page;
      }

      let url = new URL(this.inventory_allotment.first_page_url);
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

    showLoading() {
      Swal.fire({
        didOpen: () => {
          Swal.showLoading();
        },
        background: "transparent",
        allowOutsideClick: false,
      });
    },
  },
};
</script>
<style scoped>
.vgt-global-search__input .input__icon .magnifying-glass {
  margin-top: -3px;
}
</style>
