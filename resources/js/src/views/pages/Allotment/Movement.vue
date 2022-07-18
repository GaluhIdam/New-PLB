<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Movement Allotment</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active"><span>Movement Allotment</span></li>
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
                                    <i class="nav-icon fa-solid fa-warehouse"></i>
                                    Movement Allotment
                                </h5>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item"></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Tanggal Mutasi</label>
                                            <div class="col-sm-4">
                                                <input type="date" class="form-control" />
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="date" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label"></label>
                                            <div class="col-sm-4">
                                                <button class="btn btn-primary btn-md" @click="filter"><i class="fa-solid fa-magnifying-glass"></i>Search</button>
                                                <button class="btn btn-secondary btn-md" @click="reset"><i class="fa-solid fa-rotate"></i>Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr />

                                <div class="form-group">
                                    <div class="vgt-wrap polar-bear">
                                        <div class="vgt-inner-wrap">
                                            <div class="vgt-global-search vgt-clearfix">
                                                <div class="vgt-global-search__input vgt-pull-left">
                                                    <label>
                                                        <span aria-hidden="true" class="input__icon">
                                                            <div class="magnifying-glass"></div>
                                                        </span>
                                                        <span class="sr-only"> Search </span>
                                                    </label>
                                                    <input type="text" placeholder="Search Data" class="vgt-input vgt-pull-left" v-model="search_movement_allotments" />
                                                </div>
                                            </div>
                                            <div class="vgt-responsive">
                                                <table id="vgt-table" class="vgt-table bordered polar-bear">
                                                    <thead>
                                                        <tr>
                                                            <!-- BEGIN: Number by ID (Table Header) -->
                                                            <th v-if="order == 'osa' && by == 'asc'" @click="sort('osa', 'desc')" class="text-center sortable sorting sorting-asc" rowspan="2">
                                                                <span class="table_header">OSA.</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th v-else-if="order == 'osa' && by == 'desc'" @click="sort('osa', 'asc')" class="text-center sortable sorting sorting-desc" rowspan="2">
                                                                <span class="table_header">OSA.</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th v-else @click="sort('osa', 'asc')" class="text-center sortable" rowspan="2">
                                                                <span class="table_header">OSA.</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <!-- END: Number by ID (Table Header) -->
                                                            <th v-if="order == 'first_balance' && by == 'asc'" @click="sort('first_balance', 'desc')" class="text-center sortable sorting sorting-asc" rowspan="2">
                                                                <span class="table_header">Saldo Awal</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th v-else-if="order == 'first_balance' && by == 'desc'" @click="sort('first_balance', 'asc')" class="text-center sortable sorting sorting-desc" rowspan="2">
                                                                <span class="table_header">Saldo Awal</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th v-else @click="sort('first_balance', 'asc')" class="text-center sortable" rowspan="2">
                                                                <span class="table_header">Saldo Awal</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <!--  -->
                                                            <th colspan="2" v-if="order == 'kno_plus' && by == 'asc'" @click="sort('kno_plus', 'desc')" class="text-center sortable sorting sorting-asc">
                                                                <span class="table_header">KNO</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th colspan="2" v-else-if="order == 'kno_plus' && by == 'desc'" @click="sort('kno_plus', 'asc')" class="text-center sortable sorting sorting-desc">
                                                                <span class="table_header">KNO</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th colspan="2" v-else @click="sort('kno_plus', 'asc')" class="text-center sortable">
                                                                <span class="table_header">KNO</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th colspan="2" v-if="order == 'upg_plus' && by == 'asc'" @click="sort('upg_plus', 'desc')" class="text-center sortable sorting sorting-asc">
                                                                <span class="table_header">UPG</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th colspan="2" v-else-if="order == 'upg_plus' && by == 'desc'" @click="sort('upg_plus', 'asc')" class="text-center sortable sorting sorting-desc">
                                                                <span class="table_header">UPG</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th colspan="2" v-else @click="sort('upg_plus', 'asc')" class="text-center sortable">
                                                                <span class="table_header">UPG</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th colspan="2" v-if="order == 'sub_plus' && by == 'asc'" @click="sort('sub_plus', 'desc')" class="text-center sortable sorting sorting-asc">
                                                                <span class="table_header">SUB</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th colspan="2" v-else-if="order == 'sub_plus' && by == 'desc'" @click="sort('sub_plus', 'asc')" class="text-center sortable sorting sorting-desc">
                                                                <span class="table_header">SUB</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th colspan="2" v-else @click="sort('sub_plus', 'asc')" class="text-center sortable">
                                                                <span class="table_header">SUB</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th colspan="2" v-if="order == 'bpn_plus' && by == 'asc'" @click="sort('bpn_plus', 'desc')" class="text-center sortable sorting sorting-asc">
                                                                <span class="table_header">BPN</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th colspan="2" v-else-if="order == 'bpn_plus' && by == 'desc'" @click="sort('bpn_plus', 'asc')" class="text-center sortable sorting sorting-desc">
                                                                <span class="table_header">BPN</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th colspan="2" v-else @click="sort('bpn_plus', 'asc')" class="text-center sortable">
                                                                <span class="table_header">BPN</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th colspan="2" v-if="order == 'dps_plus' && by == 'asc'" @click="sort('dps_plus', 'desc')" class="text-center sortable sorting sorting-asc">
                                                                <span class="table_header">DPS</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th colspan="2" v-else-if="order == 'dps_plus' && by == 'desc'" @click="sort('dps_plus', 'asc')" class="text-center sortable sorting sorting-desc">
                                                                <span class="table_header">DPS</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th colspan="2" v-else @click="sort('dps_plus', 'asc')" class="text-center sortable">
                                                                <span class="table_header">DPS</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th colspan="2" v-if="order == 'cgk_plus' && by == 'asc'" @click="sort('cgk_plus', 'desc')" class="text-center sortable sorting sorting-asc">
                                                                <span class="table_header">CGK</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th colspan="2" v-else-if="order == 'cgk_plus' && by == 'desc'" @click="sort('cgk_plus', 'asc')" class="text-center sortable sorting sorting-desc">
                                                                <span class="table_header">CGK</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th colspan="2" v-else @click="sort('cgk_plus', 'asc')" class="text-center sortable">
                                                                <span class="table_header">CGK</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <!--  -->
                                                            <th v-if="order == 'consumption_install' && by == 'asc'" @click="sort('consumption_install', 'desc')" class="text-center sortable sorting sorting-asc" rowspan="2">
                                                                <span class="table_header">Consumption/​Install</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th v-else-if="order == 'consumption_install' && by == 'desc'" @click="sort('consumption_install', 'asc')" class="text-center sortable sorting sorting-desc" rowspan="2">
                                                                <span class="table_header">Consumption/​Install</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th v-else @click="sort('consumption_install', 'asc')" class="text-center sortable" rowspan="2">
                                                                <span class="table_header">Consumption/​Install</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <!--  -->
                                                            <th v-if="order == 'return_to_plb_gmf' && by == 'asc'" @click="sort('return_to_plb_gmf', 'desc')" class="text-center sortable sorting sorting-asc" rowspan="2">
                                                                <span class="table_header">Return to PLB GMF</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th v-else-if="order == 'return_to_plb_gmf' && by == 'desc'" @click="sort('return_to_plb_gmf', 'asc')" class="text-center sortable sorting sorting-desc" rowspan="2">
                                                                <span class="table_header">Return to PLB GMF</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th v-else @click="sort('return_to_plb_gmf', 'asc')" class="text-center sortable" rowspan="2">
                                                                <span class="table_header">Return to PLB GMF</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>

                                                            <!--  -->
                                                            <th v-if="order == 'last_balance' && by == 'asc'" @click="sort('last_balance', 'desc')" class="text-center sortable sorting sorting-asc" rowspan="2">
                                                                <span class="table_header">Saldo Akhir</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th v-else-if="order == 'last_balance' && by == 'desc'" @click="sort('last_balance', 'asc')" class="text-center sortable sorting sorting-desc" rowspan="2">
                                                                <span class="table_header">Saldo Akhir</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <th v-else @click="sort('last_balance', 'asc')" class="text-center sortable" rowspan="2">
                                                                <span class="table_header">Saldo Akhir</span>
                                                                <button>
                                                                    <span class="sr-only"></span>
                                                                </button>
                                                            </th>
                                                            <!--  -->
                                                        </tr>
                                                        <tr>
                                                            <th class="filter-th text-center">+</th>
                                                            <th class="filter-th text-center">-</th>
                                                            <th class="filter-th text-center">+</th>
                                                            <th class="filter-th text-center">-</th>
                                                            <th class="filter-th text-center">+</th>
                                                            <th class="filter-th text-center">-</th>
                                                            <th class="filter-th text-center">+</th>
                                                            <th class="filter-th text-center">-</th>
                                                            <th class="filter-th text-center">+</th>
                                                            <th class="filter-th text-center">-</th>
                                                            <th class="filter-th text-center">+</th>
                                                            <th class="filter-th text-center">-</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(movement, movement_index) in movement_allotment.data" :key="movement_index">
                                                            <td class="table_content">{{ movement.osa }}</td>
                                                            <td class="table_content">{{ movement.first_balance }}</td>
                                                            <td class="text-center table_content">{{ movement.kno_plus }}</td>
                                                            <td class="text-center table_content">{{ movement.kno_min }}</td>
                                                            <td class="text-center table_content">{{ movement.upg_plus }}</td>
                                                            <td class="text-center table_content">{{ movement.upg_min }}</td>
                                                            <td class="text-center table_content">{{ movement.sub_plus }}</td>
                                                            <td class="text-center table_content">{{ movement.sub_min }}</td>
                                                            <td class="text-center table_content">{{ movement.bpn_plus }}</td>
                                                            <td class="text-center table_content">{{ movement.bpn_min }}</td>
                                                            <td class="text-center table_content">{{ movement.dps_plus }}</td>
                                                            <td class="text-center table_content">{{ movement.dps_min }}</td>
                                                            <td class="text-center table_content">{{ movement.cgk_plus }}</td>
                                                            <td class="text-center table_content">{{ movement.cgk_min }}</td>
                                                            <td class="text-center table_content">{{ movement.consumption_install }}</td>
                                                            <td class="text-center table_content">{{ movement.return_to_plb_gmf }}</td>
                                                            <td class="text-center table_content">{{ movement.last_balance }}</td>
                                                        </tr>
                                                        <tr v-if="movement_allotment.length < 1">
                                                            <td colspan="8">
                                                                <div class="vgt-center-align vgt-text-disabled">Data not found</div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="vgt-wrap__footer vgt-clearfix">
                                                <div class="footer__row-count vgt-pull-left">
                                                    <label class="footer__row-count__label row_per_page_label"> Rows per page: </label>
                                                    <select class="footer__row-count__select row_per_page_option" v-model="paginate" @change="list()">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                                <div class="footer__navigation vgt-pull-right">
                                                    <button
                                                        type="button"
                                                        class="footer__navigation__page-btn"
                                                        :class="{
                                                            disabled: !movement_allotment.prev_page_url,
                                                        }"
                                                        @click="movement_allotment.prev_page_url && list(movement_allotment.prev_page_url)"
                                                        style="margin-right: 0px"
                                                    >
                                                        <span aria-hidden="true" class="chevron left"></span>
                                                        <span class="paginate_text">Prev</span>
                                                    </button>
                                                    <div class="footer__navigation__page-info" style="color: #99a0b2">
                                                        <label class="page-info__label" style="margin-bottom: -5px">
                                                            <span class="paginate_text">page</span>
                                                            <input type="text" class="footer__navigation__page-info__current-entry vgt-input" v-model="current_page" @keypress="directPage" style="width: 60px" />
                                                            <span class="paginate_text">
                                                                of
                                                                {{ movement_allotment.last_page }}
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <button
                                                        type="button"
                                                        class="footer__navigation__page-btn"
                                                        :class="{
                                                            disabled: !movement_allotment.next_page_url,
                                                        }"
                                                        @click="movement_allotment.next_page_url && list(movement_allotment.next_page_url)"
                                                    >
                                                        <span style="font-weight: 500">Next</span>
                                                        <span aria-hidden="true" class="chevron right"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
import debounce from "lodash/debounce";
import Swal from "sweetalert2";

export default {
    data() {
        return {
            movement_allotment: {
                data: [],
                links: [],
            },
            search: null,
            search_first_balance: null,

            search_consumption_install: null,
            search_return_to_plb_gmf: null,
            search_last_balance: null,
            order: "id",
            by: "desc",
            paginate: "10",
            current_page: null,
        };
    },
    created() {
        this.list();
    },
    watch: {
        search: debounce(function () {
            this.list();
        }, 500),
        search_first_balance: debounce(function () {
            this.list();
        }, 500),
        search_consumption_install: debounce(function () {
            this.list();
        }, 500),
        search_return_to_plb_gmf: debounce(function () {
            this.list();
        }, 500),
        search_last_balance: debounce(function () {
            this.list();
        }, 500),
    },
    methods: {
        list(paginate) {
            this.showLoading();
            paginate = paginate || `/api/movement-allotment`;
            axios
                .get(paginate, {
                    params: {
                        search: this.search,
                        search_first_balance: this.search_first_balance,

                        search_consumption_install: this.search_consumption_install,
                        start_return_to_plb_gmf: this.search_return_to_plb_gmf,
                        start_last_balance: this.search_last_balance,
                        order: this.order,
                        by: this.by,
                        paginate: this.paginate,
                    },
                })
                .then((response) => {
                    this.movement_allotment = response.data;
                    this.current_page = this.movement_allotment.current_page;
                    console.log(this.movement_allotment);
                    Swal.close();
                })
                .catch((error) => console.log(error));
        },
        directPage: debounce(function () {
            if (this.current_page < 1) {
                this.current_page = 1;
            } else if (this.current_page > this.movement_allotment.last_page) {
                this.current_page = this.movement_allotment.last_page;
            }

            let url = new URL(this.movement_allotment.first_page_url);
            let search_params = url.searchParams;
            search_params.set("page", this.current_page);
            url.search = search_params.toString();
            let new_url = url.toString();
            this.list(new_url);
        }, 500),
        sort(order, by) {
            this.order = order;
            this.by = by;
            this.list();
        },
        showLoading() {
            Swal.fire({
                didOpen: () => {
                    Swal.showLoading();
                },
                background: "transparent",
                allowOutsideClick: false,
            });
        },
        filter() {
            this.list();
        },
        reset() {
            this.list();
        },
    },
};
</script>
