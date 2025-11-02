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

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::where('user_id', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->paginate(20);

        return view('mahasiswa.absensi.index', compact('absensi'));
    }

    public function create()
    {
        // Check if already absent today
        $today = Absensi::where('user_id', Auth::id())
            ->whereDate('tanggal', today())
            ->first();

        if ($today && $today->jam_keluar) {
            return redirect()->route('mahasiswa.absensi.index')
                ->with('error', 'Anda sudah absen hari ini.');
        }

        return view('mahasiswa.absensi.create', compact('today'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:hadir,izin,sakit',
            'keterangan' => 'nullable|string',
            'foto_masuk' => 'nullable|image|max:2048',
        ]);

        $today = Absensi::where('user_id', Auth::id())
            ->whereDate('tanggal', today())
            ->first();

        if ($today && $today->jam_keluar) {
            return redirect()->route('mahasiswa.absensi.index')
                ->with('error', 'Anda sudah absen keluar hari ini.');
        }

        if (!$today) {
            // Absen Masuk
            $data = [
                'user_id' => Auth::id(),
                'tanggal' => today(),
                'jam_masuk' => now()->format('H:i:s'),
                'status' => $validated['status'],
                'keterangan' => $validated['keterangan'],
            ];

            if ($request->hasFile('foto_masuk')) {
                $data['foto_masuk'] = $request->file('foto_masuk')
                    ->store('absensi', 'public');
            }

            Absensi::create($data);
            return redirect()->route('mahasiswa.absensi.index')
                ->with('success', 'Absen masuk berhasil!');
        } else {
            // Absen Keluar
            if ($request->hasFile('foto_keluar')) {
                $today->foto_keluar = $request->file('foto_keluar')
                    ->store('absensi', 'public');
            }

            $today->jam_keluar = now()->format('H:i:s');
            $today->save();

            return redirect()->route('mahasiswa.absensi.index')
                ->with('success', 'Absen keluar berhasil!');
        }
    }
}
