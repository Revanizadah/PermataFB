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
                <button class="btn btn-success mr-2" id="lapangan-sintetis" onclick="toggleLapangan('sintetis')">Lapangan Sintetis</button>
                <button class="btn btn-warning mr-2" id="lapangan-multicort" onclick="toggleLapangan('multicort')">Lapangan Multicort</button>
            </div>
        </div>

        <!-- Tampilan Lapangan Sintetis -->
        <div id="lapanganSintetisDiv" class="lapangan-info" style="display:none;">
            <h4>Lapangan Sintetis</h4>
            <p>Lapangan Sintetis menggunakan rumput sintetis yang memberikan permukaan lebih empuk dan mengurangi risiko cedera.</p>
        </div>

        <!-- Tampilan Lapangan Multicort -->
        <div id="lapanganMulticortDiv" class="lapangan-info" style="display:none;">
            <h4>Lapangan Multicort</h4>
            <p>Lapangan Multicort biasanya terbuat dari campuran karet dan vinyl yang memberikan permukaan yang lebih keras dan licin.</p>
        </div>

        <!-- Pilihan Jam -->
        <div class="mb-5" id="jam-section" style="display:none;">
            <label class="font-semibold">Jam</label>
            <div class="d-flex flex-wrap mt-2">
                @foreach(['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00'] as $jam)
                    <button class="btn btn-light m-1">{{ $jam }}</button>
                @endforeach
            </div>
        </div>

        <!-- Tombol OFF -->
        <div id="off-section" style="display:none;">
            <button class="btn btn-danger" onclick="offLapangan()">OFF</button>
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

        // Fungsi untuk menampilkan atau menyembunyikan pilihan jam dan tombol OFF berdasarkan lapangan yang dipilih
        function toggleLapangan(lapangan) {
            const lapanganSintetisDiv = document.getElementById('lapanganSintetisDiv');
            const lapanganMulticortDiv = document.getElementById('lapanganMulticortDiv');
            const jamSection = document.getElementById('jam-section');
            const offSection = document.getElementById('off-section');

            // Menyembunyikan semua div lapangan
            lapanganSintetisDiv.style.display = 'none';
            lapanganMulticortDiv.style.display = 'none';
            jamSection.style.display = 'none';
            offSection.style.display = 'none';

            // Tampilkan div sesuai dengan lapangan yang dipilih
            if (lapangan === 'sintetis') {
                lapanganSintetisDiv.style.display = 'block';
                jamSection.style.display = 'block'; // Tampilkan pilihan jam
                offSection.style.display = 'block'; // Tampilkan tombol OFF
            } else if (lapangan === 'multicort') {
                lapanganMulticortDiv.style.display = 'block';
                jamSection.style.display = 'block'; // Tampilkan pilihan jam
                offSection.style.display = 'block'; // Tampilkan tombol OFF
            }
        }

        // Fungsi untuk mematikan lapangan
        function offLapangan() {
            alert("Lapangan telah dimatikan.");
            // Tindakan lebih lanjut bisa ditambahkan sesuai kebutuhan
        }
    </script>
@endsection
