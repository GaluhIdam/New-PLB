<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Activity History</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item active">
                <a href="/activity-history">Activity Histroy</a>
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
                  <i class="nav-icon fa-solid fa-server"></i>
                  Activity History
                </h5>
                <div class="card-tools">
                  <button type="button" data-card-widget="collapse" class="btn btn-tool">
                    <i class="fas fa-minus"></i>
                  </button>
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
                          <input type="text" placeholder="Search Data" class="vgt-input vgt-pull-left"
                            v-model="search" />
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
                        <table id="vgt-table" class="vgt-table bordered polar-bear">
                          <thead>
                            <tr>
                              <!--  -->
                              <th v-if="order == 'id' && by == 'asc'" @click="sort('id', 'desc')"
                                class="text-center sortable sorting sorting-asc">
                                <span class="table_header">No.</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'id' && by == 'desc'" @click="sort('id', 'asc')" class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                ">
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
                              <th v-if="order == 'username' && by == 'asc'" @click="sort('username', 'desc')"
                                class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Username</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'username' && by == 'desc'" @click="sort('id', 'desc')" class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                ">
                                <span class="table_header">Username</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('username', 'asc')" class="text-center sortable">
                                <span class="table_header">Username</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th v-if="order == 'time' && by == 'asc'" @click="sort('time', 'desc')"
                                class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Date</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'time' && by == 'desc'" @click="sort('id', 'desc')" class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                ">
                                <span class="table_header">Date</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('time', 'asc')" class="text-center sortable">
                                <span class="table_header">Date</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                              <th v-if="order == 'activity' && by == 'asc'" @click="sort('activity', 'desc')"
                                class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Last Activity</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'activity' && by == 'desc'" @click="sort('id', 'desc')" class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                ">
                                <span class="table_header">Last Activity</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('activity', 'asc')" class="text-center sortable">
                                <span class="table_header">Last Activity</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  -->
                            </tr>
                            <tr>
                              <th class="filter-th"></th>
                              <th class="filter-th text-center">
                                <div>
                                  <input type="text" class="vgt-input text-center" placeholder="Search Username"
                                    v-model="search_username" />
                                </div>
                              </th>
                              <th class="filter-th text-center">
                                <div>
                                  <input type="date" class="vgt-input text-center" v-model="search_time" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input text-center" placeholder="Search Activity"
                                    v-model="search_activity" />
                                </div>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(
                                activity, activity_index
                              ) in activities.data" :key="activity_index">
                              <td class="text-center table_content">
                                {{ activity.id }}
                              </td>
                              <td class="text-center table_content">
                                {{ activity.username }}
                              </td>
                              <td class="text-center table_content">
                                {{ activity.time | myDateTime }}
                              </td>
                              <td class="text-center table_content">
                                {{ activity.activity }}
                              </td>
                            </tr>
                            <tr v-if="activities.data.length < 1">
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
                          <select class="
                              footer__row-count__select
                              row_per_page_option
                            " v-model="paginate" @change="list()">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                          </select>
                        </div>
                        <div class="footer__navigation vgt-pull-right">
                          <button type="button" class="footer__navigation__page-btn" :class="{
                            disabled: !activities.prev_page_url,
                          }" @click="
  activities.prev_page_url &&
  list(activities.prev_page_url)
" style="margin-right: 0px">
                            <span aria-hidden="true" class="chevron left"></span>
                            <span class="paginate_text">Prev</span>
                          </button>
                          <div class="footer__navigation__page-info" style="color: #99a0b2">
                            <label class="page-info__label" style="margin-bottom: -5px">
                              <span class="paginate_text">page</span>
                              <input type="text" class="
                                  footer__navigation__page-info__current-entry
                                  vgt-input
                                " v-model="current_page" @keypress="directPage" style="width: 60px" />
                              <span class="paginate_text">
                                of
                                {{ activities.last_page }}
                              </span>
                            </label>
                          </div>
                          <button type="button" class="footer__navigation__page-btn" :class="{
                            disabled: !activities.next_page_url,
                          }" @click="
  activities.next_page_url &&
  list(activities.next_page_url)
">
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
      activities: {
        data: [],
        links: [],
      },
      search: null,
      search_username: null,
      search_time: null,
      search_activity: null,
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
    search_id: debounce(function () {
      this.list();
    }, 500),
    search_username: debounce(function () {
      this.list();
    }, 500),
    search_activity: debounce(function () {
      this.list();
    }, 500),
    search_time: debounce(function () {
      this.list();
    }, 0),
  },
  methods: {
    showLoading() {
      Swal.fire({
        didOpen: () => {
          Swal.showLoading();
        },
        background: "transparent",
        allowOutsideClick: false,
      });
    },
    showSuccessRequest() {
      Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: 'Successfully Retrieve Data',
        showConfirmButton: false,
        timer: 1500
      })
    },
    showErrorRequest() {
      Swal.fire({
        toast: true,
        position: "top-end",
        icon: "error",
        title: "Failed to Retrieve Data",
        showConfirmButton: false,
        timer: 1500,
      });
    },
    list(paginate) {
      this.showLoading()
      paginate = paginate || `/api/activity-history`;
      axios
        .get(paginate, {
          params: {
            search: this.search,
            search_username: this.search_username,
            search_time: this.search_time,
            search_activity: this.search_activity,
            order: this.order,
            by: this.by,
            paginate: this.paginate,
          },
        })
        .then((response) => {
          this.activities = response.data;
          this.current_page = this.activities.current_page;
          Swal.close()
          this.showSuccessRequest()
        })
        .catch((error) => {
          Swal.close()
          this.showErrorRequest()
          console.log(error);
        });
    },
    directPage: debounce(function () {
      if (this.current_page < 1) {
        this.current_page = 1;
      } else if (this.current_page > this.activities.last_page) {
        this.current_page = this.activities.last_page;
      }

      let url = new URL(this.activities.first_page_url);
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
