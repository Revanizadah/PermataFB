@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Manajemen Penerimaan</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Lapangan</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Nama Pemesan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $reservation->field_name }}</td>
                <td>{{ \Carbon\Carbon::parse($reservation->date)->format('d - m - Y') }}</td>
                <td>{{ $reservation->time }}</td>
                <td>{{ $reservation->customer_name }}</td>
                <td>
                    <!-- Tombol Terima -->
                    <a href="{{ route('admin.accept', $reservation->id) }}" class="btn btn-success">Terima</a>
                    <!-- Tombol Tolak -->
                    <a href="{{ route('admin.reject', $reservation->id) }}" class="btn btn-danger">Tolak</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
