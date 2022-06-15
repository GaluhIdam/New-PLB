<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0">Transaksi Outbound 1</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">
                                <a href="outbound-transcation">Transaksi Outbound​</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <span>Transaksi Outbound 1​</span>
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
                            <div class="card-header">Part (Status Pesawat Masih Didalam PLB GMF)​</div>
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
                                                    <input type="checkbox" name="jenis_dokumen[]" id="jenis_dokumen"
                                                        checked="checked" value="27" />
                                                    27
                                                </label>
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="control-label" style="margin-top: 5px">
                                                    <input type="checkbox" name="jenis_dokumen[]" id="jenis_dokumen"
                                                        checked="checked" value="28" />
                                                    28
                                                </label>
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="control-label" style="margin-top: 5px">
                                                    <input type="checkbox" name="jenis_dokumen[]" id="jenis_dokumen"
                                                        checked="checked" value="30" />
                                                    30
                                                </label>
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="control-label" style="margin-top: 5px">
                                                    <input type="checkbox" name="jenis_dokumen[]" id="jenis_dokumen"
                                                        checked="checked" value="41" />
                                                    41
                                                </label>
                                            </div>
                                        </div>
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

                                <div class="row mt-4">
                                    <div class="col-md-3">
                                        <input class="form-control" type="search" placeholder="Search"
                                            v-model="search" />
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
                                                <th class="text-center">Description</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-center">Kode Satuan</th>
                                                <th class="text-center">Register A/C</th>
                                                <th class="text-center">Customer</th>
                                                <th class="text-center">Date Install/Consume</th>
                                                <th class="text-center">Date A/C In</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
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
                                <div class="mt-2 d-flex justify-content-end">
                                    <nav>
                                        <ul class="pagination">
                                            <li>
                                                <a href="javascript:void(0)" class="page-link">
                                                    <span> Previous </span>
                                                    <span> Next </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
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


