<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pesanan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Laporan Pesanan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No HP</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Lapangan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $reservation->user->name }}</td>
                <td>{{ $reservation->user->phone_number }}</td>
                <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d - m - Y') }}</td>
                <td>{{ $reservation->start_time }}</td>
                <td>{{ $reservation->field->name }}</td>
                <td>
                    @if($reservation->status == 'approved')
                    Diterima
                    @elseif($reservation->status == 'rejected')
                    Ditolak
                    @else
                    Menunggu
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
