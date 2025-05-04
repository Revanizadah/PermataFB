@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Laporan Pesanan</h2>

    <!-- Pilih Tanggal -->
    <div class="mb-4">
        <label for="tanggal" class="font-semibold">Tanggal</label>
        <input type="date" id="tanggal" class="form-control w-25" />
    </div>

    <!-- Tabel Laporan -->
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemesan</th>
                <th>Nomor HP</th>
                <th>Tanggal</th>
                <th>Lapangan</th>
                <th>Jam</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $reservation->nama_pemesan }}</td>
                    <td>{{ $reservation->no_hp }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservation->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $reservation->lapangan }}</td>
                    <td>{{ $reservation->jam }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <!-- Button Export -->
    <div class="mt-4">
        <a href="{{ route('admin.reports.pdf') }}" class="btn btn-danger">Export to PDF</a>
        <a href="{{ route('admin.reports.excel') }}" class="btn btn-success">Export to Excel</a>
    </div>

</div>
@endsection
