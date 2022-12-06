
<template>
  <div>
    <!-- BEGIN : Content Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Upload Mutasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link to="/dashboard">Dashboard</router-link>
              </li>
              <li class="breadcrumb-item active">Upload Mutasi</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- END : Content Header -->

    <!-- BEGIN: Content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card card-plb">
              <div class="card-header ui-sortable-handle">
                <h5 class="card-title card_title_margin">
                  <i class="nav-icon fa-solid fa-cloud-arrow-up"></i>
                  Upload Mutasi
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
                  <div class="col-md-8">
                    <form @submit.prevent class="form-horizontal">
                      <!-- BEGIN: Data Upload -->
                      <div class="form-group row mt-4">
                        <label class="col-sm-3 col-form-label"
                          >Data Upload</label
                        >
                        <div class="col-sm-8">
                          <select
                            class="form-control"
                            v-model="saldo_type"
                            :class="{
                              'is-invalid': errors.saldo_type,
                            }"
                            autofocus
                          >
                            <option value="" disabled selected>
                              Pilih Data
                            </option>
                            <option value="saldo_awal">Saldo Awal</option>
                            <option value="saldo_akhir">Saldo Akhir</option>
                          </select>
                          <span
                            v-if="errors.saldo_type"
                            class="error invalid-feedback"
                            >{{ errors.saldo_type[0] }}</span
                          >
                        </div>
                      </div>
                      <!-- END: Data Upload -->

                      <!-- BEGIN: Tanggal Saldo -->
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"
                          >Tanggal Saldo</label
                        >
                        <div class="col-sm-8">
                          <datepicker
                            :bootstrap-styling="true"
                            :placeholder="'Masukan Tanggal Saldo'"
                            :clear-button="true"
                            :clear-button-icon="'fa-solid fa-times'"
                            :format="'dd-MM-yyyy'"
                            :initial-view="'year'"
                            :input-class="{
                              'is-invalid': errors.uploaded_at,
                              'form-control': true,
                              'text-center': true,
                            }"
                            @selected="onDateChange"
                            v-model="uploaded_at"
                          >
                            <span
                              slot="afterDateInput"
                              v-if="errors.uploaded_at"
                              class="invalid-feedback"
                              >{{ errors.uploaded_at[0] }}</span
                            >
                          </datepicker>
                        </div>
                      </div>
                      <!-- END: Tanggal Saldo -->

                      <!-- BEGIN: Upload File -->
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"
                          >Upload File</label
                        >
                        <div class="col-sm-8">
                          <input
                            type="file"
                            class="form-control"
                            ref="file"
                            accept=".xlsx, .xls, .csv"
                            v-on:change="attachFile"
                            :class="{
                              'is-invalid': errors.file,
                            }"
                          />
                          <span
                            v-if="errors.file"
                            class="error invalid-feedback"
                            >{{ errors.file[0] }}</span
                          >
                        </div>
                      </div>
                      <!-- END: Upload File -->

                      <div class="form-group row justify-content-center">
                        <div class="col-sm-6">
                          <button
                            type="submit"
                            class="btn btn-success"
                            @click="uploadButton"
                          >
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            Upload
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

                <hr />
                <!-- BEGIN:: Tampil Data -->
                <div class="form-group mt-4">
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
                            @change="list()"
                          />
                        </div>
                        <!-- END: Global Search -->

                        <!-- BEGIN: Button Right -->
                        <div
                          class="vgt-global-search__actions vgt-pull-right"
                          style="margin-right: 5px"
                        ></div>
                        <!-- END: Button Right -->
                      </div>
                      <!-- BEGIN: Table Data -->
                      <div class="vgt-responsive">
                        <table
                          id="vgt-table"
                          class="vgt-table bordered polar-bear"
                        >
                          <!-- BEGIN: Thead -->
                          <thead>
                            <tr>
                              <!-- BEGIN: Tipe Saldo -->
                              <th
                                v-if="order == 'saldo_type' && by == 'asc'"
                                @click="sort('saldo_type', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Tipe Saldo</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'saldo_type' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">Tipe Saldo</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('saldo_type', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Tipe Saldo</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: List Saldo -->

                              <!-- BEGIN: Tanggal Saldo -->
                              <th
                                v-if="order == 'uploaded_at' && by == 'asc'"
                                @click="sort('uploaded_at', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Tanggal Saldo</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'uploaded_at' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">Tanggal Saldo</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('uploaded_at', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Tanggal Saldo</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Tanggal Saldo -->

                              <!-- BEGIN: Kode Barang -->
                              <th class="text-center">
                                <span class="table_header">Action</span>
                              </th>
                              <!-- END: Kode Barang -->
                            </tr>
                            <tr>
                              <!-- BEGIN: Tipe Saldo -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Tipe Saldo"
                                    v-model="search_tipe_saldo"
                                  />
                                </div>
                              </th>
                              <!-- END: Tipe Saldo -->

                              <!-- BEGIN: Tanggal Saldo -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="date"
                                    class="vgt-input text-center"
                                    placeholder="Tanggal Saldo"
                                    v-model="search_tanggal_saldo"
                                  />
                                </div>
                              </th>
                              <!-- END: Tanggal Saldo -->

                              <!-- BEGIN: Action -->
                              <th class="filter-th"></th>
                              <!-- END: Action -->
                            </tr>
                            <!-- END: Filter -->
                          </thead>
                          <!-- END: Thead -->
                          <!-- BEGIN: Tbody -->
                          <tbody>
                            <tr
                              v-for="(upload, upload_index) in uploads.data"
                              :key="upload_index"
                            >
                              <td class="text-center table_content">
                                {{ upload.saldo_type }}
                              </td>

                              <td class="text-center table_content">
                                {{ upload.uploaded_at | myDate }}
                              </td>
                              <td class="text-center table-content">
                                <a
                                  class="btn btn-primary btn-sm rounded-1"
                                  :href="`/storage/${upload.uploaded_file}`"
                                  target="_blank"
                                >
                                  <i class="fa-solid fa-download"></i> Download
                                </a>
                                <button
                                  class="btn btn-danger btn-sm rounded-1"
                                  @click="deleteData(upload.uploaded_at)"
                                >
                                  <i class="fa-solid fa-trash"></i> Delete
                                </button>
                              </td>
                            </tr>
                            <tr v-if="uploads.data.length < 1">
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
                      <!-- END: Table Data -->
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
                              disabled: !uploads.prev_page_url,
                            }"
                            @click="
                              uploads.prev_page_url &&
                                list(uploads.prev_page_url)
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
                                {{ uploads.last_page }}
                              </span>
                            </label>
                          </div>
                          <button
                            type="button"
                            class="footer__navigation__page-btn"
                            :class="{
                              disabled: !uploads.next_page_url,
                            }"
                            @click="
                              uploads.next_page_url &&
                                list(uploads.next_page_url)
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
          </div>
        </div>
      </div>
    </div>
    <!-- END: Content -->
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
      uploads: {
        data: [],
        links: [],
      },
      search: null,
      search_tipe_saldo: null,
      search_tanggal_saldo: null,
      order: "id",
      by: "desc",
      paginate: 10,
      current_page: null,

      file: "",
      saldo_type: "",
      uploaded_at: "",
      errors: [],
    };
  },
  created() {
    this.list();
  },
  watch: {
    search: debounce(function () {
      this.list();
    }, 500),
    search_tipe_saldo: debounce(function () {
      this.list();
    }, 500),
    search_tanggal_saldo: debounce(function () {
      this.list();
    }, 500),
  },
  methods: {
    list(paginate) {
      this.$Progress.start();
      paginate = paginate || `/api/get-report-mutation`;
      axios
        .get(paginate, {
          params: {
            search: this.search,
            search_tipe_saldo: this.search_tipe_saldo,
            search_tanggal_saldo: this.search_tanggal_saldo,
            order: this.order,
            by: this.by,
            paginate: this.paginate,
          },
        })
        .then((response) => {
          this.uploads = response.data;
          this.current_page = this.uploads.current_page;
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
      } else if (this.current_page > this.paginate.last_page) {
        this.current_page = this.paginate.last_page;
      }
      let url = new URL(this.users.first_page_url);
      let search_params = new URLSearchParams(url.search);
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
    deleteData(uploaded_at) {
      Swal.fire({
        title: "Apakah anda yakin?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.$Progress.start();
          axios
            .delete(`/api/delete-report-mutation/${uploaded_at}`)
            .then(() => {
              toast.fire({
                icon: "success",
                title: "Berhasil Menghapus Data",
              });
              this.list();
              this.$Progress.finish();
            })
            .catch((error) => {
              this.$Progress.fail();
              console.log(error);
            });
        }
      });
    },
    clearForm() {
      this.file = "";
      this.uploaded_at = "";
      this.saldo_type = "";
      this.errors = [];
      this.$refs.file.value = "";
    },
    uploadButton() {
      let formData = new FormData();
      formData.append("file", this.file);
      formData.append("uploaded_at", this.uploaded_at);
      formData.append("saldo_type", this.saldo_type);

      this.$Progress.start();
      axios
        .post("/api/upload-report-mutation", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.list();
          this.$Progress.finish();
          toast.fire({
            icon: "success",
            title: "Berhasil Upload Data",
          });
          this.clearForm();
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
            this.$Progress.fail();
            toast.fire({
              icon: "error",
              title: "Gagal Upload Data",
            });
          }
        });
    },
    attachFile() {
      this.file = this.$refs.file.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(this.file);
      this.errors.file = "";
    },
    onDateChange() {
      this.errors.uploaded_at = "";
    },
  },
};
</script>
<style scoped>
option {
  text-align: left;
}
select {
  text-align: center;
  text-align-last: center;
  -moz-text-align-last: center;
}
</style>