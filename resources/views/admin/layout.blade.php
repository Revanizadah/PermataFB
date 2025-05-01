<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sidebar styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #2c3e50;
            color: white;
            padding-top: 30px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 15px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        /* Main content area */
        .content {
            margin-left: 260px;
            padding: 20px;
        }

        /* Navbar styling */
        .navbar {
            background-color: #2980b9;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h4 {
            margin: 0;
        }

        /* Logout button styling */
        .logout {
            background-color: #c0392b;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .logout:hover {
            background-color: #e74c3c;
        }

        /* Dropdown styling */
        .dropdown-menu {
            display: none;
            padding: 10px;
        }

        .dropdown-menu.active {
            display: block;
        }

        .accordion-button {
            background-color: #2980b9;
            color: white;
            border: none;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2 class="text-center">Admin Dashboard</h2>
        <a href="{{ route('admin.manage.reception') }}">Manajemen Penerimaan</a>

        <!-- Manajemen Lapangan Dropdown -->
        <div class="accordion" id="lapanganAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingLapangan">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#lapanganCollapse" aria-expanded="true" aria-controls="lapanganCollapse">
                        Manajemen Lapangan
                    </button>
                </h2>
                <div id="lapanganCollapse" class="accordion-collapse collapse" aria-labelledby="headingLapangan" data-bs-parent="#lapanganAccordion">
                    <div class="accordion-body">
                        <ul class="list-group">
                            <!-- Perbaiki tautan Futsal untuk mengarah ke rute yang benar -->
                            <li class="list-group-item"><a href="{{ route('admin.manage.futsal') }}">Futsal</a></li>
                            <li class="list-group-item"><a href="{{ route('admin.manage.badminton') }}">Badminton</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('admin.reports') }}">Laporan</a>
    </div>

    <!-- Main content -->
    <div class="content">
        <!-- Navbar with logout button -->
        <div class="navbar">
            <h4>Welcome, Admin!</h4>
            <a href="{{ route('logout') }}" class="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

        <!-- Content of the page -->
        @yield('content')
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
