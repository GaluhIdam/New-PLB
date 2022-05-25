<template>
  <div class="container-fluid" style="margin-top: 20px">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h1>Aircraft Delivery</h1>
            <hr />

            <form @submit.prevent="create" class="form-horizontal">
              <div class="card-body">
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
                  <label class="col-sm-2 col-form-label">A/C Registration</label>
                  <div class="col-sm-4">
                    <input
                      type="text"
                      class="form-control"
                      :class="{
                        'is-invalid': errors.reg,
                      }"
                      v-model="reg"
                    />
                    <span v-if="errors.reg" class="error invalid-feedback">{{
                      errors.reg[0]
                    }}</span>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Actual Time Arrival</label>
                  <div class="col-sm-3">
                    <input
                      type="date"
                      class="form-control"
                      :class="{
                        'is-invalid': errors.actual_time_del,
                      }"
                      v-model="actual_time_del"
                    />
                    <span v-if="errors.actual_time_del" class="error invalid-feedback">{{
                      errors.actual_time_del[0]
                    }}</span>
                  </div>
                </div>
                <div class="row g-3 align-items-center">
                  <div class="col-md-2">
                    <label for="rksp" class="form-label">RKSP</label>
                  </div>
                  <div class="col-md-4">
                    <input
                      type="file"
                      id="form"
                      class="form-control"
                      :class="{
                        'is-invalid': errors.rksp,
                      }"
                    />
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
      operator: null,
      type: null,
      reg: null,
      actual_time_del: null,
      rksp: null,
      errors: [],
    };
  },
  methods: {
    create() {
      axios
        .post("/api/delivery", {
          operator: this.operator,
          type: this.type,
          reg: this.reg,
          actual_time_del: this.actual_time_del,
          rksp: this.rksp,
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
      this.operator = null;
      this.type = null;
      this.reg = null;
      this.actual_time_del = null;
      this.rksp = null;
      this.errors = [];
    },
  },
};
</script>
