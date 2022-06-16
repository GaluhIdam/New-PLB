<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0">Summary Outbound</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="/outbound-transcation">Transaksi Outbound
                </a></li>
              <li class="breadcrumb-item active"><span>Summary Outbound</span></li>
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
              <div class="card-header">Summary Outbound</div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-5">
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Part Number</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" />
                      </div>

                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Tanggal Outbound</label>
                      <div class="col-sm-4">
                        <input type="date" class="form-control" />
                      </div>
                      <div class="col-sm-4">
                        <input type="date" class="form-control" />
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
                        <button class="
                                                        btn btn-primary btn-md
                                                    ">
                          Filter
                        </button>
                        <button class="
                                                        btn btn-secondary btn-md
                                                    ">
                          Reset
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <hr />

                <div class="row ">

                  <div class="col-md-4">
                    <div class="dt-buttons btn-group flex-wrap">
                      <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="example1"
                        type="button"><span>Copy</span></button>
                      <button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="example1"
                        type="button"><span>Print</span></button>
                      <button class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="example1"
                        type="button"><span>CSV</span></button>
                      <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0"
                        aria-controls="example1" type="button"><span>Excel</span></button>
                      <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example1"
                        type="button"><span>PDF</span></button>
                    </div>
                  </div>
                  <div class="col-md-5"></div>
                  <div class="col-md-3">
                    <div class="form">
                      <input class="form-control" type="search" placeholder="Search" v-model="search" />
                    </div>
                  </div>
                  <div class="col-md-1"></div>

                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-6">

                  </div>

                </div>
                <div class="table-responsive mt-3">
                  <table class="
                                            table table-bordered table-striped
                                            dataTable
                                            dtr-inline
                                        ">
                    <thead>
                      <tr>
                        <th style="width: 2%" class="text-center">
                          No.
                        </th>
                        <th class="text-center">Part Number</th>
                        <th class="text-center">Kondisi</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">CIF IDR</th>

                        <th class="text-center">BM Dibayar</th>
                        <th class="text-center">PPN Dibayar</th>
                        <th class="text-center">PPh Dibayar</th>
                        <th class="text-center">PPN Tidak Dipungut</th>
                        <th class="text-center">PPh Tidak Dipungut</th>

                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td class="text-center">
                          1
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Kondisi 1
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>

                      </tr>
                      <tr>
                        <td class="text-center">
                          2
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Kondisi 2
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>

                      </tr>
                      <tr>
                        <td class="text-center">
                          3
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Kondisi 3
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>
                        <td class="text-center">
                          Field Kosong..
                        </td>

                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="row">
                  <div clas="row"></div>

                  <div class="col-md-3">
                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of
                      10 entries</div>
                  </div>
                  <div class="col-md-5"></div>
                  <div class="col-md-4">
                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                      <ul class="pagination">
                        <li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#"
                            aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                        <li class="paginate_button page-item active"><a href="#" aria-controls="example1"
                            data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                        <li class="paginate_button page-item"><a href="#" aria-controls="example1" data-dt-idx="2"
                            tabindex="0" class="page-link">2</a></li>
                        <li class="paginate_button page-item"><a href="#" aria-controls="example1" data-dt-idx="3"
                            tabindex="0" class="page-link">3</a></li>
                        <li class="paginate_button page-item"><a href="#" aria-controls="example1" data-dt-idx="4"
                            tabindex="0" class="page-link">4</a></li>
                        <li class="paginate_button page-item"><a href="#" aria-controls="example1" data-dt-idx="5"
                            tabindex="0" class="page-link">5</a></li>
                        <li class="paginate_button page-item"><a href="#" aria-controls="example1" data-dt-idx="6"
                            tabindex="0" class="page-link">6</a></li>
                        <li class="paginate_button page-item next" id="example1_next"><a href="#"
                            aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                      </ul>
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
export default {
  mounted() {
    console.log("Component mounted.");
    k;
  },
};
</script>