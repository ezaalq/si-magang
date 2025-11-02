@extends('mahasiswa.layout')

@section('title', 'Upload Laporan')

@section('content')
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-4">
            <span class="text-muted fw-light">Laporan /</span> Upload
        </h4>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ $laporan ? 'Upload Revisi Laporan' : 'Upload Laporan Akhir' }}</h5>
            </div>
            <div class="card-body">
                @if($laporan && $laporan->status == 'revisi')
                <div class="alert alert-warning mb-4">
                    <h6 class="alert-heading">Catatan Revisi</h6>
                    <p class="mb-0">{{ $laporan->catatan_revisi }}</p>
                </div>
                @endif

                <form action="{{ route('mahasiswa.laporan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Judul Laporan *</label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul', $laporan->judul ?? '') }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ringkasan</label>
                        <textarea name="ringkasan" class="form-control" rows="4"
                                  placeholder="Ringkasan singkat laporan...">{{ old('ringkasan', $laporan->ringkasan ?? '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">File Laporan (PDF) *</label>
                        <input type="file" name="file_laporan" class="form-control @error('file_laporan') is-invalid @enderror"
                               accept=".pdf" required>
                        <small class="text-muted">Format PDF, Max 10MB</small>
                        @error('file_laporan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert alert-info">
                        <strong>Panduan Upload Laporan:</strong>
                        <ul class="mb-0 mt-2">
                            <li>Laporan harus dalam format PDF</li>
                            <li>Pastikan semua halaman terbaca dengan jelas</li>
                            <li>Maksimal ukuran file 10MB</li>
                            <li>Laporan akan direview oleh admin</li>
                        </ul>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-upload me-1"></i> Upload Laporan
                        </button>
                        <a href="{{ route('mahasiswa.laporan.index') }}" class="btn btn-outline-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
