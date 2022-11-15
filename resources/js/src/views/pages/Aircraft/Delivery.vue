<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Aircraft Delivery</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link :to="{ name: 'dashboard' }">Dashboard</router-link>
              </li>
              <li class="breadcrumb-item">
                <router-link :to="{ name: 'aircraft-mutation' }"
                  >Aircraft Mutation</router-link
                >
              </li>
              <li class="breadcrumb-item active">Aircraft Delivery</li>
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
                  <i class="fas fa-plane-circle-exclamation mr-1"></i>
                  Aircraft Delivery
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
              <form @submit.prevent="create" class="form-horizontal">
                <div class="card-body">
                  <!-- BEGIN: Aircraft Registration -->
                  <div class="form-group row">
                    <label for="reg" class="col-sm-2 col-form-label"
                      >Aircraft Registration</label
                    >
                    <div class="col-sm-4">
                      <input
                        type="text"
                        class="form-control"
                        :class="{
                          'is-invalid': errors.reg,
                        }"
                        v-model="reg"
                        placeholder="Masukan Aircraft Registration"
                        autofocus
                      />
                      <span v-if="errors.reg" class="error invalid-feedback">{{
                        errors.reg[0]
                      }}</span>
                    </div>
                  </div>
                  <!-- END: Aircraft Registration -->
                  <!-- BEGIN: Aircraft Type -->
                  <div class="form-group row mt-4">
                    <label for="type" class="col-sm-2 col-form-label"
                      >Aircraft Type</label
                    >
                    <div class="col-sm-4">
                      <input
                        type="text"
                        class="form-control"
                        :class="{
                          'is-invalid': errors.type,
                        }"
                        v-model="type"
                        placeholder="Masukan Aircraft Type"
                      />
                      <span v-if="errors.type" class="error invalid-feedback">{{
                        errors.type[0]
                      }}</span>
                    </div>
                  </div>
                  <!-- END: Aircraft Type -->
                  <!-- BEGIN: Operator -->
                  <div class="form-group row mt-4">
                    <label for="operator" class="col-sm-2 col-form-label"
                      >Operator</label
                    >
                    <div class="col-sm-4">
                      <input
                        type="text"
                        class="form-control"
                        :class="{
                          'is-invalid': errors.operator,
                        }"
                        v-model="operator"
                        placeholder="Masukan Operator"
                      />
                      <span
                        v-if="errors.operator"
                        class="error invalid-feedback"
                        >{{ errors.operator[0] }}</span
                      >
                    </div>
                  </div>
                  <!-- END: Operator -->
                  <!-- BEGIN: Actual Time Arrival -->
                  <div class="form-group row mt-4">
                    <label class="col-sm-2 col-form-label"
                      >Actual Time Arrival</label
                    >
                    <div class="col-sm-4">
                      <input
                        type="datetime-local"
                        class="form-control"
                        :class="{
                          'is-invalid': errors.date_in,
                        }"
                        v-model="date_in"
                      />
                      <span
                        v-if="errors.date_in"
                        class="error invalid-feedback"
                        >{{ errors.date_in[0] }}</span
                      >
                    </div>
                  </div>
                  <!-- END: Actual Time Arrival -->
                  <!-- BEGIN: Upload RKSP -->
                  <div class="form-group row mt-4">
                    <label class="col-sm-2 col-form-label">RKSP</label>
                    <div class="col-md-4">
                      <input
                        type="file"
                        v-on:change="attachFile"
                        ref="rksp"
                        class="form-control"
                        :class="{
                          'is-invalid': errors.rksp,
                        }"
                      />
                    </div>
                  </div>
                  <!-- END: Upload RKSP -->
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save"></i> Save
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      operator: "",
      type: "",
      reg: "",
      date_in: "",
      rksp: "",
      errors: [],
    };
  },
  methods: {
    create() {
      let formData = new FormData();
      formData.append("operator", this.operator);
      formData.append("type", this.type);
      formData.append("reg", this.reg);
      formData.append("date_in", this.date_in);
      formData.append("rksp", this.rksp);

      axios
        .post("/api/aircraft-delivery", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((data) => {
          this.$router.push({ name: "aircraft-mutation" });
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
    clearForm() {
      this.operator = null;
      this.type = null;
      this.reg = null;
      this.date_in = null;
      this.rksp = "";
      this.errors = [];
    },
    attachFile() {
      this.rksp = this.$refs.rksp.files[0];
      let reader = new FileReader();

      reader.readAsDataURL(this.rksp);
    },
  },
};
</script>
