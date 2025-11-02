@extends('auth.layout')

@section('title', 'Login')

@section('header-title', 'Login')
@section('header-subtitle', 'Sistem Informasi Magang IKP')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror"
               id="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror"
               id="password" name="password" required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember" name="remember">
        <label class="form-check-label" for="remember">
            Ingat Saya
        </label>
    </div>

    <div class="d-grid gap-2 mb-3">
        <button type="submit" class="btn btn-primary btn-lg">
            Login
        </button>
    </div>

    <div class="text-center">
        <a href="{{ route('password.request') }}" class="text-decoration-none me-3">
            Lupa Password?
        </a>
        <span class="text-muted">|</span>
        <a href="{{ route('register') }}" class="text-decoration-none ms-3">
            Daftar Akun Baru
        </a>
    </div>
</form>
@endsection
