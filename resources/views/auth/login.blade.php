{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@push('head')
<style>

    :root {
        --brand:#4f46e5;
        --brand-dark:#3730a3;
        --ink:#0f172a;
        --muted:#64748b;
        --card:#ffffffcc;
    }

    /* ----------- Animated Background ----------- */
    body {
        background: linear-gradient(135deg, #eef2ff, #e0e7ff, #f8fafc);
        min-height: 100vh;
        overflow-x: hidden;
        position: relative;
    }

    .float-circle {
        position: absolute;
        border-radius: 50%;
        filter: blur(40px);
        animation: float 8s infinite ease-in-out alternate;
        opacity: 0.55;
    }

    .c1 {
        width: 420px;
        height: 420px;
        top: -60px;
        left: -80px;
        background: #6366f1;
    }

    .c2 {
        width: 360px;
        height: 360px;
        bottom: -40px;
        right: -60px;
        background: #a5b4fc;
        animation-duration: 10s;
    }

    @keyframes float {
        from { transform: translate(0,0) scale(1); }
        to { transform: translate(40px, -40px) scale(1.1); }
    }

    /* ----------- Auth Card ----------- */
    .auth-card {
        position: relative;
        background: rgba(255,255,255,0.72);
        backdrop-filter: blur(14px);
        border-radius: 22px;
        padding: 40px;
        box-shadow: 0 12px 40px rgba(0,0,0,0.08);
        animation: fadeSlideUp .6s ease;
        border: 1px solid #e5e7eb;
    }

    @keyframes fadeSlideUp {
        from { opacity:0; transform: translateY(30px); }
        to   { opacity:1; transform: translateY(0); }
    }

    /* ----------- Branding ----------- */
    .brand-icon {
        width: 62px;
        height: 62px;
        border-radius: 18px;
        background: #eef2ff;
        color: var(--brand);
        display:flex;
        justify-content:center;
        align-items:center;
        font-size:1.7rem;
        margin: 0 auto 15px;
    }

    .title {
        font-weight: 800;
        font-size: 2rem;
        color: var(--ink);
        text-align:center;
        letter-spacing:-.02em;
    }

    .subtitle {
        text-align:center;
        color: var(--muted);
        margin-top: 4px;
        font-size: 0.95rem;
    }

    /* ----------- Inputs ----------- */
    .form-label {
        font-weight: 600;
        margin-bottom: 6px;
        color:#334155;
    }

    .form-control {
        height: 50px;
        border-radius: 12px;
        border:1px solid #e2e8f0;
        padding-left:14px;
        transition: 0.25s ease;
    }

    .form-control:focus {
        border-color: var(--brand);
        box-shadow: 0 0 0 .25rem rgba(79,70,229,.18);
    }

    /* ----------- Button ----------- */
    .btn-brand {
        background: var(--brand);
        border-color: var(--brand);
        height: 48px;
        border-radius: 12px;
        font-weight: 600;
        letter-spacing: .3px;
        transition: .25s ease;
        color: #fff;
    }
    .btn-brand:hover {
        background: var(--brand-dark);
        border-color: var(--brand-dark);
        transform: translateY(-3px);
        box-shadow: 0 10px 24px rgba(79,70,229,.35);
    }

    .link-muted {
        color: var(--muted);
        text-decoration:none;
    }
    .link-muted:hover {
        color: var(--brand);
    }

</style>
@endpush

@section('title','Login')

@section('content')

    {{-- Animated Background Shapes --}}
    <div class="float-circle c1"></div>
    <div class="float-circle c2"></div>

    <div class="container d-flex justify-content-center align-items-center" style="min-height:85vh;">
        <div class="col-md-8 col-lg-5">

            <div class="auth-card">

                {{-- Logo --}}
                <div class="brand-icon">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>

                <h1 class="title">Welcome Back</h1>
                <p class="subtitle">Sign in to access your dashboard</p>

                @if (session('status'))
                    <div class="alert alert-info mt-3">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="mt-4">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input id="email" type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="form-check mb-4">
                        <input type="checkbox" id="remember" name="remember" class="form-check-input">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>

                    {{-- Actions --}}
                    <button type="submit" class="btn btn-brand w-100">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Login
                    </button>

                </form>

            </div>

        </div>
    </div>

@endsection
