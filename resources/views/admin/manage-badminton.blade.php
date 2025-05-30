@extends('admin.layout')

@section('content')
    <div class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-5">Pemesanan Lapangan Badminton</h1>

        <!-- Form Pemesanan -->
        <div class="mb-5">
            <label for="nama_pemesan" class="font-semibold">Nama Pemesan</label>
            <input type="text" id="nama_pemesan" class="form-control mt-2 w-48" required/>
        </div>

        <div class="mb-5">
            <label for="no_hp" class="font-semibold">Nomor HP Pemesan</label>
            <input type="text" id="no_hp" class="form-control mt-2 w-48" required/>
        </div>

        <!-- Pilihan Tanggal -->
        <div class="mb-5">
            <label for="tanggal" class="font-semibold">Tanggal</label>
            <input type="date" id="tanggal" class="form-control mt-2 w-48" />
        </div>

        <!-- Pilihan Jam -->
        <div class="mb-5">
            <label class="font-semibold">Jam</label>
            <div class="d-flex flex-wrap mt-2">
                @foreach(['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00'] as $jam)
                    <button class="btn btn-light m-1" data-jam="{{ $jam }}" onclick="selectJam(this)">{{ $jam }}</button>
                @endforeach
            </div>
        </div>

        <!-- Tombol Pemesanan -->
        <button class="btn btn-primary" onclick="simpanPemesanan()">Pesan Lapangan</button>
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

        button.btn-warning {
            background-color: #ffc107;
            color: white;
        }

        button.btn-danger {
            background-color: #dc3545;
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

        // Fungsi untuk memilih jam
        function selectJam(button) {
            // Menonaktifkan semua tombol jam
            const buttons = document.querySelectorAll('button[data-jam]');
            buttons.forEach(button => button.classList.remove('selected'));

            // Menandai jam yang dipilih
            button.classList.add('selected');
        }

        // Fungsi untuk menyimpan pemesanan
        function simpanPemesanan() {
            const namaPemesan = document.getElementById('nama_pemesan').value;
            const noHp = document.getElementById('no_hp').value;
            const tanggal = document.getElementById('tanggal').value;
            const lapangan = 'Badminton'; // Lapangan sudah pasti badminton
            const jam = document.querySelector('button.selected') ? document.querySelector('button.selected').innerText : '';

            if (!jam) {
                alert('Silakan pilih jam terlebih dahulu');
                return;
            }

            // Kirim data pemesanan ke server
            fetch('/admin/pemesanan', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    nama_pemesan: namaPemesan,
                    no_hp: noHp,
                    tanggal: tanggal,
                    lapangan: lapangan,
                    jam: jam
                })
            })
            .then(response => response.json())
            .then(data => {
                alert('Pemesanan berhasil!');
                location.reload(); // Refresh halaman untuk menampilkan data terbaru
            })
            .catch(error => {
                alert('Terjadi kesalahan saat memproses pemesanan.');
            });
        }
    </script>
@endsection
