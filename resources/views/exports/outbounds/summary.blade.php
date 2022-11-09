<table>
    <thead>
        <tr>
            <th><strong>PART NUMBER</strong></th>
            <th><strong>KONDISI</strong></th>
            <th><strong>QUANTITY</strong></th>
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
            <td>-</td>
            <td>{{ $outbound->QUANTITY }}</td>
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