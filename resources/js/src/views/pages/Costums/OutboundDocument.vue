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
                  <div class="col-md-6">
                    <form @submit.prevent class="form-horizontal">
                      <div class="form-group row mt-4">
                        <label class="col-sm-4 col-form-label"
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
                        <label class="col-sm-4 col-form-label"
                          >Nomor Pengajuan</label
                        >
                        <div class="col-sm-8">
                          <input
                            type="text"
                            class="form-control"
                            v-model="filter_no_aju"
                          />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label"
                          >Jenis Dokumen</label
                        >
                        <div class="col-sm-2">
                          <label class="control-label" style="margin-top: 5px">
                            <input
                              type="checkbox"
                              value="27"
                              v-model="filter_document_type"
                            />
                            27
                          </label>
                        </div>
                        <div class="col-sm-2">
                          <label class="control-label" style="margin-top: 5px">
                            <input
                              type="checkbox"
                              value="28"
                              v-model="filter_document_type"
                            />
                            28
                          </label>
                        </div>
                        <div class="col-sm-2">
                          <label class="control-label" style="margin-top: 5px">
                            <input
                              type="checkbox"
                              value="30"
                              v-model="filter_document_type"
                            />
                            30
                          </label>
                        </div>
                        <div class="col-sm-2">
                          <label class="control-label" style="margin-top: 5px">
                            <input
                              type="checkbox"
                              value="41"
                              v-model="filter_document_type"
                            />
                            41
                          </label>
                        </div>
                      </div>
                      <div class="form-group row justify-content-center">
                        <div class="col-sm-4">
                          <button
                            class="btn btn-primary"
                            @click="filterTranscation"
                          >
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
                <div class="form-group mt-4" v-if="filter_clicked">
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
                          <input
                            type="text"
                            placeholder="Search Data"
                            class="vgt-input vgt-pull-left"
                            v-model="search"
                          />
                        </div>
                        <div class="vgt-global-search__actions vgt-pull-right">
                          <div>
                            <button class="btn btn-secondary ms-auto rounded-1">
                              <i class="fa-solid fa-file-csv"></i>
                              CSV
                            </button>
                            <button class="btn btn-secondary ms-auto rounded-1">
                              <i class="fa-solid fa-file-excel"></i>
                              Excel
                            </button>
                            <button class="btn btn-secondary ms-auto rounded-1">
                              <i class="fa-solid fa-file-pdf"></i>
                              PDF
                            </button>
                          </div>
                        </div>
                      </div>
                      <div class="vgt-responsive">
                        <table
                          id="vgt-table"
                          class="vgt-table bordered polar-bear"
                        >
                          <thead>
                            <tr>
                              <!-- Jenis Dokumen -->
                              <th
                                v-if="order == 'document_type' && by == 'asc'"
                                @click="sort('document_type', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Jenis Dokumen</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'document_type' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Jenis Dokumen</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('document_type', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Jenis Dokumen</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- No. AJU -->
                              <th
                                v-if="order == 'no_aju' && by == 'asc'"
                                @click="sort('no_aju', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">No.AJU</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'no_aju' && by == 'desc'"
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">No.AJU</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('no_aju', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">No.AJU</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- Tanggal AJU -->
                              <th
                                v-if="order == 'date_aju' && by == 'asc'"
                                @click="sort('date_aju', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Tanggal AJU</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'date_aju' && by == 'desc'"
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Tanggal AJU</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('date_aju', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Tanggal AJU</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- Nomor Daftar -->
                              <th
                                v-if="order == 'no_register' && by == 'asc'"
                                @click="sort('no_register', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Nomor Daftar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'no_register' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Nomor Daftar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('no_register', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Nomor Daftar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- Tanggal Daftar -->
                              <th
                                v-if="order == 'date_register' && by == 'asc'"
                                @click="sort('date_register', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Tanggal Daftar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'date_register' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Tanggal Daftar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('date_register', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Tanggal Daftar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- Tanggal Pengeluaran-->
                              <th
                                v-if="order == 'date_outbound' && by == 'asc'"
                                @click="sort('date_outbound', 'desc')"
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
                                  order == 'date_outbound' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
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
                                @click="sort('date_outbound', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header"
                                  >Tanggal Pengeluaran</span
                                >
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>

                              <!-- Nama Pemilik -->
                              <th
                                v-if="order == 'owner' && by == 'asc'"
                                @click="sort('owner', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Nama Pemilik</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'owner' && by == 'desc'"
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Nama Pemilik</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('owner', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Nama Pemilik</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- Kode Barang -->
                              <th
                                v-if="order == 'item_code' && by == 'asc'"
                                @click="sort('item_code', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Kode Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'item_code' && by == 'desc'"
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Kode Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('item_code', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Kode Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- Kode HS -->
                              <th
                                v-if="order == 'hs_code' && by == 'asc'"
                                @click="sort('hs_code', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Kode HS</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'hs_code' && by == 'desc'"
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Kode HS</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('hs_code', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Kode HS</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- Nama Barang -->
                              <th
                                v-if="order == 'item_name' && by == 'asc'"
                                @click="sort('item_name', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Nama Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'item_name' && by == 'desc'"
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Nama Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('item_name', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Nama Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- Jumlah -->
                              <th
                                v-if="order == 'quantity' && by == 'asc'"
                                @click="sort('quantity', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Jumlah</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'quantity' && by == 'desc'"
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Jumlah</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('quantity', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Jumlah</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- Satuan -->
                              <th
                                v-if="order == 'unit' && by == 'asc'"
                                @click="sort('unit', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="order == 'unit' && by == 'desc'"
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('unit', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- Nilai Barang -->
                              <th
                                v-if="order == 'item_value' && by == 'asc'"
                                @click="sort('item_value', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Nilai Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'item_value' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Nilai Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('item_value', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Nilai Barang</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- Lampiran -->
                              <th
                                v-if="order == 'attachment' && by == 'asc'"
                                @click="sort('attachment', 'desc')"
                                class="text-center sortable sorting sorting-asc"
                              >
                                <span class="table_header">Lampiran</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else-if="
                                  order == 'attachment' && by == 'desc'
                                "
                                @click="sort('id', 'asc')"
                                class="text-center sortable sorting sorting-desc"
                              >
                                <span class="table_header">Lampiran</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th
                                v-else
                                @click="sort('attachment', 'asc')"
                                class="text-center sortable"
                              >
                                <span class="table_header">Lampiran</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                            </tr>
                            <tr>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input"
                                    placeholder="Filter Jenis Dokumen"
                                    v-model="search_document_type"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input"
                                    placeholder="Filter No. AJU"
                                    v-model="search_no_aju"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="date"
                                    class="vgt-input"
                                    placeholder="Filter Tanggal AJU"
                                    v-model="search_date_aju"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input"
                                    placeholder="Filter No. Daftar"
                                    v-model="search_no_register"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="date"
                                    class="vgt-input"
                                    placeholder="Filter Tanggal Daftar"
                                    v-model="search_date_register"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="date"
                                    class="vgt-input"
                                    placeholder="Filter Tanggal Pengeluaran"
                                    v-model="search_date_outbound"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input"
                                    placeholder="Filter Nama Pemilik"
                                    v-model="search_owner"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input"
                                    placeholder="Filter Kode Barang"
                                    v-model="search_item_code"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input"
                                    placeholder="Filter Kode HS"
                                    v-model="search_hs_code"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input"
                                    placeholder="Filter Nama Barang"
                                    v-model="search_item_name"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input"
                                    placeholder="Filter Jumlah"
                                    v-model="search_quantity"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input"
                                    placeholder="Filter Satuan"
                                    v-model="search_unit"
                                  />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input
                                    type="text"
                                    class="vgt-input"
                                    placeholder="Filter Nilai Barang"
                                    v-model="search_item_value"
                                  />
                                </div>
                              </th>
                              <th class="filter-th"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              v-for="(
                                outbound, outbound_index
                              ) in outbounds.data"
                              :key="outbound_index"
                            >
                              <td class="table_content">
                                {{ outbound.document_type }}
                              </td>
                              <td class="table_content">
                                {{ outbound.no_aju }}
                              </td>
                              <td class="table_content">
                                {{ outbound.date_aju }}
                              </td>
                              <td class="table_content">
                                {{ outbound.no_register }}
                              </td>
                              <td class="text-center table_content">
                                {{ outbound.date_register | formatDate }}
                              </td>
                              <td class="text-center table_content">
                                {{ outbound.date_outbound | formatDate }}
                              </td>

                              <td class="table_content">
                                {{ outbound.owner }}
                              </td>
                              <td class="table_content">
                                {{ outbound.item_code }}
                              </td>
                              <td class="table_content">
                                {{ outbound.hs_code }}
                              </td>
                              <td class="table_content">
                                {{ outbound.item_name }}
                              </td>
                              <td class="table_content">
                                {{ outbound.quantity }}
                              </td>
                              <td class="table_content">{{ outbound.unit }}</td>
                              <td class="table_content">
                                {{ outbound.item_value }}
                              </td>
                              <td class="table_content">
                                {{ outbound.attachment }}
                              </td>
                            </tr>
                            <tr v-if="outbounds.data.length < 1">
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
                            class="footer__row-count__select row_per_page_option"
                            v-model="paginate"
                            @change="list()"
                          >
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="100">150</option>
                            <option value="100">200</option>
                            <option value="100">250</option>
                            <option value="100">300</option>
                            <option value="100">350</option>
                            <option value="100">400</option>
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
                                class="footer__navigation__page-info__current-entry vgt-input"
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
      outbounds: {
        data: [],
        links: [],
      },
      search: null,
      search_document_type: null,
      search_no_aju: null,
      search_date_aju: null,
      search_no_register: null,
      search_date_register: null,
      search_date_outbound: null,
      search_owner: null,
      search_item_code: null,
      search_hs_code: null,
      search_item_name: null,
      search_quantity: null,
      search_unit: null,
      search_item_value: null,
      filter_start_date: null,
      filter_end_date: null,
      filter_no_aju: null,
      filter_document_type: [],

      order: "id",
      by: "desc",
      paginate: "10",
      current_page: null,
      filter_clicked: false,
    };
  },
  created() {
    this.list();
  },
  watch: {
    search: debounce(function () {
      this.list();
    }, 500),
    search_document_type: debounce(function () {
      this.list();
    }, 500),
    search_no_aju: debounce(function () {
      this.list();
    }, 500),
    search_date_aju: debounce(function () {
      this.list();
    }, 0),
    search_no_register: debounce(function () {
      this.list();
    }, 500),
    search_date_register: debounce(function () {
      this.list();
    }, 0),
    search_date_outbound: debounce(function () {
      this.list();
    }, 0),
    search_owner: debounce(function () {
      this.list();
    }, 500),
    search_item_code: debounce(function () {
      this.list();
    }, 500),
    search_hs_code: debounce(function () {
      this.list();
    }, 500),
    search_item_name: debounce(function () {
      this.list();
    }, 500),
    search_quantity: debounce(function () {
      this.list();
    }, 500),
    search_unit: debounce(function () {
      this.list();
    }, 500),
    search_item_value: debounce(function () {
      this.list();
    }, 500),
  },
  methods: {
    list(paginate) {
      this.showLoading();
      paginate = paginate || `/api/customs/outbound-document`;
      axios
        .get(paginate, {
          params: {
            filter_start_date: this.filter_start_date,
            filter_end_date: this.filter_end_date,
            filter_no_aju: this.filter_no_aju,
            filter_document_type: this.filter_document_type,
            search: this.search,
            search_document_type: this.search_document_type,
            search_no_aju: this.search_no_aju,
            search_date_aju: this.search_date_aju,
            search_no_register: this.search_no_register,
            search_date_register: this.search_date_register,
            search_date_outbound: this.search_date_outbound,

            search_owner: this.search_owner,
            search_item_code: this.search_item_code,
            search_hs_code: this.search_hs_code,
            search_item_name: this.search_item_name,
            search_quantity: this.search_quantity,
            search_unit: this.search_unit,
            search_item_value: this.search_item_value,
            start_date: this.start_date,
            end_date: this.end_date,
            order: this.order,
            by: this.by,
            paginate: this.paginate,
          },
        })
        .then((response) => {
          this.outbounds = response.data;
          this.current_page = this.outbounds.current_page;
          Swal.close();
        })
        .catch((error) => console.log(error));
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
    showLoading() {
      Swal.fire({
        didOpen: () => {
          Swal.showLoading();
        },
        background: "transparent",
        allowOutsideClick: false,
      });
    },
    filterTranscation() {
      this.filter_clicked = true;
      this.list();
    },
    clearForm() {
      this.filter_start_date = null;
      this.filter_end_date = null;
      this.filter_no_aju = null;
      this.filter_document_type = [];
      this.list();
      this.filter_clicked = false;
    },
  },
};
</script>
