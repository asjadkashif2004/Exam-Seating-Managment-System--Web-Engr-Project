{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')

@section('title', 'Create Account')

@push('head')
<style>

:root {
    --brand:#2563eb;
    --brand-light:#dbe8ff;
    --brand-hover:#1d4ed8;

    --ink:#0f172a;
    --sub:#475569;
    --muted:#6b7280;

    --bg:#f8faff;
    --glass-bg:rgba(255,255,255,0.75);
    --glass-border:rgba(255,255,255,0.35);

    --radius:18px;
}

/* PAGE BACKGROUND */
body {
    background: linear-gradient(135deg, #eef4ff 0%, #f8faff 100%);
    overflow-x: hidden;
}

/* Floating background shapes */
.bg-shape-1, .bg-shape-2 {
    position: absolute;
    filter: blur(70px);
    opacity: .55;
    z-index: 0;
}
.bg-shape-1 {
    width: 320px;
    height: 320px;
    background: #2563eb;
    top: -80px;
    left: -60px;
}
.bg-shape-2 {
    width: 290px;
    height: 290px;
    background: #60a5fa;
    bottom: -70px;
    right: -50px;
}

/* ---------- HERO TEXT ---------- */
.auth-hero {
    padding: 4.5rem 0 2rem;
    text-align: center;
    position: relative;
    z-index: 2;
}

.hero-title {
    font-size: 2.5rem;
    font-weight: 900;
    color: var(--ink);
    letter-spacing: -0.02em;
}

.hero-sub {
    color: var(--sub);
    font-size: 1rem;
}

/* ---------- GLASS CARD ---------- */
.auth-card {
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    backdrop-filter: blur(14px);
    border-radius: var(--radius);
    padding: 2.7rem;
    box-shadow: 0 18px 40px rgba(30,64,175,0.08);
    transition: 0.25s ease;
    position: relative;
    z-index: 3;
}
.auth-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 22px 48px rgba(30,64,175,0.12);
}

/* ---------- FORM ---------- */
.form-label {
    font-weight: 600;
    color: var(--ink);
}

.form-control {
    height: 48px;
    border-radius: 12px;
    border: 1px solid #d7dff0;
    transition: .2s;
}
.form-control:focus {
    border-color: var(--brand);
    box-shadow: 0 0 0 0.15rem rgba(37,99,235,.20);
}

/* ---------- BUTTONS ---------- */
.btn-brand {
    background: var(--brand);
    color: white;
    font-weight: 600;
    border-radius: 12px;
    padding: .75rem 1.4rem;
    border:none;
    transition:.2s ease;
    box-shadow: 0 4px 12px rgba(37,99,235,0.28);
}
.btn-brand:hover {
    background: var(--brand-hover);
    box-shadow: 0 6px 16px rgba(37,99,235,0.45);
}

.btn-outline-clean {
    background: white;
    border-radius: 12px;
    border: 1px solid #d4dbe9;
    font-weight: 600;
    color: var(--ink);
    padding: .75rem 1.4rem;
}
.btn-outline-clean:hover {
    border-color: var(--brand);
    color: var(--brand);
}

/* ---------- FOOTER NOTE ---------- */
.helper-note {
    font-size: .85rem;
    color: var(--muted);
    margin-top: 1rem;
    border-top:1px solid #e4e8f3;
    padding-top: 1rem;
}
</style>
@endpush



@section('content')

{{-- Background Shapes --}}
<div class="bg-shape-1"></div>
<div class="bg-shape-2"></div>

<section class="auth-hero">
    <div class="container">

        <h1 class="hero-title">Create your account</h1>
        <p class="hero-sub">Join the Exam Seating Management System</p>

        <div class="row justify-content-center mt-4">
            <div class="col-md-10 col-lg-6">

                <div class="auth-card">

                    {{-- Validation --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <strong>Please fix the following:</strong>
                            <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input id="name" type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input id="email" type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input id="password" type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Confirm --}}
                        <div class="mb-4">
                            <label class="form-label">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                   required>
                            @error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- BUTTONS --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('login') }}" class="btn-outline-clean">
                                Already registered?
                            </a>

                            <button class="btn-brand">
                                <i class="bi bi-person-check-fill me-1"></i>
                                Register
                            </button>
                        </div>

                    </form>

                    {{-- FOOTER NOTE --}}
                    <div class="helper-note text-center">
                        New accounts are created as <b>students</b> by default.<br>
                        Admins or staff can be assigned later.
                    </div>

                </div>

            </div>
        </div>

    </div>
</section>
@endsection
