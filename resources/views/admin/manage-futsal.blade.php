@extends('admin.layout')

@section('content')
    <div class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-5">Pemesanan Lapangan Futsal</h1>

        <!-- Pilihan Tanggal -->
        <div class="mb-5">
            <label for="tanggal" class="font-semibold">Tanggal</label>
            <input type="date" id="tanggal" class="form-control mt-2 w-48" />
        </div>

        <!-- Pilihan Lapangan -->
        <div class="mb-5">
            <label for="lapangan" class="font-semibold">Lapangan</label>
            <div class="d-flex mt-2">
                <button class="btn btn-success mr-2" disabled>Lapangan 1 Sintetis</button>
                <button class="btn btn-warning mr-2" disabled>Lapangan 2 Multicort</button>
            </div>
        </div>

        <!-- Pilihan Jam -->
        <div class="mb-5">
            <label class="font-semibold">Jam</label>
            <div class="d-flex flex-wrap mt-2">
                @foreach(['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00'] as $jam)
                    @php
                        // Mengambil status pemesanan lapangan pada waktu tertentu
                        $status = 'available'; // Default status
                        $booking = \App\Models\FieldBooking::where('booking_time', $jam)
                            ->where('field_type', 'futsal')
                            ->where('status', 'approved') // Pastikan status sudah approved
                            ->first();
                        if ($booking) {
                            $status = 'booked'; // Sudah dipesan
                        }
                    @endphp

                    <!-- Tombol untuk memilih jam -->
                    <button class="btn m-1 @if($status == 'available') btn-success @elseif($status == 'booked') btn-secondary @else btn-light @endif"
                            @if($status == 'booked') disabled @endif>
                        {{ $jam }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Tombol OFF -->
        <div>
            <button class="btn btn-danger">OFF</button>
        </div>
    </div>

    <!-- Inline CSS untuk styling -->
    <style>
        /* Styling for buttons */
        button {
            cursor: pointer;
        }

        button:disabled {
            background-color: #ccc;
            color: #777;
        }

        button.btn-light {
            background-color: #f4f4f4;
            border: 1px solid #ddd;
        }

        button.btn-success {
            background-color: #28a745;
            color: white;
        }

        button.btn-primary {
            background-color: #007bff;
            color: white;
        }

        button.btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        /* Adjust container and button layout */
        .container {
            max-width: 1200px;
        }

        .d-flex {
            display: flex;
        }

        .mt-2 {
            margin-top: 1rem;
        }

        .mb-5 {
            margin-bottom: 2rem;
        }
    </style>

    <!-- JavaScript untuk tanggal hanya hari ini dan besok -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(today.getDate() + 1); // Besok

            const dateInput = document.getElementById('tanggal');
            const formattedToday = today.toISOString().split('T')[0];
            const formattedTomorrow = tomorrow.toISOString().split('T')[0];

            dateInput.setAttribute('min', formattedToday); // Set min date to today
            dateInput.setAttribute('max', formattedTomorrow); // Set max date to tomorrow
        });
    </script>
@endsection
