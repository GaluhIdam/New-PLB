<template>
  <div class="container-fluid" style="margin-top: 20px">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h1>Aircraft Redelivery</h1>
            <hr />

            <form @submit.prevent="create" class="form-horizontal">
              <div class="card-body">
                <div class="row g-3 align-items-center">
                  <div class="col-md-2">
                    <label for="acreg" class="form-label">A/C Registration</label>
                  </div>
                  <div class="col-sm-5">
                    <div class="dropdown">
                      <button
                        class="btn btn-outline-primary dropdown-toggle"
                        type="button"
                        id="acreg"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                      >
                        . . . . . . . . . . . . . . . . . . . . . . .
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="acreg">
                        <li><a class="dropdown-item" href="#">12345</a></li>
                        <li><a class="dropdown-item" href="#">H34L1NG</a></li>
                        <li><a class="dropdown-item" href="#">JJS-50r3</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <br />

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Operator</label>
                  <div class="col-sm-4">
                    <input
                      type="text"
                      class="form-control"
                      :class="{
                        'is-invalid': errors.operator,
                      }"
                      v-model="operator"
                    />
                    <span v-if="errors.operator" class="error invalid-feedback">{{
                      errors.operator[0]
                    }}</span>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">A/C Type</label>
                  <div class="col-sm-4">
                    <input
                      type="text"
                      class="form-control"
                      :class="{
                        'is-invalid': errors.type,
                      }"
                      v-model="type"
                    />
                    <span v-if="errors.type" class="error invalid-feedback">{{
                      errors.type[0]
                    }}</span>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Actual Time Depart</label>
                  <div class="col-sm-3">
                    <input
                      type="date"
                      class="form-control"
                      :class="{
                        'is-invalid': errors.actual_time_redel,
                      }"
                      v-model="actual_time_redel"
                    />
                    <span
                      v-if="errors.actual_time_redel"
                      class="error invalid-feedback"
                      >{{ errors.actual_time_redel[0] }}</span
                    >
                  </div>
                </div>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" @click="clearForm">
                  Reset
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      reg: null,
      operator: null,
      type: null,
      actual_time_del: null,
      actual_time_redel: null,
      rksp: null,
      status: null,
      errors: [],
    };
  },
  methods: {
    create() {
      axios
        .post("/api/redelivery", {
          reg: this.reg,
          operator: this.operator,
          type: this.type,
          actual_time_redel: this.actual_time_redel,
        })
        .then((data) => {
          this.$router.push({ name: "mutation" });
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
      this.actual_time_redel = null;
      this.status = null;
      this.errors = [];
    },
  },
};
</script>
