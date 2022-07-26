<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Aircraft Redelivery</h1>
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
              <li class="breadcrumb-item active">Aircraft Redelivery</li>
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
                  Aircraft Redelivery
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
                      >A/C Registration</label
                    >
                    <div class="col-sm-4">
                      <multiselect
                        v-model="selected_mutation"
                        id="ajax"
                        :custom-label="mutationLabel"
                        track-by="id"
                        placeholder="Pilih A/C Registration"
                        open-direction="bottom"
                        :options="mutations"
                        :multiple="false"
                        :searchable="true"
                        :loading="isLoading"
                        :internal-search="false"
                        :clear-on-select="false"
                        :close-on-select="true"
                        :options-limit="300"
                        :max-height="600"
                        :show-no-results="false"
                        @search-change="findMutation"
                        @select="selectedMutation"
                      ></multiselect>
                      <span v-if="errors.reg" class="text-danger">{{
                        errors.reg[0]
                      }}</span>
                    </div>
                  </div>
                  <!-- END: Aircraft Registration -->
                  <!-- BEGIN: Aircraft Type -->
                  <div class="form-group row mt-4">
                    <label for="type" class="col-sm-2 col-form-label"
                      >A/C Type</label
                    >
                    <div class="col-sm-4">
                      <input type="text" class="form-control" v-model="type" />
                      <span v-if="errors.type" class="text-danger">{{
                        errors.type[0]
                      }}</span>
                    </div>
                  </div>
                  <!-- END: Aircraft Type -->
                  <!-- BEGIN: Operator -->
                  <div class="form-group row mt-4">
                    <label class="col-sm-2 col-form-label">Operator</label>
                    <div class="col-sm-4">
                      <input
                        type="text"
                        class="form-control"
                        v-model="operator"
                      />
                      <span v-if="errors.operator" class="text-danger">{{
                        errors.operator[0]
                      }}</span>
                    </div>
                  </div>
                  <!-- END: Operator -->
                  <!-- BEGIN: Actual Time Departure -->
                  <div class="form-group row mt-4">
                    <label class="col-sm-2 col-form-label"
                      >Actual Time Depart</label
                    >
                    <div class="col-sm-4">
                      <input
                        type="datetime-local"
                        class="form-control"
                        v-model="date_out"
                      />
                      <span v-if="errors.date_out" class="text-danger">{{
                        errors.date_out[0]
                      }}</span>
                    </div>
                  </div>
                  <!-- END: Actual Time Departure -->
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
      reg: null,
      operator: null,
      type: null,
      date_out: null,
      errors: [],

      mutations: [],
      selected_mutation: null,
      isLoading: false,
    };
  },
  created() {
    this.initMutation();
  },
  methods: {
    create() {
      axios
        .post("/api/aircraft/redelivery", {
          reg: this.reg,
          operator: this.operator,
          type: this.type,
          date_out: this.date_out,
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
      this.reg = null;
      this.operator = null;
      this.type = null;
      this.date_out = null;
      this.status = null;
      this.errors = [];
      this.selected_mutation = null;
    },
    initMutation() {
      this.isLoading = true;

      axios.get("/api/aircraft/data").then((response) => {
        this.mutations = response.data;
        this.isLoading = false;
      });
    },
    findMutation(keyword) {
      this.isLoading = true;

      axios
        .get("/api/aircraft/data", {
          params: {
            search: keyword,
          },
        })
        .then((response) => {
          this.mutations = response.data;
          this.isLoading = false;
        });
    },
    mutationLabel({ reg }) {
      return `${reg}`;
    },
    selectedMutation({ reg, operator, type }) {
      this.reg = reg;
      this.operator = operator;
      this.type = type;
    },
  },
};
</script>
<style scoped>
.multiselect__placeholder {
  display: inline-block !important;
  margin-bottom: 0px !important;
  padding-top: 0px !important;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.multiselect.invalid .multiselect__tags {
  border: 1px solid #f86c6b !important;
}

.multiselect__option--highlight {
  background: #428bca !important;
}

.multiselect__option--highlight:after {
  background: #428bca !important;
}

.multiselect__tags {
  padding: 5px !important;
  min-height: 10px;
}

.multiselect__placeholder {
  margin-left: 10px;
  margin-top: 2px;
}

.multiselect__tag {
  background: #f0f0f0 !important;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  color: black !important;
  margin-bottom: 0px !important;
  margin-right: 5px !important;
}

.multiselect__tag-icon:after {
  color: rgba(60, 60, 60, 0.5) !important;
}

.multiselect__tag-icon:focus,
.multiselect__tag-icon:hover {
  background: #f0f0f0 !important;
}

.multiselect__tag-icon:focus:after,
.multiselect__tag-icon:hover:after {
  color: red !important;
}
.form-control {
  display: block;
  width: 100%;
  height: calc(1.5em + 0.75rem + 2px);
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
</style>
