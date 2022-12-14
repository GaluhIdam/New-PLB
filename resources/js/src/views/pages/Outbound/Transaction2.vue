<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0">Outbound Transaction 2</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link to="/dashboard">Dashboard</router-link>
              </li>
              <li class="breadcrumb-item active">
                <router-link to="/outbound-transcation">Outbound Transaction</router-link>
              </li>
              <li class="breadcrumb-item active">
                <span>Transaction 2</span>
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
            <div class="card card-plb">
              <div class="card-header ui-sortable-handle">
                <h5 class="card-title card_title_margin">
                  <i class="nav-icon fa-solid fa-money-bill-transfer"></i>
                  Outbound Transaction 2
                </h5>
                <div class="card-tools">
                  <button type="button" data-card-widget="collapse" class="btn btn-tool">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- BEGIN: Card Body -->
              <div class="card-body">
                <!-- BEGIN: Cari Data -->
                <div class="row justify-content-center">
                  <div class="col-md-8">
                    <form @submit.prevent class="form-horizontal">
                      <div class="form-group row mt-4">
                        <label class="col-sm-3 col-form-label">Tanggal Outbound</label>
                        <div class="col-sm-4">
                          <datepicker input-class="form-control" placeholder="Dari Tanggal" format="dd/MM/yyyy"
                            v-model="filter_start_date" autofocus />
                        </div>
                        <div class="col-sm-4">
                          <datepicker input-class="form-control" placeholder="Sampai Tanggal" format="dd/MM/yyyy"
                            v-model="filter_end_date" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal AJU</label>
                        <div class="col-sm-4">
                          <datepicker input-class="form-control" placeholder="Dari Tanggal" format="dd/MM/yyyy"
                            v-model="start_submission_date" autofocus />
                        </div>
                        <div class="col-sm-4">
                          <datepicker input-class="form-control" placeholder="Sampai Tanggal" format="dd/MM/yyyy"
                            v-model="end_submission_date" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Jenis Dokumen</label>
                        <div class="col-sm-2">
                          <label class="control-label" style="margin-top: 5px">
                            <input type="checkbox" id="EX27" value="EX27" v-model="filter_document_type" />
                            27
                          </label>
                        </div>
                        <div class="col-sm-2">
                          <label class="control-label" style="margin-top: 5px">
                            <input type="checkbox" id="BC28" value="BC28" v-model="filter_document_type" />
                            28
                          </label>
                        </div>
                        <div class="col-sm-2">
                          <label class="control-label" style="margin-top: 5px">
                            <input type="checkbox" id="BC30" value="BC30" v-model="filter_document_type" />
                            30
                          </label>
                        </div>
                        <div class="col-sm-2">
                          <label class="control-label" style="margin-top: 5px">
                            <input type="checkbox" id="BC41" value="BC41" v-model="filter_document_type" />
                            41
                          </label>
                        </div>
                      </div>
                      <div class="form-group row justify-content-center">
                        <div class="col-sm-6">
                          <button class="btn btn-primary" @click="filterButton">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Filter
                          </button>
                          <button class="btn btn-secondary" @click="clearForm">
                            <i class="fa-solid fa-rotate"></i> Reset
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- END: Cari Data -->
                <hr />

                <!-- BEGIN: Tampil Data -->
                <!-- <div class="form-group mt-4" v-if="filter_clicked"> -->
                <div class="form-group mt-4">
                  <div class="vgt-wrap polar-bear">
                    <div class="vgt-inner-wrap">
                      <!-- BEGIN: Global Search -->
                      <div class="vgt-global-search vgt-clearfix">
                        <div class="vgt-global-search__input vgt-pull-left">
                          <label>
                            <span aria-hidden="true" class="input__icon">
                              <div class="magnifying-glass"></div>
                            </span>
                            <span class="sr-only"> Search </span>
                          </label>
                          <input type="text" placeholder="Search Data" class="vgt-input vgt-pull-left" v-model="search"
                            @change="list()" />
                        </div>
                        <div class="vgt-global-search__actions vgt-pull-right" v-if="$gate.isAdminOrPlanner()">
                          <div>
                            <button class="btn btn-secondary ms-auto rounded-1" @click="exportCsv">
                              <i class="fa-solid fa-file-csv"></i>
                              CSV
                            </button>
                            <button class="btn btn-secondary ms-auto rounded-1" style="margin-right: 10px"
                              @click="exportExcel">
                              <i class="fa-solid fa-file-excel"></i>
                              Excel
                            </button>
                            <!-- <button
                              class="btn btn-secondary ms-auto rounded-1"
                              style="margin-right: 10px"
                            >
                              <i class="fa-solid fa-file-pdf"></i>
                              PDF
                            </button> -->
                          </div>
                        </div>
                        <div class="vgt-global-search__actions vgt-pull-right" v-else style="margin-right: 5px"></div>
                      </div>
                      <!-- END: Global Search -->

                      <!-- BEGIN: Table -->
                      <div class="vgt-responsive">
                        <table id="vgt-table" class="vgt-table bordered polar-bear">
                          <thead>
                            <!-- BEGIN: Header Table -->
                            <tr>
                              <!-- BEGIN: Part Number Header -->
                              <th v-if="order == 'part_number' && by == 'asc'" @click="sort('part_number', 'desc')"
                                class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Part Number</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="
                                order == 'part_number' && by == 'desc'
                              " @click="sort('DATE_INSTALL', 'desc')" class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                ">
                                <span class="table_header">Part Number</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('part_number', 'asc')" class="text-center sortable">
                                <span class="table_header">Part Number</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Part Number Header -->
                              <!-- BEGIN: Description Header -->
                              <th v-if="order == 'description' && by == 'asc'" @click="sort('description', 'desc')"
                                class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Description</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="
                                order == 'description' && by == 'desc'
                              " @click="sort('DATE_INSTALL', 'desc')" class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                ">
                                <span class="table_header">Description</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('description', 'asc')" class="text-center sortable">
                                <span class="table_header">Description</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Description Header -->

                              <!-- BEGIN: Quantity Header -->
                              <th v-if="order == 'quantity' && by == 'asc'" @click="sort('quantity', 'desc')"
                                class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Quantity</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'quantity' && by == 'desc'" @click="sort('DATE_INSTALL', 'desc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                ">
                                <span class="table_header">Quantity</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('quantity', 'asc')" class="text-center sortable">
                                <span class="table_header">Quantity</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Quantity Header -->

                              <!-- BEGIN: Unit Ueasure Header -->
                              <th v-if="order == 'unit_measure' && by == 'asc'" @click="sort('unit_measure', 'desc')"
                                class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Kode Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="
                                order == 'unit_measure' && by == 'desc'
                              " @click="sort('DATE_INSTALL', 'desc')" class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                ">
                                <span class="table_header">Kode Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('unit_measure', 'asc')" class="text-center sortable">
                                <span class="table_header">Kode Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Unit Ueasure Header -->

                              <!-- BEGIN: Register A/C Header -->
                              <th v-if="
                                order == 'register_aircraft' && by == 'asc'
                              " @click="sort('register_aircraft', 'desc')"
                                class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Register A/C</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="
                                order == 'register_aircraft' && by == 'desc'
                              " @click="sort('DATE_INSTALL', 'desc')" class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                ">
                                <span class="table_header">Register A/C</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('register_aircraft', 'asc')" class="text-center sortable">
                                <span class="table_header">Register A/C</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Register A/C Header -->

                              <!-- BEGIN: Customer Header -->
                              <th v-if="order == 'customer' && by == 'asc'" @click="sort('customer', 'desc')"
                                class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Customer</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'customer' && by == 'desc'" @click="sort('DATE_INSTALL', 'desc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                ">
                                <span class="table_header">Customer</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('customer', 'asc')" class="text-center sortable">
                                <span class="table_header">Customer</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Customer Header -->

                              <!-- BEGIN: Date Install Header -->
                              <th v-if="order == 'date_install' && by == 'asc'" @click="sort('date_install', 'desc')"
                                class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Date Install</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="
                                order == 'date_install' && by == 'desc'
                              " @click="sort('DATE_INSTALL', 'desc')" class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                ">
                                <span class="table_header">Date Install</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('date_install', 'asc')" class="text-center sortable">
                                <span class="table_header">Date Install</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Date Install Header -->

                              <!-- BEGIN: Date A/C IN Header -->
                              <th v-if="
                                order == 'date_aircraft_in' && by == 'asc'
                              " @click="sort('date_aircraft_in', 'desc')"
                                class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Date A/C In</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="
                                order == 'date_aircraft_in' && by == 'desc'
                              " @click="sort('DATE_INSTALL', 'desc')" class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                ">
                                <span class="table_header">Date A/C In</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('date_aircraft_in', 'asc')" class="text-center sortable">
                                <span class="table_header">Date A/C In</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Date A/C IN Header -->

                              <!-- BEGIN: Date A/C Out Header -->
                              <th v-if="
                                order == 'DATE_AIRCRAFT_OUT' && by == 'asc'
                              " @click="sort('DATE_AIRCRAFT_OUT', 'desc')"
                                class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Date A/C Out</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="
                                order == 'DATE_AIRCRAFT_OUT' && by == 'desc'
                              " @click="sort('DATE_INSTALL', 'desc')" class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                ">
                                <span class="table_header">Date A/C Out</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('DATE_AIRCRAFT_OUT', 'asc')" class="text-center sortable">
                                <span class="table_header">Date A/C Out</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Date A/C OUT Header -->

                              <!-- BEGIN: Jenis Dokumen Header -->
                              <th v-if="order == 'TYPE_BC' && by == 'asc'" @click="sort('TYPE_BC', 'desc')"
                                class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Type BC</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'TYPE_BC' && by == 'desc'" @click="sort('DATE_INSTALL', 'desc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                ">
                                <span class="table_header">Type BC</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('TYPE_BC', 'asc')" class="text-center sortable">
                                <span class="table_header">Type BC</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Jenis Dokumen Header -->

                              <!-- BEGIN: Nomor AJU Header -->
                              <th v-if="
                                order == 'submission_number' && by == 'asc'
                              " @click="sort('submission_number', 'desc')"
                                class="text-center sortable sorting sorting-asc">
                                <span class="table_header">No. AJU</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="
                                order == 'submission_number' && by == 'desc'
                              " @click="sort('DATE_INSTALL', 'asc')" class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                ">
                                <span class="table_header">No. AJU</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('submission_number', 'asc')" class="text-center sortable">
                                <span class="table_header">No. AJU</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Nomor AJU Header -->

                              <!-- BEGIN: TTD Date Header -->
                              <th v-if="order == 'TTD_DATE' && by == 'asc'" @click="sort('TTD_DATE', 'desc')"
                                class="text-center sortable sorting sorting-asc">
                                <span class="table_header">TTD Date</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'TTD_DATE' && by == 'desc'" @click="sort('DATE_INSTALL', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                ">
                                <span class="table_header">TTD Date</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('TTD_DATE', 'asc')" class="text-center sortable">
                                <span class="table_header">TTD Date</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: TTD Date Header -->

                              <!-- BEGIN: CIF_RUPIAH Header -->
                              <th v-if="order == 'cif_idr' && by == 'asc'" @click="sort('cif_idr', 'desc')"
                                class="text-center sortable sorting sorting-asc">
                                <span class="table_header">CIF IDR</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'cif_idr' && by == 'desc'" @click="sort('DATE_INSTALL', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                ">
                                <span class="table_header">CIF IDR</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('cif_idr', 'asc')" class="text-center sortable">
                                <span class="table_header">CIF IDR</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: CIF_RUPIAH Header -->

                              <!-- BEGIN: BM Dibayar Header -->
                              <th class="text-center">
                                <span class="table_header">BM Dibayar</span>
                              </th>
                              <!-- END: BM Dibayar Header -->

                              <!-- BEGIN: PPn Dibayar Header -->
                              <th class="text-center">
                                <span class="table_header">PPn Dibayar</span>
                              </th>
                              <!-- END: PPn Dibayar Header -->

                              <!-- BEGIN: PPh Dibayar Header -->
                              <th class="text-center">
                                <span class="table_header">PPh Dibayar</span>
                              </th>
                              <!-- END: PPh Dibayar Header -->
                            </tr>
                            <!-- END: Header Table -->
                            <tr>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input text-center" placeholder="Part Number"
                                    v-model="search_part_number" @change="list()" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input text-center" placeholder="Description"
                                    v-model="search_description" @change="list()" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input text-center" placeholder="Quantity"
                                    v-model="search_quantity" @change="list()" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input text-center" placeholder="Kode satuan"
                                    v-model="search_unit_measure" @change="list()" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input text-center" placeholder="Register A/C"
                                    v-model="search_register_aircraft" @change="list()" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input text-center" placeholder="Customer"
                                    v-model="search_customer" @change="list()" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="date" class="vgt-input" placeholder="Date Install"
                                    v-model="search_date_install" @change="list()" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="date" class="vgt-input" placeholder="Date A/C In"
                                    v-model="search_date_aircraft_in" @change="list()" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="date" class="vgt-input" placeholder="Date A/C Out"
                                    v-model="search_date_aircraft_out" @change="list()" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input text-center" placeholder="Type BC"
                                    v-model="search_document_type" @change="list()" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input text-center" placeholder="Nomor AJU"
                                    v-model="search_submission_number" @change="list()" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="date" class="vgt-input text-center" placeholder="TTD Date"
                                    v-model="search_ttd_date" @change="list()" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input text-center" placeholder="CIF IDR"
                                    v-model="search_cif_idr" @change="list()" />
                                </div>
                              </th>
                              <th class="filter-th"></th>
                              <th class="filter-th"></th>
                              <th class="filter-th"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <!-- BEGIN: Tampil Data -->
                            <tr v-for="(
                                outbound, outbound_index
                              ) in outbounds.data" :key="outbound_index">
                              <td v-if="outbound.PART_NUMBER === null" class="text-center table_content">
                                -
                              </td>
                              <td class="text-center table_content" v-else>
                                {{ outbound.PART_NUMBER }}
                              </td>
                              <td v-if="outbound.DESCRIPTION === null" class="text-center table_content">
                                -
                              </td>
                              <td class="text-center table_content" v-else>
                                {{ outbound.DESCRIPTION }}
                              </td>
                              <!-- BEGIN : Quantity -->
                              <td v-if="outbound.QUANTITY === null" class="text-center table_content">
                                -
                              </td>
                              <td class="text-center table_content" v-else>
                                {{ outbound.QUANTITY }}
                              </td>
                              <!-- END : Quantity -->
                              <!-- BEGIN : Kode Satuan -->
                              <td v-if="outbound.UNIT_MEASURE === null" class="text-center table_content">
                                -
                              </td>
                              <td class="text-center table_content" v-else>
                                {{ outbound.UNIT_MEASURE }}
                              </td>
                              <!-- END : Kode Satuan -->
                              <!-- BEGIN : Register Aircraft -->
                              <td v-if="outbound.REGISTER_AIRCRAFT === null" class="text-center table_content">
                                -
                              </td>
                              <td class="text-center table_content" v-else>
                                {{ outbound.REGISTER_AIRCRAFT }}
                              </td>
                              <!-- END : Register Aircraft -->
                              <td v-if="outbound.CUSTOMER === null" class="text-center table_content">
                                -
                              </td>
                              <td class="text-center table_content" v-else>
                                {{ outbound.CUSTOMER }}
                              </td>
                              <td class="table_content text-center">
                                {{ outbound.DATE_INSTALL | myDate }}
                              </td>
                              <td class="table_content text-center">
                                {{ outbound.DATE_AIRCRAFT_IN | myDateTime }}
                              </td>
                              <td class="table_content text-center">
                                {{ outbound.DATE_AIRCRAFT_OUT | myDateTime }}
                              </td>
                              <td v-if="outbound.TYPE_BC === null" class="text-center table_content">
                                -
                              </td>
                              <td class="text-center table_content" v-else>
                                {{ outbound.TYPE_BC }}
                              </td>
                              <td class="table_content text-center">
                                {{ outbound.SUBMISSION_NUMBER }}
                              </td>
                              <td class="table_content text-center">
                                {{ outbound.TTD_DATE | myDate }}
                              </td>
                              <td v-if="outbound.CIF_IDR === null" class="text-center table_content">
                                -
                              </td>
                              <td class="text-center table_content" v-else>
                                {{ outbound.CIF_IDR | formatNumber }}
                              </td>
                              <td class="table_content text-center">
                                <span v-if="outbound.JENIS_TARIF == 'BM'">{{
                                    outbound.TARIF
                                }}</span>
                              </td>
                              <td class="table_content text-center">
                                <span v-if="outbound.JENIS_TARIF == 'PPN'">{{
                                    outbound.TARIF
                                }}</span>
                              </td>
                              <td class="table_content text-center">
                                <span v-if="outbound.JENIS_TARIF == 'PPH'">{{
                                    outbound.TARIF
                                }}</span>
                              </td>
                            </tr>
                            <!-- END: Tampil Data -->
                            <!-- BEGIN: Data Kosong -->
                            <tr v-if="outbounds.data.length < 1">
                              <td colspan="16">
                                <div class="vgt-center-align vgt-text-disabled">
                                  Data not found
                                </div>
                              </td>
                            </tr>
                            <!-- END: Data Kosong -->
                          </tbody>
                        </table>
                      </div>
                      <!-- END: Table -->

                      <!-- BEGIN: Pagination Table -->
                      <div class="vgt-wrap__footer vgt-clearfix">
                        <div class="footer__row-count vgt-pull-left">
                          <label class="footer__row-count__label row_per_page_label">
                            Rows per page:
                          </label>
                          <select class="
                              footer__row-count__select
                              row_per_page_option
                            " v-model="paginate" @change="list()">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                          </select>
                        </div>
                        <div class="footer__navigation vgt-pull-right">
                          <button type="button" class="footer__navigation__page-btn" :class="{
                            disabled: !outbounds.prev_page_url,
                          }" @click="
  outbounds.prev_page_url &&
  list(outbounds.prev_page_url)
" style="margin-right: 0px">
                            <span aria-hidden="true" class="chevron left"></span>
                            <span class="paginate_text">Prev</span>
                          </button>
                          <div class="footer__navigation__page-info" style="color: #99a0b2">
                            <label class="page-info__label" style="margin-bottom: -5px">
                              <span class="paginate_text">page</span>
                              <input type="text" class="
                                  footer__navigation__page-info__current-entry
                                  vgt-input
                                " v-model="current_page" @keypress="directPage" style="width: 60px" />
                              <span class="paginate_text">
                                of
                                {{ outbounds.last_page }}
                              </span>
                            </label>
                          </div>
                          <button type="button" class="footer__navigation__page-btn" :class="{
                            disabled: !outbounds.next_page_url,
                          }" @click="
  outbounds.next_page_url &&
  list(outbounds.next_page_url)
">
                            <span style="font-weight: 500">Next</span>
                            <span aria-hidden="true" class="chevron right"></span>
                          </button>
                        </div>
                      </div>
                      <!-- END: Pagination Table -->
                    </div>
                  </div>
                </div>
                <!-- END: Tampil Data -->
              </div>
              <!-- END: Card Body -->
              <div class="card-footer text-center" v-if="filter_clicked">
                Inventory berkurang BC 28 AJU​
              </div>
            </div>
            <!-- END: Card -->
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
import Swal from "sweetalert2"

moment.locale("id");

export default {
  data() {
    return {
      outbounds: {
        data: [],
        links: [],
      },
      // Search Data
      search: null, // Search Data Global
      search_part_number: null, // Search Part Number
      search_description: null, // Search Description
      search_quantity: null, // Search Quantity
      search_unit_measure: null, // Search Unit Measure
      search_register_aircraft: null, // Search Register Aircraft
      search_customer: null, // Search Customer
      search_date_install: null, // Search Date Install
      search_date_aircraft_in: null, // Search Date Aircraft In
      search_date_aircraft_out: null, // Search Date Aircraft Out
      search_document_type: null, // Search Document Type
      search_submission_number: null, // Search Submission Number
      search_submission_date: null, // Search Submission Date
      search_ttd_date: null, // Search TTD Date
      search_cif_idr: null, // Search CIF IDR

      // Order By
      order: "DATE_INSTALL",
      by: "desc",
      paginate: "10",
      current_page: null,

      // Filter
      filter_start_date: null,
      filter_end_date: null,
      start_submission_date: null,
      end_submission_date: null,
      filter_document_type: [],
      filter_clicked: false,
    };
  },
  methods: {
    list(paginate) {
      this.showLoading();
      paginate = paginate || `/api/outbound-transaction-2`;
      axios
        .get(paginate, {
          params: {
            // This is for Search Data
            search: this.search,
            search_part_number: this.search_part_number,
            search_description: this.search_description,
            search_quantity: this.search_quantity,
            search_unit_measure: this.search_unit_measure,
            search_register_aircraft: this.search_register_aircraft,
            search_customer: this.search_customer,
            search_date_install: this.search_date_install,
            search_date_aircraft_in: this.search_date_aircraft_in,
            search_date_aircraft_out: this.search_date_aircraft_out,
            search_document_type: this.search_document_type,
            search_submission_number: this.search_submission_number,
            search_submission_date: this.search_submission_date,
            search_ttd_date: this.search_ttd_date,
            search_cif_idr: this.search_cif_idr,

            // This is for filter Data
            filter_start_date: this.filter_start_date,
            filter_end_date: this.filter_end_date,
            start_submission_date: this.start_submission_date,
            end_submission_date: this.end_submission_date,
            filter_document_type: this.filter_document_type,

            // This is for order by
            order: this.order,
            by: this.by,
            paginate: this.paginate,
          },
        })
        .then((response) => {
          this.outbounds = response.data;
          this.current_page = this.outbounds.current_page;
          Swal.close();
          this.showSuccessRequest();
        })
        .catch((error) => {
          Swal.close();
          this.showErrorRequest();
          console.log(error);
        });
    },
    exportExcel() {
      this.showLoading();
      axios
        .get("/api/outbound-transaction-2-excel", {
          params: {
            // This is for Search Data
            search: this.search,
            search_part_number: this.search_part_number,
            search_description: this.search_description,
            search_quantity: this.search_quantity,
            search_unit_measure: this.search_unit_measure,
            search_register_aircraft: this.search_register_aircraft,
            search_customer: this.search_customer,
            search_date_install: this.search_date_install,
            search_date_aircraft_in: this.search_date_aircraft_in,
            filter_start_date: this.filter_start_date,
            filter_end_date: this.filter_end_date,
            start_submission_date: this.start_submission_date,
            end_submission_date: this.end_submission_date,
            filter_document_type: this.filter_document_type,
            order: this.order,
            by: this.by,
          },
          responseType: "blob",
        })
        .then((response) => {
          const url = window.URL.createObjectURL(new Blob([response.data]));
          const link = document.createElement("a");
          link.href = url;
          link.setAttribute("download", "outbound-transaction-two.xlsx");
          document.body.appendChild(link);
          link.click();
          Swal.close();
          this.showSuccessExport();
        })
        .catch((error) => {
          Swal.close();
          this.showErrorExport();
          console.log(error);
        });
    },
    exportCsv() {
      this.showLoading();
      axios
        .get("/api/outbound-transaction-2-csv", {
          params: {
            // This is for Search Data
            search: this.search,
            search_part_number: this.search_part_number,
            search_description: this.search_description,
            search_quantity: this.search_quantity,
            search_unit_measure: this.search_unit_measure,
            search_register_aircraft: this.search_register_aircraft,
            search_customer: this.search_customer,
            search_date_install: this.search_date_install,
            search_date_aircraft_in: this.search_date_aircraft_in,
            filter_start_date: this.filter_start_date,
            filter_end_date: this.filter_end_date,
            start_submission_date: this.start_submission_date,
            end_submission_date: this.end_submission_date,
            filter_document_type: this.filter_document_type,
            order: this.order,
            by: this.by,
          },
          responseType: "blob",
        })
        .then((response) => {
          const url = window.URL.createObjectURL(new Blob([response.data]));
          const link = document.createElement("a");
          link.href = url;
          link.setAttribute("download", "outbound-transaction-two.csv");
          document.body.appendChild(link);
          link.click();
          Swal.close();
          this.showSuccessExport();

        })
        .catch((error) => {
          Swal.close();
          this.showErrorExport();
          console.log(error);
        });
    },
    filterButton() {
      this.filter_clicked = true;
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
    showSuccessRequest() {
      Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: 'Successfully Retrieve Data',
        showConfirmButton: false,
        timer: 1500
      })
    },
    showErrorRequest() {
      Swal.fire({
        toast: true,
        position: "top-end",
        icon: "error",
        title: "Failed to Retrieve Data",
        showConfirmButton: false,
        timer: 1500,
      });
    },
    showSuccessExport() {
      Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: 'Successfully Export Data',
        showConfirmButton: false,
        timer: 1500
      })
    },
    showErrorExport() {
      Swal.fire({
        toast: true,
        position: "top-end",
        icon: "error",
        title: "Failed to Export Data",
        showConfirmButton: false,
        timer: 1500,
      });
    },
    clearForm() {
      this.outbounds = {
        data: [],
        links: [],
      };
      this.filter_start_date = null;
      this.filter_end_date = null;
      this.filter_customer = null;
      this.start_submission_date = null;
      this.end_submission_date = null;
      this.filter_document_type = [];
      this.search = null; // Search Data Global
      this.search_part_number = null; // Search Part Number
      this.search_description = null; // Search Description
      this.search_quantity = null; // Search Quantity
      this.search_unit_measure = null; // Search Unit Measure
      this.search_register_aircraft = null; // Search Register Aircraft
      this.search_customer = null; // Search Customer
      this.search_date_install = null; // Search Date Install
      this.search_date_aircraft_in = null; // Search Date Aircraft In
      this.search_date_aircraft_out = null; // Search Date Aircraft Out
      this.search_document_type = null; // Search Document Type
      this.search_submission_number = null; // Search Submission Number
      this.search_submission_date = null; // Search Submission Date
      this.search_ttd_date = null; // Search TTD Date
      this.search_cif_idr = null; // Search CIF IDR
    },
    directPage: debounce(function () {
      if (this.current_page < 1) {
        this.current_page = 1;
      } else if (this.current_page > this.outbounds.last_page) {
        this.current_page = this.outbounds.last_page;
      }
      let url = new URL(this.outbounds.first_page_url);
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
  },
};
</script>
<style scoped>
.vgt-global-search__input .input__icon .magnifying-glass {
  margin-top: -3px;
}
</style>
