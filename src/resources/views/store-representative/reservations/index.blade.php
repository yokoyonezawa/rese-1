<h1>{{ $shop->name }} の予約情報</h1>

<table>
    <thead>
        <tr>
            <th>予約者名</th>
            <th>予約日時</th>
            <th>人数</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservations as $reservation)
            <tr>
                <td>{{ $reservation->user->name }}様</td>
                <td>{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</td>
                <td>{{ $reservation->number }}名様</td>
            </tr>
        @endforeach
    </tbody>
</table>
