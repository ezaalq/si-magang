@extends('mahasiswa.layout')

@section('title', 'Laporan Akhir')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Laporan /</span> Akhir
            </h4>
            @if(!$laporan || $laporan->status == 'revisi')
            <a href="{{ route('mahasiswa.laporan.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i>
                {{ $laporan ? 'Upload Revisi' : 'Upload Laporan' }}
            </a>
            @endif
        </div>
    </div>
</div>

@if($laporan)
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <h4>{{ $laporan->judul }}</h4>
            <span class="badge bg-{{ $laporan->status_badge['class'] }}">
                {{ $laporan->status_badge['text'] }}
            </span>
        </div>

        @if($laporan->ringkasan)
        <div class="mb-3">
            <h6 class="text-muted">Ringkasan</h6>
            <p>{{ $laporan->ringkasan }}</p>
        </div>
        @endif

        <div class="row mb-3">
            <div class="col-md-6">
                <small class="text-muted d-block">Tanggal Submit</small>
                <strong>{{ $laporan->tanggal_submit->format('d M Y') }}</strong>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block">File Laporan</small>
                <a href="{{ Storage::url($laporan->file_laporan) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1">
                    <i class="bx bx-download me-1"></i> Download PDF
                </a>
            </div>
        </div>

        @if($laporan->status == 'revisi' && $laporan->catatan_revisi)
        <div class="alert alert-danger">
            <h6 class="alert-heading mb-2">Catatan Revisi dari Admin</h6>
            <p class="mb-0">{{ $laporan->catatan_revisi }}</p>
        </div>
        @endif

        @if($laporan->status == 'approved')
        <div class="alert alert-success">
            <i class="bx bx-check-circle me-2"></i>
            <strong>Laporan Anda telah disetujui!</strong>
        </div>
        @endif
    </div>
</div>
@else
<div class="card">
    <div class="card-body text-center py-5">
        <i class="bx bx-file bx-lg text-muted mb-3"></i>
        <h5 class="text-muted">Belum ada laporan</h5>
        <p class="text-muted mb-3">Silakan upload laporan akhir magang Anda</p>
        <a href="{{ route('mahasiswa.laporan.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i> Upload Laporan
        </a>
    </div>
</div>
@endif
@endsection
