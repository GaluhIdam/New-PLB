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
                <div class="row justify-content-center">
                  <div class="col-md-8">
                    <form @submit.prevent class="form-horizontal">
                      <div class="form-group row mt-4">
                        <label class="col-sm-3 col-form-label">Plant</label>
                        <div class="col-sm-8">
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Masukkan Plant"
                            v-model="filter_plant"
                            autofocus
                          />
                        </div>
                      </div>

                      <!-- BEGIN: Filter and Reset Button -->
                      <div class="form-group row justify-content-center">
                        <div class="col-sm-6">
                          <button class="btn btn-primary" @click="filterButton">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Filter
                          </button>
                          <button class="btn btn-secondary" @click="clearForm">
                            <i class="fa-solid fa-rotate"></i> Reset
                          </button>
                        </div>
                      </div>
                      <!-- END: Filter and Reset Button -->
                    </form>
                  </div>
                </div>
                <!-- END: Cari Data -->
                <hr />

                <!-- BEGIN: Tampil Data -->
                <div class="form-group mt-4">
                  <div class="vgt-wrap polar-bear">
                    <div class="vgt-inner-wrap">
                      <!-- BEGIN: Search and Export Button -->
                      <div class="vgt-global-search vgt-clearfix">
                        <!-- BEGIN: Global Search -->
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
                        <!-- END: Global Search -->
                        <!-- BEGIN : Right Button (Export) -->
                        <div
                          class="vgt-global-search__actions vgt-pull-right"
                          v-if="$gate.isAdminOrPlanner()"
                        >
                          <div>
                            <button
                              class="btn btn-secondary ms-auto rounded-1"
                              @click="exportCsv"
                            >
                              <i class="fa-solid fa-file-csv"></i>
                              CSV
                            </button>
                            <button
                              class="btn btn-secondary ms-auto rounded-1"
                              style="margin-right: 10px"
                              @click="exportExcel"
                            >
                              <i class="fa-solid fa-file-excel"></i>
                              Excel
                            </button>
                            <!-- <button
                              class="btn btn-secondary ms-auto rounded-1"
                              style="margin-right: 10px"
                            >
                              <i class="fa-solid fa-file-pdf"></i>
                              PDF
                            </button> -->
                          </div>
                        </div>
                        <div
                          v-else
                          class="vgt-global-search__actions vgt-pull-right"
                          style="margin-right: 5px"
                        ></div>
                        <!-- END : Right Button (Export) -->
                      </div>
                      <!-- END: Search and Export Button -->

                      <!-- BEGIN: Table -->
                      <div class="vgt-responsive">
                        <table
                          id="vgt-table"
                          class="vgt-table bordered polar-bear"
                        >
                          <!-- BEGIN: Table Header -->
                          <thead>
                            <!-- BEGIN: Table Sort & Label -->
                            <tr>
                              <!-- BEGIN: ID (Table Sort & Label) -->
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
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
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
                              <!-- END: ID (Table Sort & Label) -->

                              <!-- BEGIN: Part Number (Table Sort & Label) -->
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
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
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
                              <!-- END: Part Number (Table Sort & Label) -->

                              <!-- BEGIN: Plant Asal (Table Sort & Label) -->
                              <th
                                v-if="order == 'plant_origin' && by == 'asc'"
                                @click="sort('plant_origin', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Plant Asal</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'plant_origin' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">Plant Asal</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('plant_origin', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Plant Asal</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Plant Asal (Table Sort & Label) -->

                              <!-- BEGIN: Plant Tujuan (Table Sort & Label) -->
                              <th
                                v-if="
                                  order == 'plant_destination' && by == 'asc'
                                "
                                @click="sort('plant_destination', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Plant Tujuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'plant_destination' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">Plant Tujuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('plant_destination', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Plant Tujuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Plant Tujuan (Table Sort & Label) -->

                              <!-- BEGIN: Quantity (Table Sort & Label) -->
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
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
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
                              <!-- END: Quantity (Table Sort & Label) -->

                              <!-- BEGIN: Kode Satuan (Table Sort & Label) -->
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
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
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
                              <!-- END: Kode Satuan (Table Sort & Label) -->
                            </tr>
                            <!-- END: Table Sort & Label -->

                            <!-- BEGIN: Table Filter -->
                            <tr>
                              <th class="filter-th"></th>
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
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Plant Asal"
                                    v-model="search_plant_origin"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Plant Tujuan"
                                    v-model="search_plant_destination"
                                  />
                                </div>
                              </th>
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
                            </tr>
                            <!-- END: Table Filter -->
                          </thead>
                          <!-- END: Table Header -->

                          <!-- BEGIN: Table Data -->
                          <tbody>
                            <tr
                              v-for="(
                                inventory, inventory_index
                              ) in inventorys.data"
                              :key="inventory_index"
                            >
                              <td class="text-center table_content">
                                {{ inventory.id }}
                              </td>
                              <td class="text-center table_content">
                                {{ inventory.part_number }}
                              </td>
                              <td class="text-center table_content">
                                {{ inventory.plant_origin }}
                              </td>
                              <td class="text-center table_content">
                                {{ inventory.search_plant_destination }}
                              </td>
                              <td class="text-center table_content">
                                {{ inventory.quantity }}
                              </td>
                              <td class="text-center table_content">
                                {{ inventory.unit_measure }}
                              </td>
                            </tr>
                            <tr v-if="inventorys.data.length < 1">
                              <td colspan="8">
                                <div class="vgt-center-align vgt-text-disabled">
                                  Data not found
                                </div>
                              </td>
                            </tr>
                          </tbody>
                          <!-- END: Table Data -->
                        </table>
                      </div>
                      <!-- END: Table -->

                      <!-- BEGIN: Table Footer -->
                      <div class="vgt-wrap__footer vgt-clearfix">
                        <div class="footer__row-count vgt-pull-left">
                          <label
                            class="footer__row-count__label row_per_page_label"
                          >
                            Rows per page:
                          </label>
                          <select
                            class="
                              footer__row-count__select
                              row_per_page_option
                            "
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
                              disabled: !inventorys.prev_page_url,
                            }"
                            @click="
                              inventorys.prev_page_url &&
                                list(inventorys.prev_page_url)
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
                                class="
                                  footer__navigation__page-info__current-entry
                                  vgt-input
                                "
                                v-model="current_page"
                                @keypress="directPage"
                                style="width: 60px"
                              />
                              <span class="paginate_text">
                                of
                                {{ inventorys.last_page }}
                              </span>
                            </label>
                          </div>
                          <button
                            type="button"
                            class="footer__navigation__page-btn"
                            :class="{
                              disabled: !inventorys.next_page_url,
                            }"
                            @click="
                              inventorys.next_page_url &&
                                list(inventorys.next_page_url)
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
                      <!-- END: Table Footer -->
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
      inventorys: {
        data: [],
        links: [],
      },
      // Search Data
      search: null, // Search All Data
      search_part_number: null, // Search Part Number
      search_plant_origin: null, // Search Plant Asal
      search_plant_destination: null, // Search Plant Tujuan
      search_quantity: null, // Search Quantity
      search_unit_measure: null, // Search Kode Satuan

      // Order By
      order: "id",
      by: "desc",
      paginate: "10",
      current_page: null,

      // Filter
      filter_start_date: null,
      filter_end_date: null,
      filter_plant: null,
    };
  },
  methods: {
    list(paginate) {
      this.$Progress.start();
      paginate = paginate || `/api/inventory-allotment`;
      axios
        .get(paginate, {
          params: {
            search_part_number: this.search_part_number,
            search_plant: this.search_plant,
            search_material_document: this.search_material_document,
            search_total: this.search_total,
            search_unit_measure: this.search_unit_measure,
            filter_plant: this.filter_plant,

            order: this.order,
            by: this.by,
            paginate: this.paginate,
          },
        })
        .then((response) => {
          this.inventorys = response.data;
          this.current_page = this.inventorys.current_page;
          this.$Progress.finish();
        })
        .catch((error) => {
          this.$Progress.fail();
          console.log(error);
        });
    },
    filterButton() {
      this.filter_clicked = true;
      this.list();
    },
    clearForm() {
      this.filter_plant = null;
      this.list();
      this.filter_clicked = false;
    },

    directPage: debounce(function () {
      if (this.current_page < 1) {
        this.current_page = 1;
      } else if (this.current_page > this.inventorys.last_page) {
        this.current_page = this.inventorys.last_page;
      }

      let url = new URL(this.inventorys.first_page_url);
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
