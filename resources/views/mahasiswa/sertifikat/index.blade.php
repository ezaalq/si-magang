@extends('mahasiswa.layout')

@section('title', 'Sertifikat')

@section('content')
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-4">
            <span class="text-muted fw-light">Sertifikat /</span> Magang
        </h4>
    </div>
</div>

@if($sertifikat)
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="bx bx-award bx-lg text-warning" style="font-size: 100px;"></i>
                </div>

                <h3 class="mb-3">Sertifikat Magang</h3>
                <p class="text-muted mb-4">Selamat! Anda telah menyelesaikan program magang</p>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <small class="text-muted d-block">Nomor Sertifikat</small>
                        <strong>{{ $sertifikat->nomor_sertifikat }}</strong>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block">Tanggal Terbit</small>
                        <strong>{{ $sertifikat->tanggal_terbit->format('d M Y') }}</strong>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <small class="text-muted d-block">Periode Magang</small>
                        <strong>
                            {{ $sertifikat->tanggal_mulai_magang->format('d M Y') }} -
                            {{ $sertifikat->tanggal_selesai_magang->format('d M Y') }}
                        </strong>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block">Durasi</small>
                        <strong>{{ $sertifikat->durasi_magang }}</strong>
                    </div>
                </div>

                @if($sertifikat->file_sertifikat)
                <div class="d-flex gap-2 justify-content-center">
                    <a href="{{ Storage::url($sertifikat->file_sertifikat) }}" target="_blank" class="btn btn-primary">
                        <i class="bx bx-show me-1"></i> Lihat Sertifikat
                    </a>
                    <a href="{{ route('mahasiswa.sertifikat.download', $sertifikat->id) }}" class="btn btn-success">
                        <i class="bx bx-download me-1"></i> Download PDF
                    </a>
                </div>
                @else
                <div class="alert alert-warning">
                    <i class="bx bx-info-circle me-2"></i>
                    Sertifikat sedang dalam proses. Silakan hubungi admin.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@else
<div class="card">
    <div class="card-body text-center py-5">
        <i class="bx bx-award bx-lg text-muted mb-3"></i>
        <h5 class="text-muted">Sertifikat Belum Tersedia</h5>
        <p class="text-muted">Sertifikat akan diterbitkan setelah Anda menyelesaikan seluruh program magang</p>

        <div class="alert alert-info d-inline-block mt-3">
            <strong>Checklist Kelengkapan:</strong>
            <ul class="text-start mb-0 mt-2">
                <li>Absensi lengkap ✓</li>
                <li>Semua tugas selesai ✓</li>
                <li>Laporan akhir disetujui ✓</li>
                <li>Nilai memenuhi syarat ✓</li>
            </ul>
        </div>
    </div>
</div>
@endif
@endsection
