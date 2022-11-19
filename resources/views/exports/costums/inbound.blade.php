<table>
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
            <th><strong>KODE VALUTA</strong></th>

        </tr>
    </thead>
    <tbody>
        @foreach($costums as $costum)
        <tr>
            <td>{{ $costum->KODE_DOKUMEN_PABEAN }}</td>
            <td>{{ $costum->NOMOR_AJU }}</td>
            @if ($costum->TANGGAL_AJU != null && $costum->TANGGAL_AJU != '0000-00-00 00:00:00' )
            <td>{{date('d/m/Y', strtotime($costum->TANGGAL_AJU))}}</td>
            @else
            <td></td>
            @endif
            <td>{{ $costum->NOMOR_DAFTAR }}</td>
            @if ($costum->TANGGAL_DAFTAR != null && $costum->TANGGAL_DAFTAR != '0000-00-00 00:00:00' )
            <td>{{date('d/m/Y', strtotime($costum->TANGGAL_DAFTAR))}}</td>
            @else
            <td></td>
            @endif
            @if($costum->WAKTU_GATE_IN == null || $costum->WAKTU_GATE_IN == '0000-00-00 00:00:00')
            <td>{{ date('d/m/Y', strtotime($costum->TANGGAL_DAFTAR))}}</td>
            @else
            <td>{{ date('d/m/Y', strtotime($costum->WAKTU_GATE_IN)) }}</td>
            @endif
            <td>{{ $costum->NAMA_PENGIRIM }}</td>
            <td>{{ $costum->NAMA_PEMILIK }}</td>
            <td>{{ $costum->KODE_BARANG }}</td>
            <td>{{ $costum->POS_TARIF }}</td>
            <td>{{ $costum->URAIAN }}</td>
            <td>{{ $costum->JUMLAH_SATUAN }}</td>
            <td>{{ $costum->KODE_SATUAN }}</td>
            @if($costum->KODE_DOKUMEN_PABEAN == '40')
            <td>{{ $costum->HARGA_PENYERAHAN }}</td>
            @else
            <td>{{ $costum->CIF }}</td>
            @endif
            @if($costum->KODE_DOKUMEN_PABEAN == '40')
            <td>IDR</td>
            @else
            <td>{{ $costum->KODE_VALUTA }}</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>