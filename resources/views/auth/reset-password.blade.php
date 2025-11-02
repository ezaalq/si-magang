@extends('auth.layout')

@section('title', 'Reset Password')
@section('header-title', 'Reset Password')
@section('header-subtitle', 'Buat password baru untuk akun Anda')

@section('content')
<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" value="{{ $email }}" disabled>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password Baru</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror"
               id="password" name="password" required autofocus>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <small class="text-muted">Minimal 8 karakter</small>
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
        <input type="password" class="form-control"
               id="password_confirmation" name="password_confirmation" required>
    </div>

    <div class="d-grid gap-2 mb-3">
        <button type="submit" class="btn btn-primary btn-lg">
            Reset Password
        </button>
    </div>

    <div class="text-center">
        <a href="{{ route('login') }}" class="text-decoration-none">
            Kembali ke Login
        </a>
    </div>
</form>
@endsection
