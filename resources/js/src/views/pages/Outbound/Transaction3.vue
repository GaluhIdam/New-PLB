<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0">Transaksi Outbound 3</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="/outbound-transcation">Transaksi Outbound </a></li>
              <li class="breadcrumb-item active"><span>Transaksi Outbound 3</span></li>
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
              <div class="card-header">Part ​Yang sudah menjadi Dokumen Clearance</div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Tanggal Outbound</label>
                      <div class="col-sm-4">
                        <input type="date" class="form-control" />
                      </div>
                      <div class="col-sm-4">
                        <input type="date" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Nomor AJU</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">Tanggal AJU</label>
                      <div class="col-sm-4">
                        <input type="date" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Nomor Daftar</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">Tanggal Daftar</label>
                      <div class="col-sm-4">
                        <input type="date" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Customer</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Plant</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Jenis Dokumen</label>
                      <div class="col-sm-2">
                        <label class="control-label" style="margin-top: 5px">
                          <input type="checkbox" name="jenis_dokumen[]" id="jenis_dokumen" checked="checked" value="27" />
                          27
                        </label>
                      </div>
                      <div class="col-sm-2">
                        <label class="control-label" style="margin-top: 5px">
                          <input type="checkbox" name="jenis_dokumen[]" id="jenis_dokumen" checked="checked" value="28" />
                          28
                        </label>
                      </div>
                      <div class="col-sm-2">
                        <label class="control-label" style="margin-top: 5px">
                          <input type="checkbox" name="jenis_dokumen[]" id="jenis_dokumen" checked="checked" value="30" />
                          30
                        </label>
                      </div>
                      <div class="col-sm-2">
                        <label class="control-label" style="margin-top: 5px">
                          <input type="checkbox" name="jenis_dokumen[]" id="jenis_dokumen" checked="checked" value="41" />
                          41
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-1"></div>
                </div>
                <div class="row">
                  <div class="col-md-3 col-sm-6"></div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label"></label>
                      <div class="col-sm-4">
                        <button class="btn btn-primary btn-md">Filter</button>
                        <button class="btn btn-secondary btn-md">Reset</button>
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
                          <input type="text" placeholder="Search Data" class="vgt-input vgt-pull-left" v-model="search" />
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
                        <table id="vgt-table" class="vgt-table bordered polar-bear">
                          <thead>
                            <tr>
                              <!-- Part Number -->
                              <th v-if="order == 'part_number' && by == 'asc'" @click="sort('part_number', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Part Number</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'part_number' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
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
                              <!-- Description -->
                              <th v-if="order == 'description' && by == 'asc'" @click="sort('description', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Description</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'description' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
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
                              <!-- Qty -->
                              <th v-if="order == 'quantity' && by == 'asc'" @click="sort('quantity', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Qty</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'quantity' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">Qty</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('quantity', 'asc')" class="text-center sortable">
                                <span class="table_header">Qty</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!--  Kode Satuan -->
                              <th v-if="order == 'unit_code' && by == 'asc'" @click="sort('unit_code', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Kode Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'unit_code' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">Kode Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('unit_code', 'asc')" class="text-center sortable">
                                <span class="table_header">Kode Satuan</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- Register A/C -->
                              <th v-if="order == 'register_ac' && by == 'asc'" @click="sort('register_ac', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Register A/C</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'register_ac' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">Register A/C</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('register_ac', 'asc')" class="text-center sortable">
                                <span class="table_header">Register A/C</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- Customer -->
                              <th v-if="order == 'customer' && by == 'asc'" @click="sort('customer', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Customer</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'customer' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
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
                              <!-- Date Install/Consume -->
                              <th v-if="order == 'date_install' && by == 'asc'" @click="sort('date_install', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Date Install/Consume</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'date_install' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">Date Install/Consume</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('date_install', 'asc')" class="text-center sortable">
                                <span class="table_header">Date Install/Consume</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- Date A/C In -->
                              <th v-if="order == 'date_ac_in' && by == 'asc'" @click="sort('date_ac_in', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Date A/C In</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'date_ac_in' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">Date A/C In</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('date_ac_in', 'asc')" class="text-center sortable">
                                <span class="table_header">Date A/C In</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- Date A/C Out -->
                              <th v-if="order == 'date_ac_out' && by == 'asc'" @click="sort('date_ac_out', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Date A/C Out</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'date_ac_out' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">Date A/C Out</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('date_ac_out', 'asc')" class="text-center sortable">
                                <span class="table_header">Date A/C Out</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- Type BC Out -->
                              <th v-if="order == 'type_bc_out' && by == 'asc'" @click="sort('type_bc_out', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">Type BC Out</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'type_bc_out' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">Type BC Out</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('type_bc_out', 'asc')" class="text-center sortable">
                                <span class="table_header">Type BC Out</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- No. AJU -->
                              <th v-if="order == 'no_aju' && by == 'asc'" @click="sort('no_aju', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">No. AJU</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'no_aju' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">No. AJU</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('no_aju', 'asc')" class="text-center sortable">
                                <span class="table_header">No. AJU</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- No. Daftar -->
                              <th v-if="order == 'no_register' && by == 'asc'" @click="sort('no_register', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">No. Daftar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'no_register' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">No. Daftar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('no_register', 'asc')" class="text-center sortable">
                                <span class="table_header">No. Daftar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- CIF IDR -->
                              <th v-if="order == 'cif_idr' && by == 'asc'" @click="sort('cif_idr', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">CIF IDR</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'cif_idr' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
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
                              <!-- BM Dibayar -->
                              <th v-if="order == 'bm_paid' && by == 'asc'" @click="sort('bm_paid', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">BM Dibayar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'bm_paid' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">BM Dibayar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('bm_paid', 'asc')" class="text-center sortable">
                                <span class="table_header">BM Dibayar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- PPN Dibayar -->
                              <th v-if="order == 'ppn_paid' && by == 'asc'" @click="sort('ppn_paid', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">PPN Dibayar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'ppn_paid' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">PPN Dibayar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('ppn_paid', 'asc')" class="text-center sortable">
                                <span class="table_header">PPN Dibayar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <!-- PPh Dibayar -->
                              <th v-if="order == 'pph_paid' && by == 'asc'" @click="sort('pph_paid', 'desc')" class="text-center sortable sorting sorting-asc">
                                <span class="table_header">PPh Dibayar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else-if="order == 'pph_paid' && by == 'desc'" @click="sort('id', 'asc')" class="text-center sortable sorting sorting-desc">
                                <span class="table_header">PPh Dibayar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                              <th v-else @click="sort('pph_paid', 'asc')" class="text-center sortable">
                                <span class="table_header">PPh Dibayar</span>
                                <button>
                                  <span class="sr-only"></span>
                                </button>
                              </th>
                            </tr>
                            <tr>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter Part Number" v-model="search_part_number" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter Description" v-model="search_description" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter Qty" v-model="search_quantity" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter Kode satuan" v-model="search_unit_code" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter Register A/C" v-model="search_register_ac" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter Customer" v-model="search_customer" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="date" class="vgt-input" placeholder="Filter Date Install/Consume" v-model="search_date_install" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="date" class="vgt-input" placeholder="Filter Date A/C In" v-model="search_date_ac_in" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="date" class="vgt-input" placeholder="Filter Date A/C Out" v-model="search_date_ac_out" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter Type BC Out" v-model="search_type_bc_out" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter No. AJU" v-model="search_no_aju" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter No. Daftar" v-model="search_no_register" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter CIF IDR" v-model="search_cif_idr" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter BM Dibayar" v-model="search_bm_paid" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter PPN Dibayar" v-model="search_ppn_paid" />
                                </div>
                              </th>
                              <th class="filter-th">
                                <div>
                                  <input type="text" class="vgt-input" placeholder="Filter PPh Dibayar" v-model="search_pph_paid" />
                                </div>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(transaction, transaction_index) in transactions.data" :key="transaction_index">
                              <td class="table_content">{{ transaction.part_number }}</td>
                              <td class="table_content">{{ transaction.description }}</td>
                              <td class="table_content">{{ transaction.quantity }}</td>
                              <td class="table_content">{{ transaction.unit_code }}</td>
                              <td class="text-center table_content">{{ transaction.register_ac }}</td>
                              <td class="table_content">{{ transaction.customer }}</td>
                              <td class="table_content">{{ transaction.date_install | formatDate }}</td>
                              <td class="table_content">{{ transaction.date_ac_in | formatDate }}</td>
                              <td class="table_content">{{ transaction.date_ac_out | formatDate }}</td>
                              <td class="table_content">{{ transaction.type_bc_out }}</td>
                              <td class="table_content">{{ transaction.no_aju }}</td>
                              <td class="table_content">{{ transaction.no_register }}</td>
                              <td class="table_content">{{ transaction.cif_idr }}</td>
                              <td class="table_content">{{ transaction.bm_paid }}</td>
                              <td class="table_content">{{ transaction.ppn_paid }}</td>
                              <td class="table_content">{{ transaction.pph_paid }}</td>
                            </tr>
                            <tr v-if="transactions.data.length < 1">
                              <td colspan="15">
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
                              disabled: !transactions.prev_page_url
                            }"
                            @click="transactions.prev_page_url && list(transactions.prev_page_url)"
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
                                {{ transactions.last_page }}
                              </span>
                            </label>
                          </div>
                          <button
                            type="button"
                            class="footer__navigation__page-btn"
                            :class="{
                              disabled: !transactions.next_page_url
                            }"
                            @click="transactions.next_page_url && list(transactions.next_page_url)"
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
import axios from 'axios'
import debounce from 'lodash/debounce'
import Swal from 'sweetalert2'

export default {
  data() {
    return {
      transactions: {
        data: [],
        links: []
      },
      search: null,
      search_part_number: null,
      search_description: null,
      search_quantity: null,
      search_unit_code: null,
      search_register_ac: null,
      search_customer: null,
      search_date_install: null,
      search_date_ac_in: null,
      search_date_ac_out: null,
      search_type_bc_out: null,
      search_no_aju: null,
      search_no_register: null,
      search_cif_idr: null,
      search_bm_paid: null,
      search_ppn_paid: null,
      search_pph_paid: null,
      start_date: null,
      end_date: null,
      order: 'id',
      by: 'desc',
      paginate: '10',
      current_page: null
    }
  },
  created() {
    this.list()
  },
  watch: {
    search: debounce(function () {
      this.list()
    }, 500),
    search_part_number: debounce(function () {
      this.list()
    }, 500),
    search_description: debounce(function () {
      this.list()
    }, 500),
    search_quantity: debounce(function () {
      this.list()
    }, 500),
    search_unit_code: debounce(function () {
      this.list()
    }, 500),
    search_register_ac: debounce(function () {
      this.list()
    }, 500),
    search_date_install: debounce(function () {
      this.list()
    }, 500),
    search_date_ac_in: debounce(function () {
      this.list()
    }, 500),
    search_date_ac_out: debounce(function () {
      this.list()
    }, 500),
    search_type_bc_out: debounce(function () {
      this.list()
    }, 500),
    earch_no_aju: debounce(function () {
      this.list()
    }, 500),
    search_no_register: debounce(function () {
      this.list()
    }, 500),
    search_cif_idr: debounce(function () {
      this.list()
    }, 500),
    search_bm_paid: debounce(function () {
      this.list()
    }, 500),
    search_ppn_paid: debounce(function () {
      this.list()
    }, 500),
    search_pph_paid: debounce(function () {
      this.list()
    }, 500)
  },
  methods: {
    list(paginate) {
      this.showLoading()
      paginate = paginate || `/api/outbound/transaction-3`
      axios
        .get(paginate, {
          params: {
            search: this.search,
            part_number: this.search_part_number,
            description: this.search_description,
            quantity: this.search_quantity,
            unit_code: this.search_unit_code,
            register_ac: this.search_register_ac,
            date_install: this.search_date_install,
            date_ac_in: this.search_date_ac_in,
            date_ac_out: this.search_date_ac_out,
            type_bc_out: this.search_type_bc_out,
            no_aju: this.search_no_aju,
            date_bc_out: this.search_date_bc_out,
            cif_idr: this.search_cif_idr,
            bm_paid: this.search_bm_paid,
            ppn_paid: this.search_ppn_paid,
            pph_paid: this.search_pph_paid,
            start_date: this.start_date,
            end_date: this.end_date,
            order: this.order,
            by: this.by,
            paginate: this.paginate
          }
        })
        .then((response) => {
          this.transactions = response.data
          this.current_page = this.transactions.current_page
          // console.log(this.transactions);
          Swal.close()
        })
        .catch((error) => console.log(error))
    },
    directPage: debounce(function () {
      if (this.current_page < 1) {
        this.current_page = 1
      } else if (this.current_page > this.transactions.last_page) {
        this.current_page = this.transactions.last_page
      }

      let url = new URL(this.transactions.first_page_url)
      let search_params = url.searchParams
      search_params.set('page', this.current_page)
      url.search = search_params.toString()
      let new_url = url.toString()
      this.list(new_url)
    }, 500),
    sort(order, by) {
      this.order = order
      this.by = by
      this.list()
    },
    showLoading() {
      Swal.fire({
        didOpen: () => {
          Swal.showLoading()
        },
        background: 'transparent',
        allowOutsideClick: false
      })
    }
  }
}
</script>
