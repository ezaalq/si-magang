@extends('mahasiswa.layout')

@section('title', 'Ganti Password')

@section('content')
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-4">
            <span class="text-muted fw-light">Profile /</span> Ganti Password
        </h4>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Ubah Password</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('mahasiswa.profile.update-password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Password Lama *</label>
                        <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password Baru *</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        <small class="text-muted">Minimal 8 karakter</small>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru *</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="alert alert-info">
                        <i class="bx bx-info-circle me-2"></i>
                        <strong>Tips Keamanan:</strong>
                        <ul class="mb-0 mt-2">
                            <li>Gunakan kombinasi huruf besar dan kecil</li>
                            <li>Sertakan angka dan simbol</li>
                            <li>Jangan gunakan informasi pribadi</li>
                        </ul>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-lock me-1"></i> Ubah Password
                        </button>
                        <a href="{{ route('mahasiswa.profile.edit') }}" class="btn btn-outline-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
