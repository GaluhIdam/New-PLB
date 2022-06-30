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
                                <router-link :to="{ name: 'aircraft-mutation' }">Aircraft Mutation</router-link>
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
                        <div class="card">
                            <div class="card-header ui-sortable-handle">
                                <h5 class="card-title card_title_margin">
                                    <i class="fas fa-plane-circle-exclamation mr-1"></i>
                                    Aircraft Redelivery
                                </h5>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item"></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="create" class="form-horizontal">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-2">
                                            <label for="acreg" class="form-label">A/C Registration</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <multiselect v-model="selected_mutation" id="ajax" :custom-label="mutationLabel" track-by="id" placeholder="Select A/C Registration" open-direction="bottom" :options="mutations" :multiple="false" :searchable="true" :loading="isLoading" :internal-search="false" :clear-on-select="false" :close-on-select="true" :options-limit="300" :max-height="600" :show-no-results="false" @search-change="findMutation" @select="selectedMutation"></multiselect>
                                            <span v-if="errors.reg" class="text-danger">{{ errors.reg[0] }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row" style="margin-top: 16px">
                                        <label class="col-sm-2 col-form-label">Operator</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" v-model="operator" />
                                            <span v-if="errors.operator" class="text-danger">{{ errors.operator[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">A/C Type</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" v-model="type" />
                                            <span v-if="errors.type" class="text-danger">{{ errors.type[0] }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Actual Time Depart</label>
                                        <div class="col-sm-3">
                                            <input type="datetime-local" class="form-control" v-model="date_out" />
                                            <span v-if="errors.date_out" class="text-danger">{{ errors.date_out[0] }}</span>
                                        </div>
                                    </div>

                                    <div class="text-center" style="margin-top: 35px">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-secondary" @click="clearForm">Reset</button>
                                    </div>
                                </form>
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
