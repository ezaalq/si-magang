@extends('auth.layout')

@section('title', 'Register')

@section('header-title', 'Daftar Akun')
@section('header-subtitle', 'Buat akun mahasiswa magang baru')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control @error('nim') is-invalid @enderror"
                   id="nim" name="nim" value="{{ old('nim') }}" required>
            @error('nim')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror"
               id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">No. Telepon</label>
        <input type="text" class="form-control @error('phone') is-invalid @enderror"
               id="phone" name="phone" value="{{ old('phone') }}">
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="kategori" class="form-label">Kategori Magang</label>
        <select class="form-select @error('kategori') is-invalid @enderror"
                id="kategori" name="kategori" required>
            <option value="">Pilih Kategori</option>
            <option value="photographer" {{ old('kategori') == 'photographer' ? 'selected' : '' }}>
                Photographer
            </option>
            <option value="videographer" {{ old('kategori') == 'videographer' ? 'selected' : '' }}>
                Videographer
            </option>
            <option value="prerelease" {{ old('kategori') == 'prerelease' ? 'selected' : '' }}>
                Pre-Release
            </option>
        </select>
        @error('kategori')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Alamat</label>
        <textarea class="form-control @error('address') is-invalid @enderror"
                  id="address" name="address" rows="2">{{ old('address') }}</textarea>
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror"
                   id="password" name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control"
                   id="password_confirmation" name="password_confirmation" required>
        </div>
    </div>

    <div class="d-grid gap-2 mb-3">
        <button type="submit" class="btn btn-primary btn-lg">
            Daftar Sekarang
        </button>
    </div>

    <div class="text-center">
        <span class="text-muted">Sudah punya akun?</span>
        <a href="{{ route('login') }}" class="text-decoration-none ms-2">
            Login di sini
        </a>
    </div>
</form>
@endsection
