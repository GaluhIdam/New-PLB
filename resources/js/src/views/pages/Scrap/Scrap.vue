<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Scrap</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <router-link :to="{ name: 'dashboard' }">Dashboard</router-link>
                            </li>

                            <li class="breadcrumb-item active">
                                <span>Scrap</span>
                            </li>
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
                                    <i class="fa-solid fa-oil-well mr-1"></i>
                                    Scrap
                                </h5>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item"></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-body">
                                <form @submit.prevent class="form-horizontal">
                                    <div class="form-group row justify-content-center align-items-center mt-4">
                                        <label for="material_document" class="col-sm-2 col-form-label">Part
                                            Number</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" v-model="search_material_document"
                                                autofocus />
                                        </div>
                                        <div class="col-sm-10 mt-4 text-center">
                                            <button class="btn btn-primary" @click="filterPart">
                                                <i class="fa-solid fa-magnifying-glass"></i> Filter
                                            </button>
                                            <button class="btn btn-secondary" @click="clearForm">
                                                <i class="fa-solid fa-rotate"></i> Reset
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr />
                        <!-- BEGIN: Tampil Data Scrap -->
                        <!-- <div class="card"> -->
                        <div class="card" v-if="part_selected">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="vgt-wrap polar-bear"></div>
                                    <div class="vgt-inner-wrap">
                                        <!-- BEGIN : Global Search -->
                                        <div class="vgt-global-search vgt-clearfix">
                                            <div class="vgt-global-search__input vgt-pull-left">
                                                <label>
                                                    <span aria-hidden="true" class="input__icon">
                                                        <div class="magnifying-glass"></div>
                                                    </span>
                                                    <span class="sr-only"> Search </span>
                                                </label>
                                                <input type="text" placeholder="Search Data"
                                                    class="vgt-input vgt-pull-left" v-model="search" />
                                            </div>
                                        </div>
                                        <!-- END :  Global Search -->
                                        <div class="vgt-responsive">
                                            <table id="vgt-table" class="vgt-table bordered polar-bear">
                                                <thead>
                                                    <tr>
                                                        <!-- BEGIN: Number by ID (Table Header) -->
                                                        <th v-if="order == 'id' && by == 'asc'"
                                                            @click="sort('id', 'desc')"
                                                            class="text-center sortable sorting sorting-asc">
                                                            <span class="table_header">No.</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else-if="order == 'id' && by == 'desc'"
                                                            @click="sort('id', 'asc')"
                                                            class="text-center sortable sorting sorting-desc">
                                                            <span class="table_header">No.</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else @click="sort('id', 'asc')"
                                                            class="text-center sortable">
                                                            <span class="table_header">No.</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <!-- END: Number by ID (Table Header) -->
                                                        <!-- BEGIN: Material Document (Table Header) -->
                                                        <th v-if="order == 'material_document' && by == 'asc'"
                                                            @click="sort('material_document', 'desc')"
                                                            class="text-center sortable sorting sorting-asc">
                                                            <span class="table_header">Material Doc.</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else-if="order == 'material_document' && by == 'desc'"
                                                            @click="sort('material_document', 'asc')"
                                                            class="text-center sortable sorting sorting-desc">
                                                            <span class="table_header">Material Doc.</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else @click="sort('material_document', 'asc')"
                                                            class="text-center sortable">
                                                            <span class="table_header">Material Doc.</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <!-- END: Material Document (Table Header) -->
                                                        <!-- BEGIN: Material Item (Table Header) -->
                                                        <th v-if="order == 'material_item' && by == 'asc'"
                                                            @click="sort('material_item', 'desc')"
                                                            class="text-center sortable sorting sorting-asc">
                                                            <span class="table_header">Material Item</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else-if="order == 'material_item' && by == 'desc'"
                                                            @click="sort('material_item', 'asc')"
                                                            class="text-center sortable sorting sorting-desc">
                                                            <span class="table_header">Material Item</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else @click="sort('material_item', 'asc')"
                                                            class="text-center sortable">
                                                            <span class="table_header">Material Item</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <!-- END: Material Item (Table Header) -->
                                                        <!-- BEGIN: Material Code (Table Header) -->
                                                        <th v-if="order == 'material_code' && by == 'asc'"
                                                            @click="sort('material_code', 'desc')"
                                                            class="text-center sortable sorting sorting-asc">
                                                            <span class="table_header">Material Code</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else-if="order == 'material_code' && by == 'desc'"
                                                            @click="sort('material_code', 'asc')"
                                                            class="text-center sortable sorting sorting-desc">
                                                            <span class="table_header">Material Code</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else @click="sort('material_code', 'asc')"
                                                            class="text-center sortable">
                                                            <span class="table_header">Material Code</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <!-- END: Material Code (Table Header) -->
                                                        <!-- BEGIN: Material Description (Table Header) -->
                                                        <th v-if="order == 'material_description' && by == 'asc'"
                                                            @click="sort('material_description', 'desc')"
                                                            class="text-center sortable sorting sorting-asc">
                                                            <span class="table_header">Material Description</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else-if="order == 'material_description' && by == 'desc'"
                                                            @click="sort('material_description', 'asc')"
                                                            class="text-center sortable sorting sorting-desc">
                                                            <span class="table_header">Material Description</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else @click="sort('material_description', 'asc')"
                                                            class="text-center sortable">
                                                            <span class="table_header">Material Description</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <!-- END: Material Description (Table Header) -->
                                                        <!-- BEGIN: Batch (Table Header) -->
                                                        <th v-if="order == 'batch_number' && by == 'asc'"
                                                            @click="sort('batch_number', 'desc')"
                                                            class="text-center sortable sorting sorting-asc">
                                                            <span class="table_header">Batch</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else-if="order == 'batch_number' && by == 'desc'"
                                                            @click="sort('batch_number', 'asc')"
                                                            class="text-center sortable sorting sorting-desc">
                                                            <span class="table_header">Batch</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else @click="sort('batch_number', 'asc')"
                                                            class="text-center sortable">
                                                            <span class="table_header">Batch</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <!-- END: Batch (Table Header) -->
                                                        <!-- BEGIN: Plant (Table Header) -->
                                                        <th v-if="order == 'plant_code' && by == 'asc'"
                                                            @click="sort('plant_code', 'desc')"
                                                            class="text-center sortable sorting sorting-asc">
                                                            <span class="table_header">Plant</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else-if="order == 'plant_code' && by == 'desc'"
                                                            @click="sort('plant_code', 'asc')"
                                                            class="text-center sortable sorting sorting-desc">
                                                            <span class="table_header">Plant</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else @click="sort('plant_code', 'asc')"
                                                            class="text-center sortable">
                                                            <span class="table_header">Plant</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <!-- END: Plant (Table Header) -->
                                                        <!-- BEGIN: No Aju (Table Header) -->
                                                        <th v-if="order == 'submission_number' && by == 'asc'"
                                                            @click="sort('submission_number', 'desc')"
                                                            class="text-center sortable sorting sorting-asc">
                                                            <span class="table_header">No Aju</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else-if="order == 'submission_number' && by == 'desc'"
                                                            @click="sort('submission_number', 'asc')"
                                                            class="text-center sortable sorting sorting-desc">
                                                            <span class="table_header">No Aju</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else @click="sort('submission_number', 'asc')"
                                                            class="text-center sortable">
                                                            <span class="table_header">No Aju</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <!-- END: No Aju (Table Header) -->
                                                        <!-- BEGIN: Tanggal Aju (Table Header) -->
                                                        <th v-if="order == 'submission_date' && by == 'asc'"
                                                            @click="sort('submission_date', 'desc')"
                                                            class="text-center sortable sorting sorting-asc">
                                                            <span class="table_header">Tanggal Aju</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else-if="order == 'submission_date' && by == 'desc'"
                                                            @click="sort('submission_date', 'asc')"
                                                            class="text-center sortable sorting sorting-desc">
                                                            <span class="table_header">Tanggal Aju</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else @click="sort('submission_date', 'asc')"
                                                            class="text-center sortable">
                                                            <span class="table_header">Tanggal Aju</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <!-- END: Tanggal Aju (Table Header) -->
                                                        <!-- BEGIN: No Daftar (Table Header) -->
                                                        <th v-if="order == 'registration_number' && by == 'asc'"
                                                            @click="sort('registration_number', 'desc')"
                                                            class="text-center sortable sorting sorting-asc">
                                                            <span class="table_header">No Daftar</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else-if="order == 'registration_number' && by == 'desc'"
                                                            @click="sort('registration_number', 'asc')"
                                                            class="text-center sortable sorting sorting-desc">
                                                            <span class="table_header">No Daftar</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else @click="sort('registration_number', 'asc')"
                                                            class="text-center sortable">
                                                            <span class="table_header">No Daftar</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <!-- END: No Daftar (Table Header) -->
                                                        <!-- BEGIN: Tanggal Daftar (Table Header) -->
                                                        <th v-if="order == 'registration_date' && by == 'asc'"
                                                            @click="sort('registration_date', 'desc')"
                                                            class="text-center sortable sorting sorting-asc">
                                                            <span class="table_header">Tanggal Daftar</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else-if="order == 'registration_date' && by == 'desc'"
                                                            @click="sort('registration_date', 'asc')"
                                                            class="text-center sortable sorting sorting-desc">
                                                            <span class="table_header">Tanggal Daftar</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <th v-else @click="sort('registration_date', 'asc')"
                                                            class="text-center sortable">
                                                            <span class="table_header">Tanggal Daftar</span>
                                                            <button>
                                                                <span class="sr-only"></span>
                                                            </button>
                                                        </th>
                                                        <!-- END: Tanggal Daftar (Table Header) -->
                                                    </tr>
                                                    <tr>
                                                        <th class="filter-th"></th>
                                                        <th class="filter-th">
                                                            <div>
                                                                <input type="text" class="vgt-input"
                                                                    placeholder="Filter"
                                                                    v-model="search_material_document" />
                                                            </div>
                                                        </th>
                                                        <th class="filter-th">
                                                            <div>
                                                                <input type="text" class="vgt-input"
                                                                    placeholder="Filter"
                                                                    v-model="search_material_item" />
                                                            </div>
                                                        </th>
                                                        <th class="filter-th">
                                                            <div>
                                                                <input type="text" class="vgt-input"
                                                                    placeholder="Filter"
                                                                    v-model="search_material_code" />
                                                            </div>
                                                        </th>
                                                        <th class="filter-th">
                                                            <div>
                                                                <input type="text" class="vgt-input"
                                                                    placeholder="Filter"
                                                                    v-model="search_material_description" />
                                                            </div>
                                                        </th>
                                                        <th class="filter-th">
                                                            <div>
                                                                <input type="text" class="vgt-input"
                                                                    placeholder="Filter"
                                                                    v-model="search_batch_number" />
                                                            </div>
                                                        </th>
                                                        <th class="filter-th">
                                                            <div>
                                                                <input type="text" class="vgt-input"
                                                                    placeholder="Filter" v-model="search_plant_code" />
                                                            </div>
                                                        </th>
                                                        <th class="filter-th">
                                                            <div>
                                                                <input type="text" class="vgt-input"
                                                                    placeholder="Filter"
                                                                    v-model="search_submission_number" />
                                                            </div>
                                                        </th>
                                                        <th class="filter-th">
                                                            <div>
                                                                <input type="date" class="vgt-input text-center"
                                                                    v-model="search_submission_date" />
                                                            </div>
                                                        </th>
                                                        <th class="filter-th">
                                                            <div>
                                                                <input type="text" class="vgt-input"
                                                                    placeholder="Filter"
                                                                    v-model="search_registration_number" />
                                                            </div>
                                                        </th>
                                                        <th class="filter-th">
                                                            <div>
                                                                <input type="date" class="vgt-input text-center"
                                                                    v-model="search_registration_date" />
                                                            </div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <!-- END: Table Head -->

                                                <!-- BEGIN: Table Body -->
                                                <tbody>
                                                    <tr v-for="(scrap, scrap_index) in scraps.data" :key="scrap_index">
                                                        <td class="text-center table-content">
                                                            {{ scrap.id }}
                                                        </td>
                                                        <td class="text-center table-content">
                                                            {{ scrap.material_document }}
                                                        </td>
                                                        <td class="text-center table-content">
                                                            {{ scrap.material_item }}
                                                        </td>
                                                        <td class="text-center table-content">
                                                            {{ scrap.material_code }}
                                                        </td>
                                                        <td class="text-center table-content">
                                                            {{ scrap.material_description }}
                                                        </td>
                                                        <td class="text-center table-content">
                                                            {{ scrap.batch_number }}
                                                        </td>
                                                        <td class="text-center table-content">
                                                            {{ scrap.plant_code }}
                                                        </td>
                                                        <td class="text-center table-content">
                                                            {{ scrap.submission_number }}
                                                        </td>
                                                        <td class="text-center table-content">
                                                            {{ scrap.submission_date | formatDate }}
                                                        </td>
                                                        <td class="text-center table-content">
                                                            {{ scrap.registration_number }}
                                                        </td>
                                                        <td class="text-center table-content">
                                                            {{ scrap.registration_date | formatDate }}
                                                        </td>
                                                    </tr>
                                                </tbody>

                                                <!-- END: Table Body -->
                                            </table>
                                        </div>

                                        <div class="vgt-wrap__footer vgt-clearfix">
                                            <div class="footer__row-count vgt-pull-left">
                                                <label class="footer__row-count__label row_per_page_label">
                                                    Rows per page:
                                                </label>
                                                <select class="footer__row-count__select row_per_page_option"
                                                    v-model="paginate" @change="list()">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                            <div class="footer__navigation vgt-pull-right">
                                                <button type="button" class="footer__navigation__page-btn" :class="{
                                                    disabled: !scraps.prev_page_url,
                                                }" @click="scraps.prev_page_url && list(scraps.prev_page_url)" style="margin-right: 0px">
                                                    <span aria-hidden="true" class="chevron left"></span>
                                                    <span class="paginate_text">Prev</span>
                                                </button>
                                                <div class="footer__navigation__page-info" style="color: #99a0b2">
                                                    <label class="page-info__label" style="margin-bottom: -5px">
                                                        <span class="paginate_text">page</span>
                                                        <input type="text"
                                                            class="footer__navigation__page-info__current-entry vgt-input"
                                                            v-model="current_page" @keypress="directPage"
                                                            style="width: 60px" />
                                                        <span class="paginate_text">
                                                            of
                                                            {{ scraps.last_page }}
                                                        </span>
                                                    </label>
                                                </div>
                                                <button type="button" class="footer__navigation__page-btn" :class="{
                                                    disabled: !scraps.next_page_url,
                                                }" @click="scraps.next_page_url && list(scraps.next_page_url)">
                                                    <span style="font-weight: 500">Next</span>
                                                    <span aria-hidden="true" class="chevron right"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Tampil Data Scrap -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import debounce from "lodash/debounce";
import moment from "moment";
moment.locale("id");
export default {
    data() {
        return {
            scraps: {
                data: [],
            },
            search: null,
            search_material_document: null,
            search_material_item: null,
            search_material_code: null,
            search_material_description: null,
            search_batch_number: null,
            search_plant_code: null,
            search_storage_location: null,
            search_submission_number: null,
            search_submission_date: null,
            search_registration_date: null,
            search_registration_number: null,
            search_recepient: null,
            part_selected: false,
            order: "id",
            by: "asc",
            paginate: "10",
            current_page: null,
        };
    },
    // created() {
    //   this.list();
    //   Fire.$on("RefreshTable", () => {
    //     this.list();
    //   });
    // },
    watch: {
        search: debounce(function () {
            this.list();
        }, 500),
        search_material_document: debounce(function () {
            this.list();
        }, 500),
        search_material_item: debounce(function () {
            this.list();
        }, 500),
        search_material_code: debounce(function () {
            this.list();
        }, 500),
        search_material_description: debounce(function () {
            this.list();
        }, 500),
        search_batch_number: debounce(function () {
            this.list();
        }, 500),
        search_plant_code: debounce(function () {
            this.list();
        }, 500),
        search_storage_location: debounce(function () {
            this.list();
        }, 500),
        search_submission_number: debounce(function () {
            this.list();
        }, 500),
        search_submission_date: debounce(function () {
            this.list();
        }, 500),
        search_registration_date: debounce(function () {
            this.list();
        }, 500),
        search_registration_number: debounce(function () {
            this.list();
        }, 500),
        search_recepient: debounce(function () {
            this.list();
        }, 500),
    },
    methods: {
        filterPart() {
            this.part_selected = true;
            if (this.search_material_document == null) {
                this.list();
            }
        },
        clearForm() {
            this.search_material_document = null;
        },
        list(paginate) {
            this.$Progress.start();
            paginate = paginate || "/api/scrap/";

            axios
                .get(paginate, {
                    params: {
                        search: this.search,
                        search_material_document: this.search_material_document,
                        search_material_item: this.search_material_item,
                        search_material_code: this.search_material_code,
                        search_material_description: this.search_material_description,
                        search_batch_number: this.search_batch_number,
                        search_plant_code: this.search_plant_code,
                        search_storage_location: this.search_storage_location,
                        search_submission_number: this.search_submission_number,
                        search_submission_date: this.search_submission_date,
                        search_registration_date: this.search_registration_date,
                        search_registration_number: this.search_registration_number,
                        search_recepient: this.search_recepient,
                        order: this.order,
                        by: this.by,
                        paginate: this.paginate,
                    },
                })
                .then((response) => {
                    this.scraps = response.data;
                    this.current_page = this.scraps.current_page;
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
            } else if (this.current_page > this.scraps.last_page) {
                this.current_page = this.scraps.last_page;
            }

            let url = new URL(this.scraps.first_page_url);
            let search_params = new URLSearchParams(url.search);
            search_params.set("page", this.current_page);
            url.search = search_params.toString();
            this.list(new_url);
        }, 500),

        sort(order, by) {
            this.order = order;
            this.by = by;
            this.list();
        },
    },
};
</script>

<style scoped>
.vgt-global-search__input .input__icon .magnifying-glass {
    margin-top: -3px;
}
</style>
