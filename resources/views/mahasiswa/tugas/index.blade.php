@extends('mahasiswa.layout')

@section('title', 'Tugas Kegiatan Harian')

@section('content')
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-4">
            <span class="text-muted fw-light">Tugas /</span> Kegiatan Harian
        </h4>
    </div>
</div>

<!-- Info Kategori -->
<div class="alert alert-info alert-dismissible" role="alert">
    <h6 class="alert-heading mb-1">Kategori Anda: <strong>{{ ucfirst(Auth::user()->kategori) }}</strong></h6>
    <p class="mb-0">Anda hanya akan melihat tugas yang sesuai dengan kategori magang Anda.</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<!-- List Tugas -->
<div class="row">
    @forelse($tugas as $item)
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <span class="badge bg-label-primary">{{ ucfirst($item->tugas->kategori) }}</span>
                    @php
                        $statusClass = match($item->status_pengerjaan) {
                            'belum' => 'secondary',
                            'proses' => 'warning',
                            'selesai' => 'success',
                            default => 'secondary'
                        };
                    @endphp
                    <span class="badge bg-label-{{ $statusClass }}">
                        {{ ucfirst($item->status_pengerjaan) }}
                    </span>
                </div>

                <h5 class="card-title">{{ $item->tugas->judul_tugas }}</h5>
                <p class="card-text text-muted">
                    {{ Str::limit($item->tugas->deskripsi, 100) }}
                </p>

                <div class="mb-3">
                    <small class="text-muted d-block">
                        <i class="bx bx-calendar me-1"></i>
                        {{ $item->tugas->tanggal_mulai->format('d M') }} -
                        {{ $item->tugas->tanggal_selesai->format('d M Y') }}
                    </small>

                    @if($item->tanggal_submit)
                    <small class="text-success d-block mt-1">
                        <i class="bx bx-check-circle me-1"></i>
                        Submit: {{ $item->tanggal_submit->format('d M Y H:i') }}
                    </small>
                    @endif

                    @if($item->nilai)
                    <small class="text-primary d-block mt-1">
                        <i class="bx bx-star me-1"></i>
                        Nilai: {{ $item->nilai }}
                    </small>
                    @endif
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('mahasiswa.tugas.show', $item->id) }}" class="btn btn-sm btn-outline-primary flex-fill">
                        <i class="bx bx-show me-1"></i> Detail
                    </a>

                    @if($item->status_pengerjaan !== 'selesai')
                    <button type="button" class="btn btn-sm btn-primary flex-fill" data-bs-toggle="modal" data-bs-target="#uploadModal{{ $item->id }}">
                        <i class="bx bx-upload me-1"></i> Upload
                    </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Upload Modal -->
        <div class="modal fade" id="uploadModal{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('mahasiswa.tugas.upload', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Upload Tugas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Catatan</label>
                                <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan untuk tugas ini...">{{ $item->catatan }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">File Tugas *</label>
                                <input type="file" name="file_upload" class="form-control" required>
                                <small class="text-muted">Max 10MB. Format: zip, pdf, jpg, png, mp4, dll</small>

                                @if($item->file_upload)
                                <div class="alert alert-info mt-2 mb-0">
                                    <small>File sebelumnya: <a href="{{ Storage::url($item->file_upload) }}" target="_blank">Lihat File</a></small>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Upload Tugas</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bx bx-task bx-lg text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada tugas</h5>
                <p class="text-muted">Tugas untuk kategori {{ ucfirst(Auth::user()->kategori) }} akan muncul di sini</p>
            </div>
        </div>
    </div>
    @endforelse
</div>

@if($tugas->hasPages())
<div class="row">
    <div class="col-12">
        <div class="mt-3">
            {{ $tugas->links() }}
        </div>
    </div>
</div>
@endif
@endsection
