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
                                <a href="#">Dashboard</a>
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
                        <div class="card">
                            <div class="card-header">Dokumen Pemasukan PLB</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label
                                                class="col-sm-4 col-form-label"
                                                >Nomor Pengajuan</label
                                            >
                                            <div class="col-sm-8">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-sm-4 col-form-label"
                                                >Tanggal Pengajuan</label
                                            >
                                            <div class="col-sm-4">
                                                <input
                                                    type="date"
                                                    class="form-control"
                                                />
                                            </div>
                                            <div class="col-sm-4">
                                                <input
                                                    type="date"
                                                    class="form-control"
                                                />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-sm-4 col-form-label"
                                                >Jenis Dokumen</label
                                            >
                                            <div class="col-sm-2">
                                                <label
                                                    class="control-label"
                                                    style="margin-top: 5px"
                                                >
                                                    <input
                                                        type="checkbox"
                                                        name="jenis_dokumen[]"
                                                        id="jenis_dokumen"
                                                        checked="checked"
                                                        value="16"
                                                    />
                                                    16
                                                </label>
                                            </div>
                                            <div class="col-sm-2">
                                                <label
                                                    class="control-label"
                                                    style="margin-top: 5px"
                                                >
                                                    <input
                                                        type="checkbox"
                                                        name="jenis_dokumen[]"
                                                        id="jenis_dokumen"
                                                        checked="checked"
                                                        value="27"
                                                    />
                                                    27
                                                </label>
                                            </div>
                                            <div class="col-sm-2">
                                                <label
                                                    class="control-label"
                                                    style="margin-top: 5px"
                                                >
                                                    <input
                                                        type="checkbox"
                                                        name="jenis_dokumen[]"
                                                        id="jenis_dokumen"
                                                        checked="checked"
                                                        value="40"
                                                    />
                                                    40
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-sm-4 col-form-label"
                                            ></label>
                                            <div class="col-sm-4">
                                                <button
                                                    class="
                                                        btn btn-primary btn-md
                                                    "
                                                >
                                                    Filter
                                                </button>
                                                <button
                                                    class="
                                                        btn btn-secondary btn-md
                                                    "
                                                >
                                                    Reset
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr />

                                <div class="row mt-4">
                                    <div class="col-md-3">
                                        <input
                                            class="form-control"
                                            type="search"
                                            placeholder="Search"
                                            v-model="search"
                                        />
                                    </div>
                                </div>
                                <div class="table-responsive mt-3">
                                    <table
                                        class="
                                            table table-bordered table-striped
                                            dataTable
                                            dtr-inline
                                        "
                                    >
                                        <thead>
                                            <tr>
                                                <th
                                                    style="width: 2%"
                                                    class="text-center"
                                                >
                                                    No.
                                                </th>
                                                <th class="text-center">
                                                    Jenis Dokumen
                                                </th>
                                                <th class="text-center">
                                                    No. Aju
                                                </th>
                                                <th class="text-center">
                                                    Tanggal AJU
                                                </th>
                                                <th class="text-center">
                                                    No. Daftar
                                                </th>
                                                <th class="text-center">
                                                    Tgl Daftar
                                                </th>
                                                <th class="text-center">
                                                    Tgl Pemasukan
                                                </th>
                                                <th class="text-center">
                                                    Nama Pengirim
                                                </th>
                                                <th class="text-center">
                                                    Nama Pemilik
                                                </th>
                                                <th class="text-center">
                                                    Kode Barang
                                                </th>
                                                <th class="text-center">
                                                    Kode HS
                                                </th>
                                                <th class="text-center">
                                                    Nama Barang
                                                </th>
                                                <th class="text-center">
                                                    Jumlah
                                                </th>
                                                <th class="text-center">
                                                    Satuan
                                                </th>
                                                <th class="text-center">
                                                    Nilai Barang
                                                </th>
                                                <th>Lampiran</th>
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
                                                <a
                                                    href="javascript:void(0)"
                                                    class="page-link"
                                                >
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
