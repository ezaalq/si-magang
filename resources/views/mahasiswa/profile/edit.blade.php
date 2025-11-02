@extends('mahasiswa.layout')

@section('title', 'Edit Profile')

@section('content')
<div class="row">
    <div class="col-12">
        <h4 class="fw-bold mb-4">
            <span class="text-muted fw-light">Profile /</span> Edit Profile
        </h4>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                @if($user->foto_profil)
                    <img src="{{ Storage::url($user->foto_profil) }}" alt="Profile" class="rounded-circle mb-3" width="150" height="150" style="object-fit: cover;">
                @else
                    <div class="avatar avatar-xl mb-3">
                        <span class="avatar-initial rounded-circle bg-label-primary" style="width: 150px; height: 150px; font-size: 48px;">
                            {{ substr($user->name, 0, 1) }}
                        </span>
                    </div>
                @endif
                <h5 class="mb-1">{{ $user->name }}</h5>
                <p class="text-muted mb-2">{{ $user->nim }}</p>
                <span class="badge bg-label-primary">{{ ucfirst($user->kategori) }}</span>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h6 class="mb-3">Quick Links</h6>
                <div class="d-grid gap-2">
                    <a href="{{ route('mahasiswa.profile.change-password') }}" class="btn btn-outline-primary">
                        <i class="bx bx-lock me-1"></i> Ganti Password
                    </a>
                    <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="bx bx-home me-1"></i> Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informasi Profile</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('mahasiswa.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">NIM *</label>
                            <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim', $user->nim) }}" required>
                            @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Profil</label>
                        <input type="file" name="foto_profil" class="form-control @error('foto_profil') is-invalid @enderror" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG. Max: 2MB</small>
                        @error('foto_profil')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori Magang</label>
                        <input type="text" class="form-control" value="{{ ucfirst($user->kategori) }}" disabled>
                        <small class="text-muted">Kategori tidak dapat diubah</small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
