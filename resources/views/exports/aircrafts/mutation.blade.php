<table>
    <thead>
        <tr>
            <th><strong>AIRCRAFT REGISTRATION</strong></th>
            <th><strong>OPERATOR</strong></th>
            <th><strong>AIRCRAFT TYPE</strong></th>
            <th><strong>DATE AIRCRAFT IN</strong></th>
            <th><strong>DATE AIRCRAFT OUT</strong></th>
            <th><strong>STATUS</strong></th>

        </tr>
    </thead>
    <tbody>
        @foreach($aircrafts as $aircraft)
        <tr>
            <td>{{ $aircraft->reg }}</td>
            <td>{{ $aircraft->operator }}</td>
            <td>{{ $aircraft->type }}</td>
            @if ($aircraft->date_in)
            {{-- <td>{{ Carbon\Carbon::parse($aircraft->date_in)->format('d F Y H:i:s') }}</td> --}}
            <td>{{ $aircraft->date_in }}</td>
            @else
            <td></td>
            @endif
            @if ($aircraft->date_out)
            {{-- <td>{{ Carbon\Carbon::parse($aircraft->date_out)->format('d F Y H:i:s') }}</td> --}}
            <td>{{ $aircraft->date_out }}</td>
            @else
            <td></td>
            @endif
            <td>{{ $aircraft->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>