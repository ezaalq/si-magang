@extends('mahasiswa.layout')

@section('title', 'Detail Tugas')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Tugas /</span> Detail
            </h4>
            <a href="{{ route('mahasiswa.tugas.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <span class="badge bg-label-primary">{{ ucfirst($tugasMahasiswa->tugas->kategori) }}</span>
                    @php
                        $statusClass = match($tugasMahasiswa->status_pengerjaan) {
                            'belum' => 'secondary',
                            'proses' => 'warning',
                            'selesai' => 'success',
                            default => 'secondary'
                        };
                    @endphp
                    <span class="badge bg-{{ $statusClass }}">
                        {{ ucfirst($tugasMahasiswa->status_pengerjaan) }}
                    </span>
                </div>

                <h3 class="mb-3">{{ $tugasMahasiswa->tugas->judul_tugas }}</h3>

                <div class="mb-4">
                    <h6 class="text-muted mb-2">Deskripsi Tugas</h6>
                    <p>{{ $tugasMahasiswa->tugas->deskripsi }}</p>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Tanggal Mulai</h6>
                        <p><i class="bx bx-calendar me-1"></i> {{ $tugasMahasiswa->tugas->tanggal_mulai->format('d M Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Tanggal Selesai</h6>
                        <p><i class="bx bx-calendar-check me-1"></i> {{ $tugasMahasiswa->tugas->tanggal_selesai->format('d M Y') }}</p>
                    </div>
                </div>

                @if($tugasMahasiswa->catatan)
                <div class="alert alert-info">
                    <h6 class="alert-heading mb-2">Catatan Anda</h6>
                    <p class="mb-0">{{ $tugasMahasiswa->catatan }}</p>
                </div>
                @endif

                @if($tugasMahasiswa->feedback_admin)
                <div class="alert alert-warning">
                    <h6 class="alert-heading mb-2">Feedback Admin</h6>
                    <p class="mb-0">{{ $tugasMahasiswa->feedback_admin }}</p>
                </div>
                @endif
            </div>
        </div>

        @if($tugasMahasiswa->status_pengerjaan !== 'selesai')
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Upload Tugas</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('mahasiswa.tugas.upload', $tugasMahasiswa->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan...">{{ $tugasMahasiswa->catatan }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File Tugas *</label>
                        <input type="file" name="file_upload" class="form-control" required>
                        <small class="text-muted">Max 10MB. Format: zip, pdf, jpg, png, mp4, dll</small>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-upload me-1"></i> Upload Tugas
                    </button>
                </form>
            </div>
        </div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Status Pengerjaan</h5>

                @if($tugasMahasiswa->tanggal_submit)
                <div class="mb-3">
                    <small class="text-muted d-block">Tanggal Submit</small>
                    <strong>{{ $tugasMahasiswa->tanggal_submit->format('d M Y H:i') }}</strong>
                </div>
                @endif

                @if($tugasMahasiswa->file_upload)
                <div class="mb-3">
                    <small class="text-muted d-block">File yang Diupload</small>
                    <a href="{{ Storage::url($tugasMahasiswa->file_upload) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1">
                        <i class="bx bx-download me-1"></i> Download File
                    </a>
                </div>
                @endif

                @if($tugasMahasiswa->nilai)
                <div class="alert alert-success">
                    <h6 class="alert-heading mb-2">Nilai</h6>
                    <h2 class="mb-0">{{ $tugasMahasiswa->nilai }}</h2>
                </div>
                @else
                <div class="alert alert-info">
                    <small class="mb-0">Tugas belum dinilai</small>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
