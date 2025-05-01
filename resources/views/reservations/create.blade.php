@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Reservasi Lapangan</h1>

        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="field_id" class="form-label">Pilih Lapangan</label>
                <select name="field_id" id="field_id" class="form-control">
                    @foreach ($fields as $field)
                        <option value="{{ $field->id }}">{{ $field->name }} ({{ $field->type }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="reservation_date" class="form-label">Tanggal Reservasi</label>
                <input type="date" name="reservation_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">Waktu Mulai</label>
                <input type="time" name="start_time" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">Waktu Selesai</label>
                <input type="time" name="end_time" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Reservasi</button>
        </form>
    </div>
@endsection
