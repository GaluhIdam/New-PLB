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
                                        <label for="acreg" class="form-label"
                                            >A/C Registration</label
                                        >
                                    </div>
                                    <div class="col-sm-4">
                                        <multiselect
                                            v-model="selected_mutation"
                                            id="ajax"
                                            :custom-label="mutationLabel"
                                            track-by="id"
                                            placeholder="Select A/C Registration"
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
                                        <span
                                            v-if="errors.reg"
                                            class="text-danger"
                                            >{{ errors.reg[0] }}</span
                                        >
                                    </div>
                                </div>
                                <br />

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"
                                        >Operator</label
                                    >
                                    <div class="col-sm-4">
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="operator"
                                        />
                                        <span
                                            v-if="errors.operator"
                                            class="text-danger"
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
                                            v-model="type"
                                        />
                                        <span
                                            v-if="errors.type"
                                            class="text-danger"
                                            >{{ errors.type[0] }}</span
                                        >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"
                                        >Actual Time Depart</label
                                    >
                                    <div class="col-sm-3">
                                        <input
                                            type="datetime-local"
                                            class="form-control"
                                            v-model="actual_time"
                                        />
                                        <span
                                            v-if="errors.actual_time"
                                            class="text-danger"
                                            >{{
                                                errors.actual_time[0]
                                            }}</span
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
            reg: null,
            operator: null,
            type: null,
            actual_time_del: null,
            actual_time: null,
            rksp: null,
            status: null,
            errors: [],

            mutations: [],
            selected_mutation: null,
            isLoading: false,
        };
    },
    methods: {
        create() {
            axios
                .post("/api/redelivery", {
                    reg: this.reg,
                    operator: this.operator,
                    type: this.type,
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
            this.reg = null;
            this.operator = null;
            this.type = null;
            this.actual_time = null;
            this.status = null;
            this.errors = [];
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
        mutationLabel({reg}) {
            return `${reg}`;
        },
        selectedMutation({reg, operator, type}) {
            this.reg = reg
            this.operator = operator
            this.type = type
        },
    },
};
</script>
