<!-- filepath: f:\cafeteria2\resources\views\auth\login.blade.php -->
@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Correo Electrónico</label>
        <input type="email" id="email" name="correo" class="form-control" value="{{ old('correo') }}" required autofocus>
        @error('correo')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" id="password" name="password" class="form-control" required>
        @error('password')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" id="remember_me" name="remember" class="form-check-input">
        <label for="remember_me" class="form-check-label">Recordarme</label>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
        @endif
        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    </div>
</form>
@endsection
