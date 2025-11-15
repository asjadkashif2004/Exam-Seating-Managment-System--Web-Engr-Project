{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@push('head')
<style>
  :root{
    --brand:#0b5ed7;         /* primary */
    --ink:#0f172a;           /* headings */
    --muted:#5b6777;         /* body */
    --bg:#f7f9fc;            /* page bg */
    --card:#ffffff;          /* card bg */
    --divider:#eef2f7;
    --grad:linear-gradient(180deg,#f3f8ff 0%,#eef4ff 100%);
  }
  body{ background:var(--bg); }
  .auth-hero{
    background: var(--grad);
    border-bottom:1px solid var(--divider);
  }
  .auth-card{
    border:1px solid var(--divider);
    background:var(--card);
    box-shadow: 0 12px 28px rgba(16,24,40,.06);
    border-radius: 16px;
  }
  .brand-badge{
    width:48px;height:48px;border-radius:12px;
    display:grid;place-items:center;
    background:#eaf2ff;color:var(--brand);font-size:1.25rem;
  }
  .form-label{ color:#364152; font-weight:600; }
  .form-control{
    border-radius:10px; padding:.7rem .9rem;
    border:1px solid #e6e9ef;
  }
  .form-control:focus{
    border-color:var(--brand);
    box-shadow:0 0 0 .2rem rgba(11,94,215,.15);
  }
  .btn-brand{
    background:var(--brand); border-color:var(--brand);
    border-radius:10px; padding:.6rem 1rem; font-weight:600;
  }
  .btn-brand:hover{ background:#094cb2; border-color:#094cb2; }
  .link-muted{ color:var(--muted); }
  .link-muted:hover{ color:#2d3748; }
  .small-muted{ color:#6b7685; }
</style>
@endpush

@section('title','Login')

@section('content')
  {{-- Top hero --}}
  <section class="auth-hero py-5">
    <div class="container py-lg-4">
      <div class="row justify-content-center">
        <div class="col-lg-7 text-center">
          <div class="d-inline-flex align-items-center gap-3 mb-3">
            <div class="brand-badge">
              <i class="bi bi-grid-3x3-gap-fill"></i>
            </div>
            <div class="text-start">
              <h1 class="h3 mb-0" style="color:var(--ink); font-weight:800; letter-spacing:-.01em;">
                Welcome back
              </h1>
              <div class="small small-muted">Sign in to manage your exam seating</div>
            </div>
          </div>
        </div>
      </div>

      {{-- Card --}}
      <div class="row justify-content-center mt-2">
        <div class="col-md-10 col-lg-6">
          <div class="auth-card p-4 p-lg-5">
            {{-- Session status (like Breeze’s <x-auth-session-status/>) --}}
            @if (session('status'))
              <div class="alert alert-info mb-4" role="alert">
                {{ session('status') }}
              </div>
            @endif

            {{-- Login form (same method/route/field names) --}}
            <form method="POST" action="{{ route('login') }}" novalidate>
              @csrf

              {{-- Email --}}
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                  id="email"
                  type="email"
                  name="email"
                  value="{{ old('email') }}"
                  class="form-control @error('email') is-invalid @enderror"
                  required
                  autofocus
                  autocomplete="username">
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              {{-- Password --}}
              <div class="mb-3">
                <div class="d-flex justify-content-between">
                  <label for="password" class="form-label mb-0">Password</label>
                  @if (Route::has('password.request'))
                  
                  @endif
                </div>
                <input
                  id="password"
                  type="password"
                  name="password"
                  class="form-control @error('password') is-invalid @enderror"
                  required
                  autocomplete="current-password">
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              {{-- Remember me --}}
              <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                <label class="form-check-label" for="remember_me">Remember me</label>
              </div>

              {{-- Actions --}}
              <div class="d-grid gap-2 d-sm-flex justify-content-sm-end align-items-center">
                <a href="{{ route('register') }}" class="btn btn-outline-secondary d-none d-sm-inline-block">
                  Create account
                </a>
                <button type="submit" class="btn btn-brand">
                  <i class="bi bi-box-arrow-in-right me-1"></i> Log in
                </button>
              </div>

              {{-- Helper note --}}
              <div class="small small-muted mt-3">
                Tip: for local testing you can use
                <code>admin@example.com</code> / <code>password</code> or
                <code>staff@example.com</code> / <code>password</code>
                (if you created those users).
              </div>
            </form>
          </div>

          {{-- Footer link for mobile --}}
          <div class="text-center mt-3 d-sm-none">
            <a href="{{ route('register') }}" class="text-decoration-none link-muted">Create account</a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
