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

class TugasController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil tugas sesuai kategori mahasiswa
        $tugasIds = TugasKegiatanHarian::where('kategori', $user->kategori)
            ->pluck('id');

        $tugas = TugasMahasiswa::whereIn('tugas_id', $tugasIds)
            ->where('user_id', $user->id)
            ->with('tugas')
            ->latest()
            ->paginate(10);

        return view('mahasiswa.tugas.index', compact('tugas'));
    }

    public function show($id)
    {
        $tugasMahasiswa = TugasMahasiswa::with('tugas')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('mahasiswa.tugas.show', compact('tugasMahasiswa'));
    }

    public function upload(Request $request, $id)
    {
        $tugasMahasiswa = TugasMahasiswa::where('user_id', Auth::id())
            ->findOrFail($id);

        $request->validate([
            'catatan' => 'nullable|string',
            'file_upload' => 'required|file|max:10240', // 10MB
        ]);

        // Delete old file if exists
        if ($tugasMahasiswa->file_upload) {
            Storage::disk('public')->delete($tugasMahasiswa->file_upload);
        }

        $path = $request->file('file_upload')->store('tugas', 'public');

        $tugasMahasiswa->update([
            'catatan' => $request->catatan,
            'file_upload' => $path,
            'status_pengerjaan' => 'selesai',
            'tanggal_submit' => now(),
        ]);

        return redirect()->route('mahasiswa.tugas.index')
            ->with('success', 'Tugas berhasil diupload!');
    }
}
