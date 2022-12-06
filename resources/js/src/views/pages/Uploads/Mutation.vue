
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
                  <!-- <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Data Upload</label>
                    <div class="col-sm-4">
                      <select class="form-control" autofocus>
                        <option value="1">Saldo Awal</option>
                        <option value="2">
                          Saldo Stock Opname/Saldo Akhir
                        </option>
                      </select>
                    </div>
                  </div> -->

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
                        :input-class="'form-control'"
                        :format="'dd-MM-yyyy'"
                        :initial-view="'year'"
                        v-model="imported_at"
                      />
                    </div>
                  </div>
                  <!-- END: Tanggal Saldo -->

                  <!-- BEGIN: Upload File -->
                  <div class="form-group row mt-4">
                    <label class="col-sm-2 col-form-label">Upload File</label>
                    <div class="col-md-4">
                      <input
                        type="file"
                        class="form-control"
                        ref="file"
                        accept=".xlsx, .xls, .csv"
                        v-on:change="attachFile"
                        :class="{
                          'is-invalid': erros.file,
                        }"
                      />
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
import moment from "moment";
import Swal from "sweetalert2";
moment.locale("id");

export default {
  data() {
    return {
      file: "",
      imported_at: "",
      erros: [],
    };
  },
  methods: {
    create() {
      let formData = new FormData();
      formData.append("file", this.file);
      formData.append("imported_at", this.imported_at);
      this.$Progress.start();
      axios
        .post("/api/upload-report-mutation", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.$Progress.finish();
          Swal.fire({
            title: "Berhasil",
            text: "Data berhasil diupload",
            icon: "success",
            confirmButtonText: "OK",
          });
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.erros = error.response.data.errors;
            this.$Progress.fail();
            console.log(error);
          }
        });
    },
    attachFile() {
      this.file = this.$refs.file.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(this.file);
    },
    clearForm() {
      this.$refs.file.value = "";
      this.file = "";
      this.imported_at = null;
      this.erros = [];
    },
  },
};
</script>