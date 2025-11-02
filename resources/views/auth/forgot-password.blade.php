@extends('auth.layout')

@section('title', 'Lupa Password')
@section('header-title', 'Lupa Password')
@section('header-subtitle', 'Kami akan mengirim link reset ke email Anda')

@section('content')
<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror"
               id="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <small class="text-muted">Masukkan email yang terdaftar</small>
    </div>

    <div class="d-grid gap-2 mb-3">
        <button type="submit" class="btn btn-primary btn-lg">
            Kirim Link Reset Password
        </button>
    </div>

    <div class="text-center">
        <a href="{{ route('login') }}" class="text-decoration-none">
            <i class="bx bx-chevron-left"></i> Kembali ke Login
        </a>
    </div>
</form>
@endsection
