<table class="table table-bordered">
    <thead>
        <tr>
            <th><strong>JENIS DOKUMEN</strong></th>
            <th><strong>NOMOR AJU</strong></th>
            <th><strong>TANGGAL AJU</strong></th>
            <th><strong>NOMOR DAFTAR</strong></th>
            <th><strong>TANGGAL DAFTAR</strong></th>
            <th><strong>TANGGAL PEMASUKAN</strong></th>
            <th><strong>NAMA PENGIRIM</strong></th>
            <th><strong>NAMA PEMILIK</strong></th>
            <th><strong>KODE BARANG</strong></th>
            <th><strong>KODE HS</strong></th>
            <th><strong>URAIAN</strong></th>
            <th><strong>JUMLAH</strong></th>
            <th><strong>SATUAN</strong></th>
            <th><strong>NILAI BARANG</strong></th>

        </tr>
    </thead>
    <tbody>
        @foreach($costums as $costum)
        <tr>
            <td>{{ $costum->KODE_DOKUMEN_PABEAN }}</td>
            <td>{{ $costum->NOMOR_AJU }}</td>
            <td>{{ $costum->TANGGAL_AJU }}</td>
            <td>{{ $costum->NOMOR_DAFTAR }}</td>
            <td>{{ $costum->TANGGAL_DAFTAR }}</td>
            <td>{{ $costum->WAKTU_GATE_IN }}</td>
            <td>{{ $costum->NAMA_PENGIRIM }}</td>
            <td>{{ $costum->NAMA_PEMILIK }}</td>
            <td>{{ $costum->KODE_BARANG }}</td>
            <td>{{ $costum->POS_TARIF }}</td>
            <td>{{ $costum->URAIAN }}</td>
            <td>{{ $costum->JUMLAH_SATUAN }}</td>
            <td>{{ $costum->KODE_SATUAN }}</td>
            @if($costum->KODE_DOKUMEN_PABEAN == '28')
            <td>{{ $costum->CIF_RUPIAH }}</td>
            @elseif ($costum->KODE_DOKUMEN_PABEAN == '41')
            <td>{{ $costum->HARGA_PENYERAHAN }}</td>
            @elseif ($costum->KODE_DOKUMEN_PABEAN == '27')
            @if(is_null($costum->HARGA_PENYERAHAN) || $costum->HARGA_PENYERAHAN == 0)
            <td>{{ $costum->CIF }}</td>
            @else
            <td>{{ $costum->HARGA_PENYERAHAN }}</td>
            @endif
            @endif
        </tr>
        @endforeach
    </tbody>
</table>