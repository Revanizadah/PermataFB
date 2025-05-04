<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function dashboard() {
        return view('admin.dashboard');
    }

    public function manageReception()
    {
        $reservations = Reservation::all(); // Ambil semua data pemesanan dari tabel reservations
        return view('admin.manage-reception', compact('reservations')); // Kirim data ke view
    }

    public function manageFields()
    {
        $reservations = Reservation::all(); // Ambil semua data pemesanan dari tabel reservations
        return view('admin.manage-fields', compact('reservations')); // Kirim data ke view
    }

    public function acceptReservation($id)
    {
        $reservation = Reservation::find($id);
        $reservation->status = 'approved'; // Set status menjadi diterima
        $reservation->save();

        return redirect()->route('admin.manage.reception')->with('success', 'Reservasi diterima.');
    }

    public function rejectReservation($id)
    {
        $reservation = Reservation::find($id);
        $reservation->status = 'rejected'; // Set status menjadi ditolak
        $reservation->save();

        return redirect()->route('admin.manage.reception')->with('error', 'Reservasi ditolak.');
    }

    public function manageFutsal()
    {
        return view('admin.manage-futsal');
    }

    public function manageBadminton()
    {
        return view('admin.manage-badminton');
    }

    public function addFutsal(Request $request)
    {
        // Logika untuk menyimpan lapangan futsal baru
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        // Menyimpan data lapangan futsal ke database (sesuaikan dengan model)
        // Futsal::create($validated);

        return redirect()->route('admin.manage.futsal')->with('success', 'Lapangan Futsal berhasil ditambahkan.');
    }

    public function addBadminton(Request $request)
    {
        // Logika untuk menyimpan lapangan badminton baru
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        // Menyimpan data lapangan badminton ke database (sesuaikan dengan model)
        // Badminton::create($validated);

        return redirect()->route('admin.manage.badminton')->with('success', 'Lapangan Badminton berhasil ditambahkan.');
    }


        public function storeBooking(Request $request)
        {
            $request->validate([
                'nama_pemesan' => 'required|string|max:255',
                'no_hp' => 'required|string|max:15',
                'lapangan' => 'required|string|in:Futsal-Sintetis,Futsal-Multicort,Badminton', // Menambahkan validasi untuk lapangan
                'tanggal' => 'required|date',
                'jam' => 'required|string',
            ]);

            // Menyimpan pemesanan lapangan ke database
            FieldBooking::create([
                'nama_pemesan' => $request->nama_pemesan,
                'no_hp' => $request->no_hp,
                'lapangan' => $request->lapangan,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
            ]);

            return response()->json(['message' => 'Pemesanan berhasil'], 200);
        }

        public function showReports()
        {
            $reservations = FieldBooking::all();
            return view('admin.reports', compact('reservations'));
        }

    public function reports()
    {
        // Ambil data pemesanan dari kedua lapangan
        $reservations = Reservation::with('field')->get(); // Mengambil semua pemesanan lapangan
        return view('admin.reports', compact('reservations'));
    }

    // Export ke PDF
    public function exportPdf()
    {
        $reservations = Reservation::with('field')->get();
        $pdf = PDF::loadView('admin.reports-pdf', compact('reservations'));
        return $pdf->download('laporan_pesanan.pdf');
    }

    // Export ke Excel
    public function exportExcel()
    {
        return Excel::download(new ReservationsExport, 'laporan_pesanan.xlsx');
    }
}
