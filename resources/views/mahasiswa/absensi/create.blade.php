@extends('mahasiswa.layout')

@section('title', 'Absen')

@section('content')
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-4">
            <span class="text-muted fw-light">Absensi /</span> Absen Sekarang
        </h4>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    @if($today && !$today->jam_keluar)
                        Absen Keluar
                    @else
                        Absen Masuk
                    @endif
                </h5>
            </div>
            <div class="card-body">
                @if($today && !$today->jam_keluar)
                    <div class="alert alert-info mb-4">
                        <h6 class="alert-heading">Anda sudah absen masuk hari ini</h6>
                        <p class="mb-0">Jam Masuk: <strong>{{ $today->jam_masuk }}</strong></p>
                        <p class="mb-0">Silakan absen keluar sebelum pulang.</p>
                    </div>
                @endif

                <form action="{{ route('mahasiswa.absensi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if(!$today)
                    <div class="mb-3">
                        <label class="form-label">Status Kehadiran *</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="hadir" selected>Hadir</option>
                            <option value="izin">Izin</option>
                            <option value="sakit">Sakit</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Tambahkan keterangan (opsional)"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            @if($today && !$today->jam_keluar)
                                Foto Keluar
                            @else
                                Foto Masuk
                            @endif
                        </label>
                        <input type="file"
                               name="@if($today && !$today->jam_keluar) foto_keluar @else foto_masuk @endif"
                               class="form-control"
                               accept="image/*">
                        <small class="text-muted">Upload foto selfie Anda (opsional)</small>
                    </div>

                    <div class="alert alert-warning">
                        <i class="bx bx-time-five me-2"></i>
                        <strong>Waktu saat ini:</strong> {{ now()->format('d M Y, H:i:s') }}
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('mahasiswa.absensi.index') }}" class="btn btn-outline-secondary">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-check me-1"></i>
                            @if($today && !$today->jam_keluar)
                                Absen Keluar
                            @else
                                Absen Masuk
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
