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
            <td>{{ $outbound->DATE_INSTALL }}</td>
            <td>{{ $outbound->DATE_AIRCRAFT_IN }}</td>
        </tr>
        @endforeach
    </tbody>
</table>