@extends('admin.layout')

@section('content')
    <div class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-5">Manajemen Lapangan</h1>
        <p class="mb-5">Halaman ini digunakan untuk mengelola lapangan futsal dan badminton.</p>

        <!-- Tombol untuk menampilkan dropdown pilihan jenis lapangan -->
        <button id="showDropdownButton" class="btn btn-primary mb-3">
            Pilih Jenis Lapangan
        </button>

        <!-- Dropdown untuk memilih jenis lapangan -->
        <div id="dropdown" class="mb-3" style="display: none;">
            <select id="fieldType" class="form-select">
                <option value="futsal">Futsal</option>
                <option value="badminton">Badminton</option>
            </select>
        </div>

        <!-- Bagian untuk menampilkan pilihan lapangan -->
        <div id="futsalSection" class="mb-3" style="display: none;">
            <h3 class="h4 font-semibold mb-3">Manajemen Lapangan Futsal</h3>
            <p>Kelola lapangan futsal di sini.</p>
        </div>

        <div id="badmintonSection" class="mb-3" style="display: none;">
            <h3 class="h4 font-semibold mb-3">Manajemen Lapangan Badminton</h3>
            <p>Kelola lapangan badminton di sini.</p>
        </div>
    </div>

    <script>
        // Menampilkan dan menyembunyikan dropdown
        document.getElementById('showDropdownButton').addEventListener('click', function () {
            const dropdown = document.getElementById('dropdown');
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none'; // Toggle dropdown visibility
        });

        // Mengatur dropdown agar menampilkan konten yang sesuai dengan pilihan
        document.getElementById('fieldType').addEventListener('change', function () {
            var fieldType = this.value;
            if (fieldType === 'futsal') {
                document.getElementById('futsalSection').style.display = 'block';
                document.getElementById('badmintonSection').style.display = 'none';
            } else if (fieldType === 'badminton') {
                document.getElementById('futsalSection').style.display = 'none';
                document.getElementById('badmintonSection').style.display = 'block';
            }
        });
    </script>
@endsection
