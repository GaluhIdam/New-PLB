<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Aircraft Mutation</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link
                  :to="{
                    name: 'dashboard',
                  }"
                >
                  Dashboard
                </router-link>
              </li>
              <li class="breadcrumb-item active">
                <span>Aircraft Mutation</span>
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
                  <i class="fas fa-plane-circle-exclamation mr-1"></i>
                  Aircraft Mutation
                </h5>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item"></li>
                  </ul>
                </div>
              </div>
              <div class="card-body">
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
                          <input
                            type="text"
                            placeholder="Search Data"
                            class="vgt-input vgt-pull-left"
                            v-model="search"
                          />
                        </div>
                        <div
                          class="vgt-global-search__actions vgt-pull-right"
                          v-if="$gate.isAdminOrPlanner()"
                        >
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

                            <router-link
                              :to="{
                                name: 'aircraft-delivery',
                              }"
                              class="btn btn-primary btn-md"
                              style="margin-right: 10px"
                            >
                              <i class="fa-solid fa-plus"></i>
                              New Delivery
                            </router-link>
                          </div>
                        </div>

                        <div
                          class="vgt-global-search__actions vgt-pull-right"
                          v-if="$gate.isUser()"
                        >
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
                      </div>
                      <div class="vgt-responsive">
                        <table id="vgt-table" class="vgt-table bordered polar-bear">
                          <thead>
                            <tr>
                              <!--  -->
                              <th
                                v-if="order == 'reg' && by == 'asc'"
                                @click="sort('reg', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">A/C Reg</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'reg' && by == 'desc'"
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">A/C Reg</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('reg', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">A/C Reg</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th
                                v-if="order == 'operator' && by == 'asc'"
                                @click="sort('operator', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Operator</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'operator' && by == 'desc'"
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Operator</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('operator', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Operator</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th
                                v-if="order == 'type' && by == 'asc'"
                                @click="sort('type', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">A/C Type</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'type' && by == 'desc'"
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">A/C Type</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('type', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">A/C Type</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th
                                v-if="order == 'date_in' && by == 'asc'"
                                @click="sort('date_in', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Date In</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'date_in' && by == 'desc'"
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Date In</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('date_in', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Date In</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th
                                v-if="order == 'date_out' && by == 'asc'"
                                @click="sort('date_out', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Date Out</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'date_out' && by == 'desc'"
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Date Out</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('date_out', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Date Out</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th class="text-center">
                                <span class="table_header">RKSP</span>
                              </th>
                              <th class="text-center">
                                <span class="table_header">RKSP</span>
                              </th>
                              <th class="text-center">
                                <span class="table_header">Action</span>
                              </th>
                            </tr>
                            <tr>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input"
                                    placeholder="Filter A/C Reg"
                                    v-model="search_reg"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input"
                                    placeholder="Filter Operator"
                                    v-model="search_operator"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input"
                                    placeholder="Filter A/C Type"
                                    v-model="search_type"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="date"
                                    class="vgt-input"
                                    v-model="search_date_in"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="date"
                                    class="vgt-input"
                                    v-model="search_date_out"
                                  />
                                </div>
                              </th>
                              <th class="filter-th"></th>
                              <th class="filter-th"></th>
                              <th class="filter-th"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              v-for="(mutation, mutation_index) in mutations.data"
                              :key="mutation_index"
                            >
                              <td class="table_content">{{ mutation.reg }}</td>
                              <td class="table_content">{{ mutation.operator }}</td>
                              <td class="table_content">{{ mutation.type }}</td>
                              <td class="text-center table_content">
                                {{ mutation.date_in | formatDate }}
                              </td>
                              <td class="text-center table_content">
                                {{ mutation.date_out | formatDate }}
                              </td>
                              <td class="text-center">
                                <a
                                  v-if="mutation.rksp != null"
                                  :href="`/storage/${mutation.rksp}`"
                                  target="_blank"
                                  ><h4><i class="fa-solid fa-file-pdf"></i></h4
                                ></a>
                              </td>
                              <td class="table_content">
                                <span v-if="mutation.date_out"> Keluar PLB GMF​ </span>
                                <span v-else> Di dalam PLB GMF​ </span>
                              </td>
                              <td class="text-center">
                                <ul class="list-inline m-0">
                                  <li class="list-inline-item">
                                    <a
                                      @click="deleteData(mutation.id)"
                                      class="text-danger"
                                      ><h5><i class="fa-solid fa-trash"></i></h5
                                    ></a>
                                  </li>
                                </ul>
                              </td>
                            </tr>
                            <tr v-if="mutations.data.length < 1">
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
                              disabled: !mutations.prev_page_url,
                            }"
                            @click="
                              mutations.prev_page_url && list(mutations.prev_page_url)
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
                                {{ mutations.last_page }}
                              </span>
                            </label>
                          </div>
                          <button
                            type="button"
                            class="footer__navigation__page-btn"
                            :class="{
                              disabled: !mutations.next_page_url,
                            }"
                            @click="
                              mutations.next_page_url && list(mutations.next_page_url)
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
  </div>
</template>

<script>
import axios from "axios";
import debounce from "lodash/debounce";
import Swal from "sweetalert2";

export default {
  data() {
    return {
      mutations: {
        data: [],
        links: [],
      },
      search: null,
      search_reg: null,
      search_operator: null,
      search_type: null,
      search_date_in: null,
      search_date_out: null,
      start_date: null,
      end_date: null,
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
    search_reg: debounce(function () {
      this.list();
    }, 500),
    search_operator: debounce(function () {
      this.list();
    }, 500),
    search_type: debounce(function () {
      this.list();
    }, 500),
    search_date_in: debounce(function () {
      this.list();
    }, 0),
    search_date_out: debounce(function () {
      this.list();
    }, 0),
  },
  methods: {
    list(paginate) {
      this.showLoading();
      paginate = paginate || `/api/aircraft`;
      axios
        .get(paginate, {
          params: {
            search: this.search,
            search_reg: this.search_reg,
            search_operator: this.search_operator,
            search_type: this.search_type,
            search_date_in: this.search_date_in,
            search_date_out: this.search_date_out,
            start_date: this.start_date,
            end_date: this.end_date,
            order: this.order,
            by: this.by,
            paginate: this.paginate,
          },
        })
        .then((response) => {
          this.mutations = response.data;
          this.current_page = this.mutations.current_page;
          Swal.close();
        })
        .catch((error) => console.log(error));
    },
    directPage: debounce(function () {
      if (this.current_page < 1) {
        this.current_page = 1;
      } else if (this.current_page > this.mutations.last_page) {
        this.current_page = this.mutations.last_page;
      }

      let url = new URL(this.mutations.first_page_url);
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
    deleteData(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#17816d",
        cancelButtonColor: "#f04040",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.showLoading();
          axios
            .delete(`/api/aircraft/${id}`)
            .then((response) => {
              this.list();
              Swal.close();
            })
            .catch((error) => console.log(error));
        }
      });
    },
  },
};
</script>
