@extends('mahasiswa.layout')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard /</span> Overview
        </h4>
    </div>
</div>

<!-- Statistik Cards -->
<div class="row">
    <div class="col-lg-3 col-md-6 col-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <i class="bx bx-calendar-check rounded bx-md text-primary"></i>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Total Absensi</span>
                <h3 class="card-title mb-2">{{ $totalAbsensi }}</h3>
                <small class="text-success fw-semibold">
                    <i class="bx bx-check"></i> Hadir: {{ $absensiHadir }}
                </small>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <i class="bx bx-task rounded bx-md text-success"></i>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Total Tugas</span>
                <h3 class="card-title mb-2">{{ $totalTugas }}</h3>
                <small class="text-success fw-semibold">
                    <i class="bx bx-check-circle"></i> Selesai: {{ $tugasSelesai }}
                </small>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <i class="bx bx-category rounded bx-md text-warning"></i>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Kategori</span>
                <h3 class="card-title text-nowrap mb-1">{{ ucfirst(Auth::user()->kategori) }}</h3>
                <small class="text-muted">Magang</small>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <i class="bx bx-user rounded bx-md text-info"></i>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">NIM</span>
                <h3 class="card-title text-nowrap mb-1">{{ Auth::user()->nim }}</h3>
                <small class="text-muted">{{ Auth::user()->name }}</small>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Tugas Terbaru -->
    <div class="col-md-6 col-lg-6 mb-3">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Tugas Terbaru</h5>
                    <small class="text-muted">Sesuai kategori Anda</small>
                </div>
            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    @forelse($tugasTerbaru as $tugas)
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="bx bx-task"></i>
                            </span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">{{ $tugas->judul_tugas }}</h6>
                                <small class="text-muted">
                                    {{ $tugas->tanggal_mulai->format('d M Y') }} -
                                    {{ $tugas->tanggal_selesai->format('d M Y') }}
                                </small>
                            </div>
                            <div class="user-progress">
                                <span class="badge bg-label-{{ $tugas->status == 'active' ? 'success' : 'warning' }}">
                                    {{ ucfirst($tugas->status) }}
                                </span>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="text-center text-muted py-3">
                        Tidak ada tugas terbaru
                    </li>
                    @endforelse
                </ul>
                @if($tugasTerbaru->count() > 0)
                <div class="mt-3">
                    <a href="{{ route('mahasiswa.tugas.index') }}" class="btn btn-sm btn-primary">
                        Lihat Semua Tugas
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Absensi Terbaru -->
    <div class="col-md-6 col-lg-6 mb-3">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Absensi Bulan Ini</h5>
                    <small class="text-muted">Riwayat kehadiran terbaru</small>
                </div>
            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    @forelse($absensiTerbaru as $absen)
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-{{ $absen->status == 'hadir' ? 'success' : 'danger' }}">
                                <i class="bx bx-calendar-check"></i>
                            </span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">{{ $absen->tanggal->format('d M Y') }}</h6>
                                <small class="text-muted">
                                    {{ $absen->jam_masuk }}
                                    @if($absen->jam_keluar)
                                    - {{ $absen->jam_keluar }}
                                    @endif
                                </small>
                            </div>
                            <div class="user-progress">
                                <span class="badge bg-label-{{ $absen->status == 'hadir' ? 'success' : ($absen->status == 'izin' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($absen->status) }}
                                </span>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="text-center text-muted py-3">
                        Belum ada absensi bulan ini
                    </li>
                    @endforelse
                </ul>
                @if($absensiTerbaru->count() > 0)
                <div class="mt-3">
                    <a href="{{ route('mahasiswa.absensi.index') }}" class="btn btn-sm btn-primary">
                        Lihat Semua Absensi
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Quick Actions</h5>
                <div class="row mt-3">
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('mahasiswa.absensi.create') }}" class="btn btn-outline-primary w-100">
                            <i class="bx bx-calendar-check me-1"></i> Absen Sekarang
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('mahasiswa.tugas.index') }}" class="btn btn-outline-success w-100">
                            <i class="bx bx-task me-1"></i> Lihat Tugas
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('mahasiswa.laporan.index') }}" class="btn btn-outline-warning w-100">
                            <i class="bx bx-file me-1"></i> Laporan Akhir
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('mahasiswa.profile.edit') }}" class="btn btn-outline-info w-100">
                            <i class="bx bx-user me-1"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
