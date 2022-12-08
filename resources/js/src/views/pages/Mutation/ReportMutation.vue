<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Mutation Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">
                <a href="/report-mutation">Mutation Report</a>
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
            <!-- BEGIN: Card -->
            <div class="card card-plb">
              <!-- BEGIN: Card Header -->
              <div class="card-header ui-sortable-handle">
                <h5 class="card-title card_title_margin">
                  <i class="fa-solid fa-file-circle-exclamation mr-1"></i>
                  Mutation Report
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
              <!-- END: Card Header -->

              <!-- BEGIN: Card Body -->
              <div class="card-body">
                <!-- BEGIN: Cari Data -->
                <div class="row justify-content-center">
                  <div class="col-md-8">
                    <form @submit.prevent class="form-horizontal">
                      <div class="form-group row mt-4">
                        <label class="col-sm-3 col-form-label"
                          >Tanggal Mutasi</label
                        >
                        <div class="col-sm-4">
                          <datepicker
                            input-class="form-control"
                            placeholder="Dari Tanggal"
                            format="MM/dd/yyyy"
                            v-model="filter_start_date"
                          />
                        </div>
                        <div class="col-sm-4">
                          <datepicker
                            input-class="form-control"
                            placeholder="Sampai Tanggal"
                            format="MM/dd/yyyy"
                            v-model="filter_end_date"
                          />
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
                <div class="form-group mt-4">
                  <div class="vgt-wrap polar-bear">
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
                          <input
                            type="text"
                            placeholder="Search Data"
                            class="vgt-input vgt-pull-left"
                            v-model="search"
                            @change="list()"
                          />
                        </div>
                        <div class="vgt-global-search__actions vgt-pull-right">
                          <div>
                            <!-- <button class="btn btn-secondary ms-auto rounded-1">
                              <i class="fa-solid fa-file-csv"></i>
                              CSV
                            </button>
                            <button class="btn btn-secondary ms-auto rounded-1">
                              <i class="fa-solid fa-file-excel"></i>
                              Excel
                            </button>
                            <button
                              class="btn btn-secondary ms-auto rounded-1"
                              style="margin-right: 10px"
                            >
                              <i class="fa-solid fa-file-pdf"></i>
                              PDF
                            </button> -->
                          </div>
                        </div>
                      </div>
                      <!-- END :  Global Search -->
                      <div class="vgt-responsive">
                        <table
                          id="vgt-table"
                          class="vgt-table bordered polar-bear"
                        >
                          <thead>
                            <tr>
                              <!-- BEGIN: Number by ID (Table Header) -->
                              <!-- <th
                                rowspan="2"
                                
                                v-if="order == 'id' && by == 'asc'"
                                @click="sort('id', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">No.</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                rowspan="2"
                                v-else-if="order == 'id' && by == 'desc'"
                                @click="sort('id', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">No.</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                rowspan="2"
                                v-else
                                @click="sort('id', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">No.</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th> -->
                              <th rowspan="2" class="text-center">
                                <span class="table_header">No.</span>
                              </th>
                              <!-- END: Number by ID (Table Header) -->
                              <!-- BEGIN: Kode Barang (Table Header) -->
                              <th
                                rowspan="2"
                                v-if="order == 'KODE_BARANG_1' && by == 'asc'"
                                @click="sort('KODE_BARANG_1', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Kode Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                rowspan="2"
                                v-else-if="
                                  order == 'KODE_BARANG_1' && by == 'desc'
                                "
                                @click="sort('TANGGAL_SALDO_1', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">Kode Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                rowspan="2"
                                v-else
                                @click="sort('KODE_BARANG_1', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Kode Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Kode Barang (Table Header) -->
                              <!-- BEGIN: Nama Barang (Table Header) -->
                              <th
                                rowspan="2"
                                v-if="order == 'URAIAN_1' && by == 'asc'"
                                @click="sort('URAIAN_1', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Nama Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                rowspan="2"
                                v-else-if="order == 'URAIAN_1' && by == 'desc'"
                                @click="sort('TANGGAL_SALDO_1', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">Nama Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                rowspan="2"
                                v-else
                                @click="sort('URAIAN_1', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Nama Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Nama Barang (Table Header) -->
                              <!-- BEGIN: Satuan (Table Header) -->
                              <th
                                rowspan="2"
                                v-if="order == 'KODE_SATUAN_1' && by == 'asc'"
                                @click="sort('KODE_SATUAN_1', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                rowspan="2"
                                v-else-if="
                                  order == 'KODE_SATUAN_1' && by == 'desc'
                                "
                                @click="sort('TANGGAL_SALDO_1', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                rowspan="2"
                                v-else
                                @click="sort('KODE_SATUAN_1', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Satuan (Table Header) -->
                              <!-- BEGIN: Saldo Awal (Table Header) -->
                              <th
                                rowspan="2"
                                v-if="order == 'SALDO_AWAL_1' && by == 'asc'"
                                @click="sort('SALDO_AWAL_1', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Saldo Awal</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                rowspan="2"
                                v-else-if="
                                  order == 'SALDO_AWAL_1' && by == 'desc'
                                "
                                @click="sort('TANGGAL_SALDO_1', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">Saldo Awal</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                rowspan="2"
                                v-else
                                @click="sort('SALDO_AWAL_1', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Saldo Awal</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Saldo Awal (Table Header) -->
                              <th colspan="3" class="text-center">
                                <span class="table_header">Pemasukan</span>
                              </th>
                              <th colspan="4" class="text-center">
                                <span class="table_header">Pengeluaran</span>
                              </th>
                              <!-- BEGIN: Penyesuaian (Table Header) -->
                              <!-- <th
                                rowspan="2"
                                v-if="order == 'adjustment' && by == 'asc'"
                                @click="sort('adjustment', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Penyesuaian</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                rowspan="2"
                                v-else-if="
                                  order == 'adjustment' && by == 'desc'
                                "
                                @click="sort('adjustment', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">Penyesuaian</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                rowspan="2"
                                v-else
                                @click="sort('adjustment', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Penyesuaian</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th> -->
                              <!-- END: Penyesuaian (Table Header) -->
                              <!-- BEGIN: Saldo Buku (Table Header) -->
                              <th rowspan="2" class="text-center">
                                <span class="table_header">Saldo Buku</span>
                              </th>
                              <!-- END: Saldo Buku (Table Header) -->
                              <!-- BEGIN: Saldo Akhir (Table Header) -->
                              <th
                                rowspan="2"
                                v-if="order == 'SALDO_AKHIR_1' && by == 'asc'"
                                @click="sort('SALDO_AKHIR_1', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Saldo Akhir</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                rowspan="2"
                                v-else-if="
                                  order == 'SALDO_AKHIR_1' && by == 'desc'
                                "
                                @click="sort('TANGGAL_SALDO_1', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">Saldo Akhir</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                rowspan="2"
                                v-else
                                @click="sort('SALDO_AKHIR_1', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Saldo Akhir</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Saldo Akhir (Table Header) -->

                              <!-- BEGIN: Selisih (Table Header) -->
                              <th rowspan="2" class="text-center">
                                <span class="table_header">Selisih</span>
                              </th>
                              <!-- END: Selisih (Table Header) -->
                            </tr>
                            <tr>
                              <!-- BEGIN: BC 1.6 In (Table Header) -->
                              <th
                                v-if="order == 'BC16' && by == 'asc'"
                                @click="sort('BC16', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">BC 1.6</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'BC16' && by == 'desc'"
                                @click="sort('TANGGAL_SALDO_1', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">BC 1.6</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('BC16', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">BC 1.6</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: BC 1.6 In (Table Header) -->
                              <!-- BEGIN: BC 2.7 In (Table Header) -->
                              <th
                                v-if="order == 'BC27IN' && by == 'asc'"
                                @click="sort('BC27IN', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">BC 2.7</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'BC27IN' && by == 'desc'"
                                @click="sort('TANGGAL_SALDO_1', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">BC 2.7</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('BC27IN', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">BC 2.7</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: BC 2.7 In (Table Header) -->
                              <!-- BEGIN: BC 4.0 In (Table Header) -->
                              <th
                                v-if="order == 'BC40' && by == 'asc'"
                                @click="sort('BC40', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">BC 4.0</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'BC40' && by == 'desc'"
                                @click="sort('TANGGAL_SALDO_1', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">BC 4.0</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('BC40', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">BC 4.0</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: BC 4.0 In (Table Header) -->

                              <!-- BEGIN: BC 2.7 Out (Table Header) -->
                              <th
                                v-if="order == 'BC27' && by == 'asc'"
                                @click="sort('BC27', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">BC 2.7</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'BC27' && by == 'desc'"
                                @click="sort('TANGGAL_SALDO_1', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">BC 2.7</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('BC27', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">BC 2.7</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: BC 2.7 Out (Table Header) -->
                              <!-- BEGIN: BC 2.8 Out (Table Header) -->
                              <th
                                v-if="order == 'BC28' && by == 'asc'"
                                @click="sort('BC28', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">BC 2.8</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'BC28' && by == 'desc'"
                                @click="sort('TANGGAL_SALDO_1', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">BC 2.8</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('BC28', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">BC 2.8</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: BC 2.8 Out (Table Header) -->
                              <!-- BEGIN: BC 3.0 Out (Table Header) -->
                              <th
                                v-if="order == 'BC30' && by == 'asc'"
                                @click="sort('BC30', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">BC 3.0</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'BC30' && by == 'desc'"
                                @click="sort('TANGGAL_SALDO_1', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">BC 3.0</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('BC30', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">BC 3.0</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: BC 3.0 Out (Table Header) -->
                              <!-- BEGIN: BC 4.1 Out (Table Header) -->
                              <th
                                v-if="order == 'BC41' && by == 'asc'"
                                @click="sort('BC41', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">BC 4.1</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'BC41' && by == 'desc'"
                                @click="sort('TANGGAL_SALDO_1', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">BC 4.1</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('BC41', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">BC 4.1</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: BC 4.1 Out (Table Header) -->
                            </tr>
                            <!-- BEGIN: Filter -->
                            <tr>
                              <!-- BEGIN: Filter Indexing -->
                              <th class="filter-th"></th>
                              <!-- END: Filter Indexing -->

                              <!-- BEGIN: Filter Kode Barang -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Kode Barang"
                                    v-model="search_kode_barang"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter Kode Barang -->

                              <!-- BEGIN: Filter Nama Barang -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Nama Barang"
                                    v-model="search_nama_barang"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter Nama Barang -->

                              <!-- BEGIN: Filter Kode Satuan -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Kode"
                                    v-model="search_kode_satuan"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter Kode Satuan -->

                              <!-- BEGIN: Filter Saldo Awal -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Awal"
                                    v-model="search_saldo_awal"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter Saldo Awal -->

                              <!-- BEGIN: Filter BC 1.6 -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="1.6"
                                    v-model="search_bc16"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter BC 1.6 -->

                              <!-- BEGIN: Filter BC 2.7 IN -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="2.7 IN"
                                    v-model="search_bc27_in"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter BC 2.7 IN -->

                              <!-- BEGIN: Filter BC 4.0 -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="4.0"
                                    v-model="search_bc40"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter BC 4.0 -->

                              <!-- BEGIN: Filter BC 2.7 OUT -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="2.7 OUT"
                                    v-model="search_bc27_out"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter BC 2.7 OUT -->

                              <!-- BEGIN: Filter BC 2.8 -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="2.8"
                                    v-model="search_bc28"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter BC 2.8 -->

                              <!-- BEGIN: Filter BC 3.0 -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="3.0"
                                    v-model="search_bc30"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter BC 3.0 -->

                              <!-- BEGIN: Filter BC 4.1 -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="4.1"
                                    v-model="search_bc41"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter BC 4.1 -->

                              <!-- BEGIN: Filter Saldo Buku -->
                              <th class="filter-th"></th>
                              <!-- END: Filter Saldo Buku -->

                              <!-- BEGIN: Filter Saldo Akhir -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Akhir"
                                    v-model="search_saldo_akhir"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <!-- END: Filter Saldo Akhir -->

                              <!-- BEGIN: Filter Saldo Selisih -->
                              <th class="filter-th"></th>
                              <!-- END: Filter Saldo Selisih -->
                            </tr>
                            <!-- END: Filter -->
                          </thead>
                          <!-- END: Table Head -->

                          <!-- BEGIN: Table Body -->
                          <tbody>
                            <!-- BEGIN: Table Content -->
                            <tr
                              v-for="(report, report_index) in reports.data"
                              :key="report_index"
                            >
                              <!-- BEGIN: Content No -->
                              <td class="text-center table-content">
                                {{ report_index + 1 }}
                              </td>
                              <!-- END: Content No -->
                              <!-- BEGIN: Content Kode Barang -->
                              <td class="text-center table_content">
                                {{
                                  checkDataString(
                                    report.KODE_BARANG_1,
                                    report.KODE_BARANG_2,
                                    report.KODE_BARANG_3
                                  )
                                }}
                              </td>
                              <!-- END: Content Kode Barang -->

                              <!-- BEGIN: Content Nama Barang -->
                              <td class="text-center table_content">
                                {{
                                  checkDataString(
                                    report.URAIAN_1,
                                    report.URAIAN_2,
                                    report.URAIAN_3
                                  )
                                }}
                              </td>
                              <!-- END: Content Nama Barang -->

                              <!-- BEGIN: Content Kode Satuan -->
                              <td class="text-center table_content">
                                {{
                                  checkDataString(
                                    report.KODE_SATUAN_1,
                                    report.KODE_SATUAN_2,
                                    report.KODE_SATUAN_3
                                  )
                                }}
                              </td>
                              <!-- END: Content Kode Satuan -->

                              <!-- BEGIN: Content Saldo Awal -->
                              <td class="text-center table_content">
                                {{
                                  checkDataNumber(
                                    report.SALDO_AWAL_1,
                                    report.SALDO_AWAL_2,
                                    report.SALDO_AWAL_3
                                  ) | formatNumber
                                }}
                              </td>
                              <!-- END: Content Saldo Awal -->

                              <!-- BEGIN: Content BC 1.6 -->
                              <td class="text-center table_content">
                                {{ report.BC16 | formatNumber }}
                              </td>
                              <!-- END: Content BC 1.6 -->

                              <!-- BEGIN: Content BC 2.7 IN -->
                              <td class="text-center table_content">
                                {{ report.BC27IN | formatNumber }}
                              </td>
                              <!-- END: Content BC 2.7 IN-->

                              <!-- BEGIN: Content BC 4.0  -->
                              <td class="text-center table_content">
                                {{ report.BC40 | formatNumber }}
                              </td>
                              <!-- END: Content BC 4.0 -->

                              <!-- BEGIN: Content BC 2.7 OUT -->
                              <td class="text-center table_content">
                                {{ report.BC27 | formatNumber }}
                              </td>
                              <!-- END: Content BC 2.7 OUT-->

                              <!-- BEGIN: Content BC 2.8 OUT -->
                              <td class="text-center table_content">
                                {{ report.BC28 | formatNumber }}
                              </td>
                              <!-- END: Content BC 2.8 OUT-->

                              <!-- BEGIN: Content BC 3.0 OUT -->
                              <td class="text-center table_content">
                                {{ report.BC30 | formatNumber }}
                              </td>
                              <!-- END: Content BC 3.0 OUT-->

                              <!-- BEGIN: Content BC 4.1 OUT -->
                              <td class="text-center table_content">
                                {{ report.BC41 | formatNumber }}
                              </td>
                              <!-- END: Content BC 4.1 OUT-->

                              <!-- BEGIN: Content Saldo Buku -->
                              <td class="text-center table_content">
                                <span
                                  v-if="
                                    Number(
                                      checkDataNumber(
                                        report.SALDO_AWAL_1,
                                        report.SALDO_AWAL_2,
                                        report.SALDO_AWAL_3
                                      )
                                    ) +
                                    Number(report.BC16) +
                                    Number(report.BC27IN) +
                                    Number(report.BC40) -
                                    Number(report.BC27) -
                                    Number(report.BC28) -
                                    Number(report.BC30) -
                                    Number(report.BC41)
                                  "
                                >
                                  {{
                                    Number(
                                      checkDataNumber(
                                        report.SALDO_AWAL_1,
                                        report.SALDO_AWAL_2,
                                        report.SALDO_AWAL_3
                                      )
                                    ) +
                                    Number(report.BC16) +
                                    Number(report.BC27IN) +
                                    Number(report.BC40) -
                                    Number(report.BC27) -
                                    Number(report.BC28) -
                                    Number(report.BC30) -
                                    Number(report.BC41)
                                  }}</span
                                >

                                <span v-else> - </span>
                              </td>
                              <!-- END: Content Saldo Buku -->

                              <!-- BEGIN: Content Saldo Akhir -->
                              <td class="text-center table_content">
                                {{
                                  checkDataNumber(
                                    report.SALDO_AKHIR_1,
                                    report.SALDO_AKHIR_2,
                                    report.SALDO_AKHIR_3
                                  ) | formatNumber
                                }}
                              </td>
                              <!-- END: Content Saldo Akhir -->

                              <!-- BEGIN: Content Selisih -->
                              <td class="text-center table_content">
                                <span
                                  v-if="
                                    Number(
                                      checkDataNumber(
                                        report.SALDO_AKHIR_1,
                                        report.SALDO_AKHIR_2,
                                        report.SALDO_AKHIR_3
                                      )
                                    ) -
                                    Number(
                                      checkDataNumber(
                                        report.SALDO_AWAL_1,
                                        report.SALDO_AWAL_2,
                                        report.SALDO_AWAL_3
                                      )
                                    ) +
                                    Number(report.BC16) +
                                    Number(report.BC27IN) +
                                    Number(report.BC40) -
                                    Number(report.BC27) -
                                    Number(report.BC28) -
                                    Number(report.BC30) -
                                    Number(report.BC41)
                                  "
                                >
                                  {{
                                    Number(
                                      checkDataNumber(
                                        report.SALDO_AKHIR_1,
                                        report.SALDO_AKHIR_2,
                                        report.SALDO_AKHIR_3
                                      )
                                    ) -
                                    Number(
                                      checkDataNumber(
                                        report.SALDO_AWAL_1,
                                        report.SALDO_AWAL_2,
                                        report.SALDO_AWAL_3
                                      )
                                    ) +
                                    Number(report.BC16) +
                                    Number(report.BC27IN) +
                                    Number(report.BC40) -
                                    Number(report.BC27) -
                                    Number(report.BC28) -
                                    Number(report.BC30) -
                                    Number(report.BC41)
                                  }}
                                </span>
                                <span v-else> - </span>
                              </td>
                              <!-- END: Content Selisih -->
                            </tr>
                            <tr v-if="reports.data.length < 1">
                              <td colspan="20">
                                <div class="vgt-center-align vgt-text-disabled">
                                  Data not found
                                </div>
                              </td>
                            </tr>
                          </tbody>

                          <!-- END: Table Body -->
                        </table>
                      </div>
                      <div class="vgt-wrap__footer vgt-clearfix">
                        <div class="footer__row-count vgt-pull-left">
                          <label
                            class="footer__row-count__label row_per_page_label"
                          >
                            Rows per page:
                          </label>
                          <select
                            class="
                              footer__row-count__select
                              row_per_page_option
                            "
                            v-model="paginate"
                            @change="list()"
                          >
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
                              disabled: !reports.prev_page_url,
                            }"
                            @click="
                              reports.prev_page_url &&
                                list(reports.prev_page_url)
                            "
                            style="margin-right: 0px"
                          >
                            <span
                              aria-hidden="true"
                              class="chevron left"
                            ></span>
                            <span class="paginate_text">Prev</span>
                          </button>
                          <div
                            class="footer__navigation__page-info"
                            style="color: #99a0b2"
                          >
                            <label
                              class="page-info__label"
                              style="margin-bottom: -5px"
                            >
                              <span class="paginate_text">page</span>
                              <input
                                type="text"
                                class="
                                  footer__navigation__page-info__current-entry
                                  vgt-input
                                "
                                v-model="current_page"
                                @keypress="directPage"
                                style="width: 60px"
                              />
                              <span class="paginate_text">
                                of
                                {{ reports.last_page }}
                              </span>
                            </label>
                          </div>
                          <button
                            type="button"
                            class="footer__navigation__page-btn"
                            :class="{
                              disabled: !reports.next_page_url,
                            }"
                            @click="
                              reports.next_page_url &&
                                list(reports.next_page_url)
                            "
                          >
                            <span style="font-weight: 500">Next</span>
                            <span
                              aria-hidden="true"
                              class="chevron right"
                            ></span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- END: Tampil Data -->
              </div>
              <!-- END: Card Body -->
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
moment.locale("id");

export default {
  data() {
    return {
      reports: {
        data: [],
      },
      search: null,
      search_kode_barang: null,
      search_nama_barang: null,
      search_kode_satuan: null,
      search_saldo_awal: null,
      search_saldo_akhir: null,
      search_saldo_penyesuaian: null,
      search_bc16: null,
      search_bc27_in: null,
      search_bc27_out: null,
      search_bc40: null,
      search_bc41: null,
      search_bc28: null,
      search_bc30: null,

      // Order Data
      order: "TANGGAL_SALDO_1",
      by: "desc",
      current_page: "",
      paginate: "10",

      // Filter Data
      filter_start_date: null,
      filter_end_date: null,
    };
  },

  methods: {
    checkDataString(data1, data2, data3) {
      if (data1) {
        return data1;
      } else {
        if (data2) {
          return data2;
        } else {
          if (data3) {
            return data3;
          }
        }
      }
    },
    checkDataNumber(data1, data2, data3) {
      if ((data1 = !null)) {
        return data1;
      } else {
        if ((data2 = !null)) {
          return data2;
        } else {
          if ((data3 = !null)) {
            return data3;
          }
        }
      }
    },
    filterButton() {
      this.list();
    },
    list(paginate) {
      this.$Progress.start();
      paginate = paginate || "/api/report-mutation";
      axios
        .get(paginate, {
          params: {
            search: this.search,
            search_kode_barang: this.search_kode_barang,
            search_nama_barang: this.search_nama_barang,
            search_kode_satuan: this.$search_kode_satuan,
            search_saldo_awal: this.$search_saldo_awal,
            search_saldo_akhir: this.$search_saldo_akhir,
            search_saldo_penyesuaian: this.$search_saldo_penyesuaian,
            search_bc16: this.$search_bc16,
            search_bc27_in: this.$search_bc27_in,
            search_bc27_out: this.$search_bc27_out,
            search_bc40: this.$search_bc40,
            search_bc41: this.$search_bc41,
            search_bc28: this.$search_bc28,
            search_bc30: this.$search_bc30,

            // Filter Date
            filter_start_date: this.filter_start_date,
            filter_end_date: this.filter_end_date,

            // Order, By, Paginate
            order: this.order,
            by: this.by,
            paginate: this.paginate,
          },
        })
        .then((response) => {
          this.reports = response.data;
          this.current_page = this.reports.current_page;
          this.$Progress.finish();
        })
        .catch((error) => {
          this.$Progress.fail();
          console.log(error);
        });
    },
    clearForm() {
      this.filter_start_date = null;
      this.filter_end_date = null;
      // Remove Search
      this.search = null;
      this.search_kode_barang = null;
      this.search_nama_barang = null;
      this.search_kode_satuan = null;
      this.search_saldo_awal = null;
      this.search_saldo_akhir = null;
      this.search_saldo_penyesuaian = null;
      this.search_bc16 = null;
      this.search_bc27_in = null;
      this.search_bc27_out = null;
      this.search_bc40 = null;
      this.search_bc41 = null;
      this.search_bc28 = null;
      this.search_bc30 = null;
    },

    directPage: debounce(function () {
      if (this.current_page < 1) {
        this.current_page = 1;
      } else if (this.current_page > this.paginate.last_page) {
        this.current_page = this.paginate.last_page;
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
