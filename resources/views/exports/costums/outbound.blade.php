<table class="table table-bordered">
    <thead>
        <tr>
            <th><strong>JENIS DOKUMEN</strong></th>
            <th><strong>NOMOR AJU</strong></th>
            <th><strong>TANGGAL AJU</strong></th>
            <th><strong>NOMOR DAFTAR</strong></th>
            <th><strong>TANGGAL DAFTAR</strong></th>
            <th><strong>TANGGAL PENGELUARAN</strong></th>
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
            @if($costum->WAKTU_GATE_OUT == null || $costum->WAKTU_GATE_OUT == '0000-00-00 00:00:00')
            <td>{{ date('d/m/Y', strtotime($costum->TANGGAL_DAFTAR))}}</td>
            @else
            <td>{{ date('d/m/Y', strtotime($costum->WAKTU_GATE_OUT)) }}</td>
            @endif
            @if($costum->KODE_DOKUMEN_PABEAN == '28')
            <td>{{ $costum->NAMA_PEMILIK }}</td>
            @else
            <td>{{ $costum->NAMA_PENERIMA_BARANG }}</td>
            @endif
            <td>{{ $costum->KODE_BARANG }}</td>
            <td>{{ $costum->POS_TARIF }}</td>
            <td>{{ $costum->URAIAN }}</td>
            <td>{{ $costum->JUMLAH_SATUAN }}</td>
            <td>{{ $costum->KODE_SATUAN }}</td>
            @if($costum->KODE_DOKUMEN_PABEAN == '28')
            <td>{{ $costum->CIF_RUPIAH }}</td>
            @elseif ($costum->KODE_DOKUMEN_PABEAN == '30')
            <td>{{ $costum->FOB }}</td>
            @elseif ($costum->KODE_DOKUMEN_PABEAN == '41')
            <td>{{ $costum->HARGA_PENYERAHAN }}</td>
            @elseif ($costum->KODE_DOKUMEN_PABEAN == '27')
            @if(is_null($costum->HARGA_PENYERAHAN) || $costum->HARGA_PENYERAHAN == 0)
            <td>{{ $costum->CIF }}</td>
            @else
            <td>{{ $costum->HARGA_PENYERAHAN }}</td>
            @endif
            @endif
            @if($costum->KODE_DOKUMEN_PABEAN == '28' || $costum->KODE_DOKUMEN_PABEAN == '41')
            <td>IDR</td>
            @else
            <td>{{ $costum->KODE_VALUTA }}</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>