<table>
    <thead>
        <tr>
            <th><strong>PART NUMBER</strong></th>
            <th><strong>DESCRIPTION</strong></th>
            <th><strong>QUANTITY</strong></th>
            <th><strong>KODE SATUAN</strong></th>
            <th><strong>REGISTER AIRCRAFT</strong></th>
            <th><strong>CUSTOMER</strong></th>
            <th><strong>DATE INSTALL</strong></th>
            <th><strong>DATE AIRCRAFT IN</strong></th>
            <th><strong>DATE AIRCRAFT OUT</strong></th>
            <th><strong>TYPE BC OUT</strong></th>
            <th><strong>NOMOR AJU</strong></th>
            <th><strong>NOMOR DAFTAR</strong></th>
            <th><strong>CIF IDR</strong></th>
            <th><strong>BM Dibayar</strong></th>
            <th><strong>PPn Dibayar</strong></th>
            <th><strong>PPh Dibayar</strong></th>

        </tr>
    </thead>
    <tbody>
        @foreach($outbounds as $outbound)
        <tr>
            <td>{{ $outbound->PART_NUMBER }}</td>
            <td>{{ $outbound->DESCRIPTION }}</td>
            <td>{{ $outbound->QUANTITY }}</td>
            <td>{{ $outbound->UNIT_MEASURE }}</td>
            <td>{{ $outbound->REGISTER_AIRCRAFT }}</td>
            <td>{{ $outbound->CUSTOMER }}</td>
            @if ($outbound->DATE_INSTALL != null && $outbound->DATE_INSTALL != '0000-00-00 00:00:00' )
            <td>{{ Carbon\Carbon::parse($outbound->DATE_INSTALL)->format('d F Y') }}</td>
            @else
            <td></td>
            @endif
            @if ($outbound->DATE_AIRCRAFT_IN)
            <td>{{ Carbon\Carbon::parse($outbound->DATE_AIRCRAFT_IN)->format('d F Y H:i:s') }}</td>
            @else
            <td></td>
            @endif
            @if ($outbound->DATE_AIRCRAFT_OUT)
            <td>{{ Carbon\Carbon::parse($outbound->DATE_AIRCRAFT_OUT)->format('d F Y H:i:s') }}</td>
            @else
            <td></td>
            @endif
            <td>{{ $outbound->TYPE_BC }}</td>
            <td>{{ $outbound->SUBMISSION_NUMBER }}</td>
            <td>{{ $outbound->REGISTRATION_NUMBER }}</td>
            <td>{{ $outbound->CIF_IDR }}</td>
            @if($outbound->JENIS_TARIF == 'BM')
            <td>{{ $outbound->TARIF }}</td>
            @else <td></td>
            @endif

            @if ($outbound->JENIS_TARIF == 'PPN')
            <td>{{ $outbound->TARIF }}</td>
            @else <td></td>
            @endif

            @if($outbound->JENIS_TARIF == 'PPH')
            <td>{{ $outbound->TARIF }}</td>
            @else <td></td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>