<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\TugasKegiatanHarian;
use App\Models\TugasMahasiswa;
use App\Models\LaporanAkhir;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Statistik
        $totalAbsensi = Absensi::where('user_id', $user->id)->count();
        $absensiHadir = Absensi::where('user_id', $user->id)
            ->where('status', 'hadir')->count();

        $totalTugas = TugasMahasiswa::where('user_id', $user->id)->count();
        $tugasSelesai = TugasMahasiswa::where('user_id', $user->id)
            ->where('status_pengerjaan', 'selesai')->count();

        // Tugas terbaru sesuai kategori
        $tugasTerbaru = TugasKegiatanHarian::where('kategori', $user->kategori)
            ->where('status', 'active')
            ->latest()
            ->take(5)
            ->get();

        // Absensi bulan ini
        $absensiTerbaru = Absensi::where('user_id', $user->id)
            ->whereMonth('tanggal', date('m'))
            ->whereYear('tanggal', date('Y'))
            ->latest()
            ->take(5)
            ->get();

        return view('mahasiswa.dashboard', compact(
            'totalAbsensi',
            'absensiHadir',
            'totalTugas',
            'tugasSelesai',
            'tugasTerbaru',
            'absensiTerbaru'
        ));
    }
}
