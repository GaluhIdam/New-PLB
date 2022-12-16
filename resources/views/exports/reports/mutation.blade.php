<table style="width:100%">
    <thead>
        <tr>
            <th class="text-center" rowspan="2"><strong>KODE BARANG</strong></th>
            <th class="text-center" rowspan="2"><strong>URAIAN</strong></th>
            <th class="text-center" rowspan="2"><strong>SATUAN</strong></th>
            <th class="text-center" colspan="1"><strong>SALDO AWAL</strong></th>
            <th class="text-center" colspan="3"><strong>PEMASUKAN</strong></th>
            <th class="text-center" colspan="4"><strong>PENGELUARAN</strong></th>
            <th class="text-center" colspan="1"><strong>SALDO BUKU</strong></th>
            {{-- <th class="text-center" rowspan="2"><strong>SALDO BUKU</strong></th> --}}
            <th class="text-center" colspan="1"><strong>SALDO AKHIR</strong></th>
            <th class="text-center" rowspan="2"><strong>SELISIH</strong></th>

        </tr>
        <tr>
            {{-- <th>{{ $reports->TANGGAL_SALDO }}</th> --}}
            <th><strong>{{date('d-M-Y', strtotime($filter_start_date))}}</strong></th>
            <th><strong>BC1.6</strong></th>
            <th><strong>BC2.7</strong></th>
            <th><strong>BC4.0</strong></th>
            <th><strong>BC2.7</strong></th>
            <th><strong>BC2.8</strong></th>
            <th><strong>BC3.0</strong></th>
            <th><strong>BC4.1</strong></th>
            <th><strong>{{date('d-M-Y', strtotime($filter_end_date))}}</strong></th>
            <th><strong>{{date('d-M-Y', strtotime($filter_end_date))}}</strong></th>
        </tr>
        <tr>

        </tr>

    </thead>
    <tbody>
        @foreach($reports as $report)
        <tr>
            <td>{{ $report->KODE_BARANG }}</td>
            <td>{{ $report->URAIAN}}</td>
            <td>{{ $report->KODE_SATUAN }}</td>
            <td>{{ $report->SALDO_AWAL }} </td>
            <td>{{ $report->BC16 }}</td>
            <td>{{ $report->BC27IN }}</td>
            <td>{{ $report->BC40 }}</td>
            <td>{{ $report->BC27OUT }}</td>
            <td>{{ $report->BC28 }}</td>
            <td>{{ $report->BC30 }}</td>
            <td>{{ $report->BC41 }}</td>
            <td>{{ floatval($report->SALDO_AWAL) + floatval($report->BC16) + floatval($report->BC27IN) +
                floatval($report->BC40) -
                floatval($report->BC27OUT) - floatval($report->BC28) - floatval($report->BC30) -
                floatval($report->BC41) }}</td>
            <td>{{ floatval($report->SALDO_AKHIR) }}</td>
            <td>{{ $report->SALDO_AKHIR - floatval($report->SALDO_AWAL) + floatval($report->BC16) +
                floatval($report->BC27IN) +
                floatval($report->BC40) -
                floatval($report->BC27OUT) - floatval($report->BC28) - floatval($report->BC30) -
                floatval($report->BC41) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>