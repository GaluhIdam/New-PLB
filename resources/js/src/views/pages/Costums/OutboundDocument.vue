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
                <span>Dokumen Pengeluaran PLB</span>
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
                  Dokumen Pengeluaran PLB
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
                          >Tanggal Pengajuan</label
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
                          >Nomor Pengajuan</label
                        >
                        <div class="col-sm-8">
                          <input
                            type="text"
                            class="form-control"
                            v-model="filter_nomor_aju"
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
                              value="27"
                              v-model="filter_kode_dokumen_pabean"
                              disabled
                            />
                            27
                          </label>
                        </div>
                        <div class="col-sm-2">
                          <label class="control-label" style="margin-top: 5px">
                            <input
                              type="checkbox"
                              value="28"
                              v-model="filter_kode_dokumen_pabean"
                            />
                            28
                          </label>
                        </div>
                        <div class="col-sm-2">
                          <label class="control-label" style="margin-top: 5px">
                            <input
                              type="checkbox"
                              value="30"
                              v-model="filter_kode_dokumen_pabean"
                              disabled
                            />
                            30
                          </label>
                        </div>
                        <div class="col-sm-2">
                          <label class="control-label" style="margin-top: 5px">
                            <input
                              type="checkbox"
                              value="41"
                              v-model="filter_kode_dokumen_pabean"
                              disabled
                            />
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
                <hr v-if="filter_clicked" />

                <!-- BEGIN: Tampil Data -->
                <div class="form-group mt-4" v-if="filter_clicked">
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
                          <input
                            type="text"
                            placeholder="Search Data"
                            class="vgt-input vgt-pull-left"
                            v-model="search"
                          />
                        </div>
                        <!-- END: Global Search -->

                        <!-- BEGIN: Button Right -->
                        <div
                          class="vgt-global-search__actions vgt-pull-right"
                          v-if="$gate.isAdminOrPlanner()"
                        >
                          <div>
                            <button class="btn btn-secondary ms-auto rounded-1">
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
                            </button>
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
                          <!-- BEGIN: Thead -->
                          <thead>
                            <tr>
                              <!-- BEGIN: Jenis Dokumen -->
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
                                @click="sort('NOMOR_AJU', 'asc')"
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
                              <!-- END: Jenis Dokumen -->

                              <!-- BEGIN: Nomor AJU -->
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
                                @click="sort('NOMOR_AJU', 'asc')"
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
                              <!-- END: Nomor AJU -->

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
                                @click="sort('NOMOR_AJU', 'asc')"
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
                                @click="sort('NOMOR_AJU', 'asc')"
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
                                @click="sort('NOMOR_AJU', 'asc')"
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
                              <!-- BEGIN: Tanggal Pengeluaran -->
                              <th
                                v-if="
                                  order == 'tanggal_pengeluaran' && by == 'asc'
                                "
                                @click="sort('tanggal_pengeluaran', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header"
                                  >Tanggal Pengeluaran</span
                                >
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'tanggal_pengeluaran' && by == 'desc'
                                "
                                @click="sort('tanggal_pengeluaran', 'asc')"
                                class="
                                  text-center
                                  sortable
                                  sorting sorting-desc
                                "
                              >
                                <span class="table_header"
                                  >Tanggal Pengeluaran</span
                                >
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('tanggal_pengeluaran', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header"
                                  >Tanggal Pengeluaran</span
                                >
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Tanggal Pengeluaran -->
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
                                @click="sort('NOMOR_AJU', 'asc')"
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
                                @click="sort('NOMOR_AJU', 'asc')"
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
                                v-if="order == 'kode_hs' && by == 'asc'"
                                @click="sort('kode_hs', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Kode HS</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'kode_hs' && by == 'desc'"
                                @click="sort('NOMOR_AJU', 'asc')"
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
                                @click="sort('kode_hs', 'asc')"
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
                                v-if="order == 'nama_barang' && by == 'asc'"
                                @click="sort('nama_barang', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Nama Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'nama_barang' && by == 'desc'
                                "
                                @click="sort('NOMOR_AJU', 'asc')"
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
                                @click="sort('nama_barang', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Nama Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- END: Nama Barang -->
                              <!-- BEGIN: Jumlah -->
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
                                @click="sort('NOMOR_AJU', 'asc')"
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
                              <!-- END: Jumlah -->
                              <!-- BEGIN: Satuan -->
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
                                @click="sort('NOMOR_AJU', 'asc')"
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
                              <!-- END: Satuan -->
                              <!-- BEGIN: Nilai Barang -->
                              <th class="text-center">
                                <span class="table_header">Nilai Barang</span>
                              </th>
                              <!-- END: Nilai Barang -->
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
                              <!-- BEGIN: Jenis Dokumen -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Jenis Dokumen"
                                    v-model="search_kode_dokumen_pabean"
                                  />
                                </div>
                              </th>
                              <!-- END: Jenis Dokumen -->
                              <!-- BEGIN: Nomor AJU -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Nomor AJU"
                                    v-model="search_nomor_aju"
                                  />
                                </div>
                              </th>
                              <!-- END: Nomor AJU -->
                              <!-- BEGIN: Tanggal AJU -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="date"
                                    class="vgt-input text-center"
                                    placeholder="Tanggal AJU"
                                    v-model="search_tanggal_aju"
                                  />
                                </div>
                              </th>
                              <!-- END: Tanggal AJU -->
                              <!-- BEGIN: Nomor Daftar -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Nomor Daftar"
                                    v-model="search_nomor_daftar"
                                  />
                                </div>
                              </th>
                              <!-- END: Nomor Daftar -->
                              <!-- BEGIN: Tanggal Daftar -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="date"
                                    class="vgt-input text-center"
                                    placeholder="Tanggal Daftar"
                                    v-model="search_tanggal_daftar"
                                  />
                                </div>
                              </th>
                              <!-- END: Tanggal Daftar -->
                              <!-- BEGIN: Tanggal Pengeluaran -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="date"
                                    class="vgt-input text-center"
                                    placeholder="Tanggal Pengeluaran"
                                    v-model="search_tanggal_pengeluaran"
                                  />
                                </div>
                              </th>
                              <!-- END: Tanggal Pengeluaran -->
                              <!-- BEGIN: Nama Pemilik -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Nama Pemilik"
                                    v-model="search_nama_pemilik"
                                  />
                                </div>
                              </th>
                              <!-- END: Nama Pemilik -->
                              <!-- BEGIN: Kode Barang -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Kode Barang"
                                    v-model="search_kode_barang"
                                  />
                                </div>
                              </th>
                              <!-- END: Kode Barang -->
                              <!-- BEGIN: Kode HS -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Kode HS"
                                    v-model="search_kode_hs"
                                  />
                                </div>
                              </th>
                              <!-- END: Kode HS -->
                              <!-- BEGIN: Nama Barang -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Nama Barang"
                                    v-model="search_nama_barang"
                                  />
                                </div>
                              </th>
                              <!-- END: Nama Barang -->
                              <!-- BEGIN: Jumlah -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Jumlah"
                                    v-model="search_jumlah_satuan"
                                  />
                                </div>
                              </th>
                              <!-- END: Jumlah -->
                              <!-- BEGIN: Satuan -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Satuan"
                                    v-model="search_kode_satuan"
                                  />
                                </div>
                              </th>
                              <!-- END: Satuan -->
                              <!-- BEGIN: Nilai Barang -->
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input text-center"
                                    placeholder="Nilai Barang"
                                    v-model="search_cif_rupiah"
                                  />
                                </div>
                              </th>
                              <!-- END: Nilai Barang -->
                              <!-- BEGIN: Lampiran -->
                              <!-- <th
                                v-if="$gate.isAdminOrPlanner()"
                                class="filter-th"
                              ></th> -->
                              <!-- END: Lampiran -->
                            </tr>
                            <!-- END: Filter -->
                          </thead>
                          <!-- END: Thead -->
                          <!-- BEGIN: Tbody -->
                          <tbody>
                            <tr
                              v-for="(
                                outbound, outbound_index
                              ) in outbounds.data"
                              :key="outbound_index"
                            >
                              <td class="text-center table_content">
                                {{ outbound.KODE_DOKUMEN_PABEAN }}
                              </td>
                              <td class="text-left table_content">
                                {{ outbound.NOMOR_AJU }}
                              </td>
                              <td class="text-center table_content">
                                {{ outbound.TANGGAL_AJU | myDate }}
                              </td>
                              <td class="text-center table_content">
                                {{ outbound.NOMOR_DAFTAR }}
                              </td>
                              <td class="text-center table_content">
                                {{ outbound.TANGGAL_DAFTAR | myDate }}
                              </td>
                              <td
                                class="text-center table_content"
                                v-if="!outbound.WAKTU_GATE_OUT"
                              >
                                {{ outbound.TANGGAL_DAFTAR | myDate }}
                              </td>
                              <td class="text-center table_content" v-else>
                                {{ outbound.WAKTU_GATE_OUT | myDate }}
                              </td>
                              <!-- <td class="text-left table_content">
                                {{ outbound.NAMA_PEMILIK }}
                              </td> -->

                              <td
                                v-if="outbound.KODE_DOKUMEN_PABEAN === '28'"
                                class="text-center table_content"
                              >
                                {{ outbound.NAMA_PEMILIK }}
                              </td>
                              <td class="text-center table_content" v-else>
                                {{ outbound.NAMA_PENERIMA_BARANG }}
                              </td>

                              <td class="text-center table_content">
                                {{ outbound.KODE_BARANG }}
                              </td>
                              <td class="text-center table_content">
                                {{ outbound.POS_TARIF }}
                              </td>
                              <td class="text-left table_content">
                                {{ outbound.URAIAN }}
                              </td>
                              <td class="text-center table_content">
                                {{ outbound.JUMLAH_SATUAN }}
                              </td>
                              <td class="text-center table_content">
                                {{ outbound.KODE_SATUAN }}
                              </td>
                              <td
                                v-if="outbound.KODE_DOKUMEN_PABEAN === '28'"
                                class="text-center table_content"
                              >
                                {{ outbound.CIF_RUPIAH }}
                              </td>
                              <td
                                class="text-center table_content"
                                v-else-if="
                                  outbound.KODE_DOKUMEN_PABEAN === '41'
                                "
                              >
                                {{ outbound.HARGA_PENYERAHAN }}
                              </td>
                              <td
                                class="text-center table_content"
                                v-else-if="
                                  outbound.KODE_DOKUMEN_PABEAN === '27'
                                "
                              >
                                <span
                                  v-if="
                                    outbound.HARGA_PENYERAHAN == null ||
                                    outbound.HARGA_PENYERAHAN == 0
                                  "
                                >
                                  {{ outbound.CIF }}
                                </span>
                                <span v-else>
                                  {{ outbound.HARGA_PENYERAHAN }}
                                </span>
                              </td>
                              <!-- <td
                                v-if="$gate.isAdminOrPlanner()"
                                class="text-center table_content"
                              >
                                {{ outbound.attachment }}
                              </td> -->
                            </tr>
                            <tr v-if="outbounds.data.length < 1">
                              <td colspan="15">
                                <div class="vgt-center-align vgt-text-disabled">
                                  Data not found
                                </div>
                              </td>
                            </tr>
                          </tbody>
                          <!-- END: Tbody -->
                        </table>
                      </div>
                      <!-- END: Table Data -->
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
                              disabled: !outbounds.prev_page_url,
                            }"
                            @click="
                              outbounds.prev_page_url &&
                                list(outbounds.prev_page_url)
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
                                {{ outbounds.last_page }}
                              </span>
                            </label>
                          </div>
                          <button
                            type="button"
                            class="footer__navigation__page-btn"
                            :class="{
                              disabled: !outbounds.next_page_url,
                            }"
                            @click="
                              outbounds.next_page_url &&
                                list(outbounds.next_page_url)
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
      outbounds: {
        data: [],
        links: [],
      },
      // Search Data
      search: "",
      search_kode_dokumen_pabean: null,
      search_nomor_aju: null,
      search_tanggal_aju: null,
      search_nomor_daftar: null,
      search_tanggal_daftar: null,
      search_tanggal_pengeluaran: null,
      search_nama_pemilik: null,
      search_kode_barang: null,
      search_kode_hs: null,
      search_nama_barang: null,
      search_jumlah_satuan: null,
      search_kode_satuan: null,
      search_harga_penyerahan: null,
      search_cif: null,
      search_cif_rupiah: null,

      // Order Data
      order: "TANGGAL_DAFTAR",
      by: "asc",
      current_page: "",
      paginate: "10",

      // Filter Data
      filter_start_date: null,
      filter_end_date: null,
      filter_nomor_aju: null,
      filter_kode_dokumen_pabean: [],
      filter_clicked: false,
    };
  },
  created() {
    this.list();
    Fire.$on("RefreshTable", () => {
      this.list();
    });
  },
  watch: {
    search: debounce(function () {
      this.list();
    }, 500),
    search_kode_dokumen_pabean: debounce(function () {
      this.list();
    }, 500),
    search_nomor_aju: debounce(function () {
      this.list();
    }, 500),
    search_tanggal_aju: debounce(function () {
      this.list();
    }, 500),
    search_nomor_daftar: debounce(function () {
      this.list();
    }, 500),
    search_tanggal_daftar: debounce(function () {
      this.list();
    }, 500),
    search_tanggal_pengeluaran: debounce(function () {
      this.list();
    }, 500),
    search_nama_pemilik: debounce(function () {
      this.list();
    }, 500),
    search_kode_barang: debounce(function () {
      this.list();
    }, 500),
    search_kode_hs: debounce(function () {
      this.list();
    }, 500),
    search_nama_barang: debounce(function () {
      this.list();
    }, 500),
    search_jumlah_satuan: debounce(function () {
      this.list();
    }, 500),
    search_kode_satuan: debounce(function () {
      this.list();
    }, 500),
    search_harga_penyerahan: debounce(function () {
      this.list();
    }, 500),
    search_cif: debounce(function () {
      this.list();
    }, 500),
    search_cif_rupiah: debounce(function () {
      this.list();
    }, 500),
    filter_start_date: debounce(function () {
      this.list();
    }, 500),
    filter_end_date: debounce(function () {
      this.list();
    }, 500),
    filter_nomor_aju: debounce(function () {
      this.list();
    }, 500),
    filter_kode_dokumen_pabean: debounce(function () {
      this.list();
    }, 500),
  },
  methods: {
    filterButton() {
      this.filter_clicked = true;
      this.list();
    },
    clearForm() {
      this.filter_start_date = null;
      this.filter_end_date = null;
      this.filter_nomor_aju = null;
      this.filter_kode_dokumen_pabean = [];
      this.list();
      this.filter_clicked = false;
    },
    list(paginate) {
      this.$Progress.start();
      paginate = paginate || `/api/customs/outbound`;
      axios
        .get(paginate, {
          params: {
            search: this.search,
            search_kode_dokumen_pabean: this.search_kode_dokumen_pabean,
            search_nomor_aju: this.search_nomor_aju,
            search_tanggal_aju: this.search_tanggal_aju,
            search_nomor_daftar: this.search_nomor_daftar,
            search_tanggal_daftar: this.search_tanggal_daftar,
            search_tanggal_pengeluaran: this.search_tanggal_pengeluaran,
            search_nama_pemilik: this.search_nama_pemilik,
            search_kode_barang: this.search_kode_barang,
            search_kode_hs: this.search_kode_hs,
            search_nama_barang: this.search_nama_barang,
            search_jumlah_satuan: this.search_jumlah_satuan,
            search_kode_satuan: this.search_kode_satuan,
            search_harga_penyerahan: this.search_harga_penyerahan,
            search_cif: this.search_cif,
            search_cif_rupiah: this.search_cif_rupiah,

            // Filter Data
            filter_start_date: this.filter_start_date,
            filter_end_date: this.filter_end_date,
            filter_nomor_aju: this.filter_nomor_aju,
            filter_kode_dokumen_pabean: this.filter_kode_dokumen_pabean,

            // Order
            order: this.order,
            by: this.by,
            paginate: this.paginate,
          },
        })
        .then((response) => {
          this.outbounds = response.data;
          this.current_page = this.outbounds.current_page;
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
