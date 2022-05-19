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
                                    <label class="col-sm-2 col-form-label"
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
                                        />
                                        <span
                                            v-if="errors.operator"
                                            class="error invalid-feedback"
                                            >{{ errors.operator[0] }}</span
                                        >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"
                                        >A/C Type</label
                                    >
                                    <div class="col-sm-4">
                                        <input
                                            type="text"
                                            class="form-control"
                                            :class="{
                                                'is-invalid': errors.type,
                                            }"
                                            v-model="type"
                                        />
                                        <span
                                            v-if="errors.type"
                                            class="error invalid-feedback"
                                            >{{ errors.type[0] }}</span
                                        >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"
                                        >A/C Registration</label
                                    >
                                    <div class="col-sm-4">
                                        <input
                                            type="text"
                                            class="form-control"
                                            :class="{
                                                'is-invalid': errors.reg,
                                            }"
                                            v-model="reg"
                                        />
                                        <span
                                            v-if="errors.reg"
                                            class="error invalid-feedback"
                                            >{{ errors.reg[0] }}</span
                                        >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"
                                        >Actual Time</label
                                    >
                                    <div class="col-sm-3">
                                        <input
                                            type="date"
                                            class="form-control"
                                            :class="{
                                                'is-invalid':
                                                    errors.actual_time,
                                            }"
                                            v-model="actual_time"
                                        />
                                        <span
                                            v-if="errors.actual_time"
                                            class="error invalid-feedback"
                                            >{{ errors.actual_time[0] }}</span
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    @click="clearForm"
                                >
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
            actual_time: null,
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
                    actual_time: this.actual_time,
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
            this.actual_time = null;
            this.errors = [];
        },
    },
};
</script>
