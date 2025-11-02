@extends('mahasiswa.layout')

@section('title', 'Absensi')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Absensi /</span> Riwayat
            </h4>
            <a href="{{ route('mahasiswa.absensi.create') }}" class="btn btn-primary">
                <i class="bx bx-calendar-plus me-1"></i> Absen Sekarang
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absensi as $item)
                    <tr>
                        <td>{{ $item->tanggal->format('d M Y') }}</td>
                        <td>
                            @if($item->jam_masuk)
                                <span class="badge bg-label-success">{{ $item->jam_masuk }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($item->jam_keluar)
                                <span class="badge bg-label-danger">{{ $item->jam_keluar }}</span>
                            @else
                                <span class="text-muted">Belum</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $badgeClass = match($item->status) {
                                    'hadir' => 'success',
                                    'izin' => 'warning',
                                    'sakit' => 'info',
                                    'alpha' => 'danger',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge bg-label-{{ $badgeClass }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        <td>
                            @if($item->foto_masuk)
                                <a href="{{ Storage::url($item->foto_masuk) }}" target="_blank" class="btn btn-sm btn-icon btn-outline-primary">
                                    <i class="bx bx-image"></i>
                                </a>
                            @endif
                            @if($item->foto_keluar)
                                <a href="{{ Storage::url($item->foto_keluar) }}" target="_blank" class="btn btn-sm btn-icon btn-outline-danger">
                                    <i class="bx bx-image"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <div class="text-muted">
                                <i class="bx bx-calendar-x bx-lg"></i>
                                <p class="mt-2">Belum ada data absensi</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($absensi->hasPages())
        <div class="mt-3">
            {{ $absensi->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Statistik Absensi -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card bg-label-success">
            <div class="card-body text-center">
                <i class="bx bx-check-circle bx-lg mb-2"></i>
                <h4 class="mb-1">{{ $absensi->where('status', 'hadir')->count() }}</h4>
                <p class="mb-0">Hadir</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-label-warning">
            <div class="card-body text-center">
                <i class="bx bx-time bx-lg mb-2"></i>
                <h4 class="mb-1">{{ $absensi->where('status', 'izin')->count() }}</h4>
                <p class="mb-0">Izin</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-label-info">
            <div class="card-body text-center">
                <i class="bx bx-plus-medical bx-lg mb-2"></i>
                <h4 class="mb-1">{{ $absensi->where('status', 'sakit')->count() }}</h4>
                <p class="mb-0">Sakit</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-label-danger">
            <div class="card-body text-center">
                <i class="bx bx-x-circle bx-lg mb-2"></i>
                <h4 class="mb-1">{{ $absensi->where('status', 'alpha')->count() }}</h4>
                <p class="mb-0">Alpha</p>
            </div>
        </div>
    </div>
</div>
@endsection
