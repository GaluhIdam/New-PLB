<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0">Dokumen Kepabeanan</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link to="/dashboard">Dashboard</router-link>
              </li>
              <li class="breadcrumb-item active">
                <span>Dokumen Pemasukan PLB</span>
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
                  <i class="nav-icon fa-solid fa-file-lines"></i>
                  Dokumen Pemasukan PLB
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
              <!-- BEGIN: Card Body -->
              <div class="card-body">
                <!-- BEGIN: Cari Data -->
                <div class="row justify-content-center">
                  <div class="col-md-8">
                    <form @submit.prevent class="form-horizontal">
                      <div class="form-group row mt-4">
                        <label class="col-sm-3 col-form-label"
                          >Tanggal Daftar</label
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
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"
                          >Jenis Dokumen</label
                        >
                        <div class="col-sm-2">
                          <label class="control-label" style="margin-top: 5px">
                            <input
                              type="checkbox"
                              id="16"
                              value="16"
                              v-model="filter_kode_dokumen_pabean"
                            />
                            16
                          </label>
                        </div>
                        <div class="col-sm-2">
                          <label class="control-label" style="margin-top: 5px">
                            <input
                              type="checkbox"
                              id="27IN"
                              value="27IN"
                              v-model="filter_kode_dokumen_pabean"
                            />
                            27IN
                          </label>
                        </div>
                        <div class="col-sm-2">
                          <label class="control-label" style="margin-top: 5px">
                            <input
                              type="checkbox"
                              id="40"
                              value="40"
                              v-model="filter_kode_dokumen_pabean"
                            />
                            40
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
                <div class="form-group mt-4">
                  <div class="vgt-wrap polar-bear">
                    <div class="vgt-inner-wrap">
                      <div class="vgt-global-search vgt-clearfix">
                        <!-- BEGIN: Global Search -->
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
                        <!-- END: Global Search -->
                        <!-- BEGIN: Button Right -->
                        <div
                          class="vgt-global-search__actions vgt-pull-right"
                          v-if="$gate.isAdminOrPlanner()"
                        >
                          <div>
                            <button
                              class="btn btn-secondary ms-auto rounded-1"
                              @click="exportCsv"
                            >
                              <i class="fa-solid fa-file-csv"></i>
                              CSV
                            </button>
                            <button
                              class="btn btn-secondary ms-auto rounded-1"
                              style="margin-right: 10px"
                              @click="exportExcel"
                            >
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

                        <div
                          class="vgt-global-search__actions vgt-pull-right"
                          v-else
                          style="margin-right: 5px"
                        ></div>
                        <!-- END: Button Right -->
                      </div>
                      <!-- BEGIN: Table Data -->
                      <div class="vgt-responsive">
                        <table
                          id="vgt-table"
                          class="vgt-table bordered polar-bear"
                        >
                          <thead>
                            <tr>
                              <!-- Jenis Dokumen -->
                              <th
                                v-if="
                                  order == 'kode_dokumen_pabean' && by == 'asc'
                                "
                                @click="sort('kode_dokumen_pabean', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Jenis Dokumen</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'kode_dokumen_pabean' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">Jenis Dokumen</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('kode_dokumen_pabean', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Jenis Dokumen</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- BEGIN : Nomor AJU -->
                              <th
                                v-if="order == 'nomor_aju' && by == 'asc'"
                                @click="sort('nomor_aju', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Nomor AJU</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'nomor_aju' && by == 'desc'"
                                @click="sort('id', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">Nomor AJU</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('nomor_aju', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Nomor AJU</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END : Nomor AJU -->
                              <!-- BEGIN: Tanggal AJU -->
                              <th
                                v-if="order == 'tanggal_aju' && by == 'asc'"
                                @click="sort('tanggal_aju', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Tanggal AJU</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'tanggal_aju' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">Tanggal AJU</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('tanggal_aju', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Tanggal AJU</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Tanggal AJU -->
                              <!-- BEGIN: Nomor Daftar -->
                              <th
                                v-if="order == 'nomor_daftar' && by == 'asc'"
                                @click="sort('nomor_daftar', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Nomor Daftar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'nomor_daftar' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">Nomor Daftar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('nomor_daftar', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Nomor Daftar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Nomor Daftar -->
                              <!-- BEGIN: Tanggal Daftar -->
                              <th
                                v-if="order == 'tanggal_daftar' && by == 'asc'"
                                @click="sort('tanggal_daftar', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Tanggal Daftar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'tanggal_daftar' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">Tanggal Daftar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('tanggal_daftar', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Tanggal Daftar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Tanggal Daftar -->

                              <!-- BEGIN: Tanggal Pemasukan -->
                              <th
                                v-if="
                                  order == 'tanggal_daftar ' &&
                                  by == 'asc' &&
                                  $gate.isAdminOrPlanner()
                                "
                                @click="sort('tanggal_daftar ', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header"
                                  >Tanggal Pemasukan</span
                                >
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'tanggal_daftar ' &&
                                  by == 'desc' &&
                                  $gate.isAdminOrPlanner()
                                "
                                @click="sort('id', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header"
                                  >Tanggal Pemasukan</span
                                >
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="$gate.isAdminOrPlanner()"
                                @click="sort('tanggal_daftar ', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header"
                                  >Tanggal Pemasukan</span
                                >
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Tanggal Pemasukan -->

                              <!-- BEGIN: Nama Pengirim -->
                              <th
                                v-if="order == 'nama_pengirim' && by == 'asc'"
                                @click="sort('nama_pengirim', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Nama Pengirim</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'nama_pengirim' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">Nama Pengirim</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('nama_pengirim', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Nama Pengirim</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Nama Pengirim -->
                              <!-- BEGIN: Nama Pemilik -->
                              <th
                                v-if="order == 'nama_pemilik' && by == 'asc'"
                                @click="sort('nama_pemilik', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Nama Pemilik</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'nama_pemilik' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">Nama Pemilik</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('nama_pemilik', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Nama Pemilik</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Nama Pemilik -->

                              <!-- BEGIN: Kode Barang -->
                              <th
                                v-if="order == 'kode_barang' && by == 'asc'"
                                @click="sort('kode_barang', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Kode Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'kode_barang' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
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
                                v-else
                                @click="sort('kode_barang', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Kode Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Kode Barang -->
                              <!-- BEGIN: Kode HS -->
                              <th
                                v-if="order == 'pos_tarif' && by == 'asc'"
                                @click="sort('pos_tarif', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Kode HS</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'pos_tarif' && by == 'desc'"
                                @click="sort('id', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">Kode HS</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('pos_tarif', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Kode HS</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Kode HS -->

                              <!-- BEGIN: Nama Barang -->
                              <th
                                v-if="order == 'uraian' && by == 'asc'"
                                @click="sort('uraian', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Nama Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'uraian' && by == 'desc'"
                                @click="sort('id', 'asc')"
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
                                v-else
                                @click="sort('uraian', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Nama Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- BEGIN: Jumlah Satuan -->
                              <th
                                v-if="order == 'jumlah_satuan' && by == 'asc'"
                                @click="sort('jumlah_satuan', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Jumlah</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'jumlah_satuan' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header">Jumlah</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('jumlah_satuan', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Jumlah</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Jumlah Satuan -->
                              <!-- BEGIN: Kode Satuan -->
                              <th
                                v-if="order == 'kode_satuan' && by == 'asc'"
                                @click="sort('kode_satuan', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'kode_satuan' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
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
                                v-else
                                @click="sort('kode_satuan', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Kode Satuan -->

                              <!-- BEGIN: Harga Penyerahan -->
                              <th class="text-center">
                                <span class="table_header">Nilai Barang</span>
                              </th>
                              <!-- END: Harga Penyerahan -->
                              <!-- BEGIN: Kode Valuta -->
                              <th class="text-center">
                                <span class="table_header">Kode Valuta</span>
                              </th>
                              <!-- END: Kode Valuta -->

                              <!-- BEGIN: Lampiran -->
                              <!-- <th
                                class="text-center"
                                v-if="$gate.isAdminOrPlanner()"
                              >
                                <span class="table_header">Lampiran</span>
                              </th> -->
                              <!-- END: Lampiran -->
                            </tr>

                            <!-- BEGIN: Filter -->
                            <tr>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Jenis Dokumen"
                                    v-model="search_kode_dokumen_pabean"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="No. AJU"
                                    v-model="search_nomor_aju"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="date"
                                    class="vgt-input text-center"
                                    placeholder="Tanggal AJU"
                                    v-model="search_tanggal_aju"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="No. Daftar"
                                    v-model="search_nomor_daftar"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="date"
                                    class="vgt-input text-center"
                                    placeholder="Tanggal Daftar"
                                    v-model="search_tanggal_daftar"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <th
                                class="filter-th"
                                v-if="$gate.isAdminOrPlanner()"
                              >
                                <div>
                                  <input
                                    type="date"
                                    class="vgt-input text-center"
                                    placeholder="Tanggal Pemasukan"
                                    v-model="search_tanggal_pemasukan"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Nama Pengirim"
                                    v-model="search_nama_pengirim"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Nama Pemilik"
                                    v-model="search_nama_pemilik"
                                    @change="list()"
                                  />
                                </div>
                              </th>
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
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Kode HS"
                                    v-model="search_pos_tarif"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Nama Barang"
                                    v-model="search_uraian"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Jumlah"
                                    v-model="search_jumlah_satuan"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Satuan"
                                    v-model="search_kode_satuan"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Nilai Barang"
                                    v-model="search_nilai_barang"
                                    @change="list()"
                                  />
                                </div>
                              </th>
                              <th class="filter-th"></th>
                              <!-- <th
                                v-if="$gate.isAdminOrPlanner()"
                                class="filter-th"
                              ></th> -->
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              v-for="(inbound, inbound_index) in inbounds.data"
                              :key="inbound_index"
                            >
                              <td class="text-center table_content">
                                {{ inbound.KODE_DOKUMEN_PABEAN }}
                              </td>
                              <td class="text-left table_content">
                                {{ inbound.NOMOR_AJU }}
                              </td>
                              <td class="text-center table_content">
                                {{ inbound.TANGGAL_AJU | myDate }}
                              </td>
                              <td class="text-center table_content">
                                {{ inbound.NOMOR_DAFTAR }}
                              </td>
                              <td class="text-center table_content">
                                {{ inbound.TANGGAL_DAFTAR | myDate }}
                              </td>
                              <td
                                class="text-center table_content"
                                v-if="
                                  ($gate.isAdminOrPlanner() &&
                                    !inbound.WAKTU_GATE_IN) ||
                                  inbound.WAKTU_GATE_IN == '0000-00-00 00:00:00'
                                "
                              >
                                {{ inbound.TANGGAL_DAFTAR | myDate }}
                              </td>
                              <td
                                class="text-center table_content"
                                v-else-if="$gate.isAdminOrPlanner()"
                              >
                                {{ inbound.WAKTU_GATE_IN | myDate }}
                              </td>
                              <td
                                v-if="inbound.NAMA_PENGIRIM === null"
                                class="text-center table_content"
                              >
                                -
                              </td>
                              <td class="text-center table_content" v-else>
                                {{ inbound.NAMA_PENGIRIM }}
                              </td>
                              <td
                                v-if="inbound.NAMA_PEMILIK === null"
                                class="text-center table_content"
                              >
                                -
                              </td>
                              <td class="text-center table_content" v-else>
                                {{ inbound.NAMA_PEMILIK }}
                              </td>
                              <td
                                v-if="inbound.KODE_BARANG === null"
                                class="text-center table_content"
                              >
                                -
                              </td>
                              <td class="text-center table_content" v-else>
                                {{ inbound.KODE_BARANG }}
                              </td>
                              <td
                                v-if="
                                  inbound.POS_TARIF === null ||
                                  inbound.POS_TARIF === ''
                                "
                                class="text-center table_content"
                              >
                                -
                              </td>
                              <td class="text-center table_content" v-else>
                                {{ inbound.POS_TARIF }}
                              </td>
                              <td
                                v-if="inbound.URAIAN === null"
                                class="text-center table_content"
                              >
                                -
                              </td>
                              <td class="text-center table_content" v-else>
                                {{ inbound.URAIAN }}
                              </td>
                              <td
                                v-if="inbound.JUMLAH_SATUAN === null"
                                class="text-center table_content"
                              >
                                -
                              </td>
                              <td class="text-center table_content" v-else>
                                {{ inbound.JUMLAH_SATUAN | formatNumber }}
                              </td>
                              <td
                                v-if="inbound.KODE_SATUAN === null"
                                class="text-center table_content"
                              >
                                -
                              </td>
                              <td class="text-center table_content" v-else>
                                {{ inbound.KODE_SATUAN }}
                              </td>
                              <td
                                v-if="inbound.KODE_DOKUMEN_PABEAN === '40'"
                                class="text-center table_content"
                              >
                                {{ inbound.HARGA_PENYERAHAN | formatNumber }}
                              </td>
                              <td class="text-center table_content" v-else>
                                {{ inbound.CIF | formatNumber }}
                              </td>
                              <td class="text-center table_content">
                                <span
                                  v-if="inbound.KODE_DOKUMEN_PABEAN === '40'"
                                >
                                  IDR
                                </span>
                                <span v-else>
                                  {{ inbound.KODE_VALUTA }}
                                </span>
                              </td>
                              <!-- <td
                                v-if="$gate.isAdminOrPlanner()"
                                class="text-center table_content"
                              >
                                <h4><i class="fa-solid fa-file-pdf"></i></h4>
                              </td> -->
                            </tr>
                            <tr v-if="inbounds.data.length < 1">
                              <td colspan="15">
                                <div class="vgt-center-align vgt-text-disabled">
                                  Data not found
                                </div>
                              </td>
                            </tr>
                          </tbody>
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
                              disabled: !inbounds.prev_page_url,
                            }"
                            @click="
                              inbounds.prev_page_url &&
                                list(inbounds.prev_page_url)
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
                                {{ inbounds.last_page }}
                              </span>
                            </label>
                          </div>
                          <button
                            type="button"
                            class="footer__navigation__page-btn"
                            :class="{
                              disabled: !inbounds.next_page_url,
                            }"
                            @click="
                              inbounds.next_page_url &&
                                list(inbounds.next_page_url)
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

export default {
  data() {
    return {
      inbounds: {
        data: [],
        links: [],
      },
      // Search Data
      search: "",
      search: null,
      search_kode_dokumen_pabean: null,
      search_nomor_aju: null,
      search_tanggal_aju: null,
      search_nomor_daftar: null,
      search_tanggal_daftar: null,
      search_tanggal_pemasukan: null,
      search_nama_pengirim: null,
      search_nama_pemilik: null,
      search_kode_barang: null,
      search_pos_tarif: null,
      search_uraian: null,
      search_jumlah_satuan: null,
      search_kode_satuan: null,
      search_nilai_barang: null,
      search_kode_valuta: null,

      // Order And Paginate
      order: "TANGGAL_DAFTAR",
      by: "desc",
      current_page: "",
      paginate: "10",

      //Filter
      filter_start_date: null,
      filter_end_date: null,
      filter_clicked: false,
      filter_kode_dokumen_pabean: [],
    };
  },
  methods: {
    list(paginate) {
      this.$Progress.start();
      paginate = paginate || `/api/customs/inbound`;
      axios
        .get(paginate, {
          params: {
            search: this.search,
            search_kode_dokumen_pabean: this.search_kode_dokumen_pabean,
            search_nomor_aju: this.search_nomor_aju,
            search_tanggal_aju: this.search_tanggal_aju,
            search_nomor_daftar: this.search_nomor_daftar,
            search_tanggal_daftar: this.search_tanggal_daftar,
            search_tanggal_pemasukan: this.search_tanggal_pemasukan,
            search_nama_pengirim: this.search_nama_pengirim,
            search_nama_pemilik: this.search_nama_pemilik,
            search_kode_barang: this.search_kode_barang,
            search_pos_tarif: this.search_pos_tarif,
            search_uraian: this.search_uraian,
            search_jumlah_satuan: this.search_jumlah_satuan,
            search_kode_satuan: this.search_kode_satuan,
            search_nilai_barang: this.search_nilai_barang,
            search_kode_valuta: this.search_kode_valuta,

            // Filter
            filter_start_date: this.filter_start_date,
            filter_end_date: this.filter_end_date,
            filter_kode_dokumen_pabean: this.filter_kode_dokumen_pabean,

            // Order, by, Current Page, Paginate
            order: this.order,
            by: this.by,
            paginate: this.paginate,
          },
        })
        .then((response) => {
          this.inbounds = response.data;
          this.current_page = this.inbounds.current_page;
          this.$Progress.finish();
        })
        .catch((error) => {
          this.$Progress.fail();
          console.log(error);
        });
    },
    exportExcel() {
      this.$Progress.start();
      axios
        .get("/api/customs/inbound-excel", {
          params: {
            search: this.search,
            search_kode_dokumen_pabean: this.search_kode_dokumen_pabean,
            search_nomor_aju: this.search_nomor_aju,
            search_tanggal_aju: this.search_tanggal_aju,
            search_nomor_daftar: this.search_nomor_daftar,
            search_tanggal_daftar: this.search_tanggal_daftar,
            search_tanggal_pemasukan: this.search_tanggal_pemasukan,
            search_nama_pengirim: this.search_nama_pengirim,
            search_nama_pemilik: this.search_nama_pemilik,
            search_kode_barang: this.search_kode_barang,
            search_pos_tarif: this.search_pos_tarif,
            search_uraian: this.search_uraian,
            search_jumlah_satuan: this.search_jumlah_satuan,
            search_kode_satuan: this.search_kode_satuan,
            search_nilai_barang: this.search_nilai_barang,
            search_kode_valuta: this.search_kode_valuta,
            filter_start_date: this.filter_start_date,
            filter_end_date: this.filter_end_date,
            filter_kode_dokumen_pabean: this.filter_kode_dokumen_pabean,

            // Order, by, Current Page, Paginate
            order: this.order,
            by: this.by,
          },
          responseType: "blob", // important
        })
        .then((response) => {
          const url = window.URL.createObjectURL(new Blob([response.data]));
          const link = document.createElement("a");
          link.href = url;
          link.setAttribute("download", "kepabeanan-inbound.xlsx");
          document.body.appendChild(link);
          link.click();
          this.$Progress.finish();
        })
        .catch((error) => {
          this.$Progress.fail();
          console.log(error);
        });
    },
    exportCsv() {
      this.$Progress.start();
      axios
        .get("/api/customs/inbound-csv", {
          params: {
            search: this.search,
            search_kode_dokumen_pabean: this.search_kode_dokumen_pabean,
            search_nomor_aju: this.search_nomor_aju,
            search_tanggal_aju: this.search_tanggal_aju,
            search_nomor_daftar: this.search_nomor_daftar,
            search_tanggal_daftar: this.search_tanggal_daftar,
            search_tanggal_pemasukan: this.search_tanggal_pemasukan,
            search_nama_pengirim: this.search_nama_pengirim,
            search_nama_pemilik: this.search_nama_pemilik,
            search_kode_barang: this.search_kode_barang,
            search_pos_tarif: this.search_pos_tarif,
            search_uraian: this.search_uraian,
            search_jumlah_satuan: this.search_jumlah_satuan,
            search_kode_satuan: this.search_kode_satuan,
            search_nilai_barang: this.search_nilai_barang,
            search_kode_valuta: this.search_kode_valuta,
            filter_start_date: this.filter_start_date,
            filter_end_date: this.filter_end_date,
            filter_kode_dokumen_pabean: this.filter_kode_dokumen_pabean,

            // Order, by, Current Page, Paginate
            order: this.order,
            by: this.by,
          },
          responseType: "blob", // important
        })
        .then((response) => {
          const url = window.URL.createObjectURL(new Blob([response.data]));
          const link = document.createElement("a");
          link.href = url;
          link.setAttribute("download", "kepabeanan-inbound.csv");
          document.body.appendChild(link);
          link.click();
          this.$Progress.finish();
        })
        .catch((error) => {
          this.$Progress.fail();
          console.log(error);
        });
    },
    filterButton() {
      this.filter_clicked = true;
      this.list();
    },
    clearForm() {
      this.inbounds = {
        data: [],
        links: [],
      };
      this.filter_start_date = null;
      this.filter_end_date = null;
      this.filter_kode_dokumen_pabean = [];
      //  Remove Search
      this.search = null;
      this.search_kode_dokumen_pabean = null;
      this.search_nomor_aju = null;
      this.search_tanggal_aju = null;
      this.search_nomor_daftar = null;
      this.search_tanggal_daftar = null;
      this.search_tanggal_pemasukan = null;
      this.search_nama_pengirim = null;
      this.search_nama_pemilik = null;
      this.search_kode_barang = null;
      this.search_pos_tarif = null;
      this.search_uraian = null;
      this.search_jumlah_satuan = null;
      this.search_kode_satuan = null;
      this.search_nilai_barang = null;
      this.search_kode_valuta = null;
      this.filter_clicked = false;
    },
    directPage: debounce(function () {
      if (this.current_page < 1) {
        this.current_page = 1;
      } else if (this.current_page > this.paginate.last_page) {
        this.current_page = this.paginate.last_page;
      }
      let url = new URL(this.inbounds.first_page_url);
      let search_params = new URLSearchParams(url.search);
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
