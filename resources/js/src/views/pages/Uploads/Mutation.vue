
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
                <router-link :to="{ name: 'dashboard' }">Dashboard</router-link>
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
              <form @submit.prevent="create" class="form-horizontal">
                <div class="card-body">
                  <!-- BEGIN: Data Upload -->
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Data Upload</label>
                    <div class="col-sm-4">
                      <select
                        class="form-control"
                        v-model="selectSaldo"
                        autofocus
                      >
                        <option value="saldo_awal">Saldo Awal</option>
                        <option value="saldo_akhir">Saldo Akhir</option>
                      </select>
                    </div>
                  </div>

                  <!-- END: Data Upload -->

                  <!-- BEGIN: Tanggal Saldo -->
                  <div class="form-group row mt-4">
                    <label class="col-sm-2 col-form-label">Tanggal Saldo</label>
                    <div class="col-sm-4">
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
                  <div class="form-group row mt-4">
                    <label class="col-sm-2 col-form-label">Upload File</label>
                    <div class="col-sm-4">
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
                      <span v-if="errors.file" class="error invalid-feedback">{{
                        errors.file[0]
                      }}</span>
                    </div>
                  </div>
                  <!-- END: Upload File -->
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-upload"></i> Upload
                  </button>

                  <button
                    type="button"
                    class="btn btn-secondary"
                    @click="clearForm"
                  >
                    <i class="fa-solid fa-rotate"></i> Reset
                  </button>
                </div>
              </form>
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
      file: "",
      selectSaldo: "saldo_awal",
      uploaded_at: "",
      errors: [],
    };
  },
  methods: {
    create() {
      let formData = new FormData();
      formData.append("file", this.file);
      formData.append("uploaded_at", this.uploaded_at);
      formData.append("selectSaldo", this.selectSaldo);

      this.$Progress.start();
      axios
        .post("/api/upload-report-mutation", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.$Progress.finish();
          toast
            .fire({
              icon: "success",
              title: "Berhasil Upload Data",
            })
            .then((result) => {
              this.clearForm();
            });
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          this.$Progress.fail();
          toast.fire({
            icon: "error",
            title: "Gagal Upload Data",
          });
          console.log(this.errors);
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
      console.log(this.uploaded_at);
    },
    clearForm() {
      this.$refs.file.value = "";
      this.file = "";
      this.uploaded_at = "";
      this.errors = [];
    },
  },
};
</script>