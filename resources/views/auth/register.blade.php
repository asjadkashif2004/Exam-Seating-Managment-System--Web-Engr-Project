{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')

@push('head')
<style>
  :root{
    --brand:#0b5ed7;
    --ink:#0f172a;
    --muted:#5b6777;
    --bg:#f7f9fc;
    --card:#ffffff;
    --divider:#eef2f7;
    --grad:linear-gradient(180deg,#f3f8ff 0%,#eef4ff 100%);
  }
  body{ background:var(--bg); }
  .auth-hero{ background:var(--grad); border-bottom:1px solid var(--divider); }
  .auth-card{
    border:1px solid var(--divider);
    background:var(--card);
    box-shadow:0 12px 28px rgba(16,24,40,.06);
    border-radius:16px;
  }
  .brand-badge{
    width:48px;height:48px;border-radius:12px;display:grid;place-items:center;
    background:#eaf2ff;color:var(--brand);font-size:1.25rem;
  }
  .form-label{ color:#364152; font-weight:600; }
  .form-control{
    border-radius:10px;padding:.7rem .9rem;border:1px solid #e6e9ef;
  }
  .form-control:focus{
    border-color:var(--brand);
    box-shadow:0 0 0 .2rem rgba(11,94,215,.15);
  }
  .btn-brand{ background:var(--brand); border-color:var(--brand); border-radius:10px; padding:.6rem 1rem; font-weight:600; }
  .btn-brand:hover{ background:#094cb2; border-color:#094cb2; }
  .link-muted{ color:var(--muted); }
  .link-muted:hover{ color:#2d3748; }
  .small-muted{ color:#6b7685; }
</style>
@endpush

@section('title','Create account')

@section('content')
<section class="auth-hero py-5">
  <div class="container py-lg-4">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <div class="d-inline-flex align-items-center gap-3 mb-3">
          <div class="brand-badge"><i class="bi bi-person-plus-fill"></i></div>
          <div class="text-start">
            <h1 class="h3 mb-0" style="color:var(--ink);font-weight:800;letter-spacing:-.01em;">
              Create your account
            </h1>
            <div class="small small-muted">Join the Exam Seating Manager</div>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center mt-2">
      <div class="col-md-10 col-lg-6">
        <div class="auth-card p-4 p-lg-5">

          {{-- Validation summary (optional) --}}
          @if ($errors->any())
            <div class="alert alert-danger mb-4">
              <strong>Please fix the following:</strong>
              <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          {{-- Same method/route/field names --}}
          <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            {{-- Name --}}
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input id="name" name="name" type="text"
                     class="form-control @error('name') is-invalid @enderror"
                     value="{{ old('name') }}" required autofocus autocomplete="name">
              @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input id="email" name="email" type="email"
                     class="form-control @error('email') is-invalid @enderror"
                     value="{{ old('email') }}" required autocomplete="username">
              @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input id="password" name="password" type="password"
                     class="form-control @error('password') is-invalid @enderror"
                     required autocomplete="new-password">
              @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-4">
              <label for="password_confirmation" class="form-label">Confirm Password</label>
              <input id="password_confirmation" name="password_confirmation" type="password"
                     class="form-control @error('password_confirmation') is-invalid @enderror"
                     required autocomplete="new-password">
              @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-grid gap-2 d-sm-flex justify-content-sm-end align-items-center">
              <a href="{{ route('login') }}" class="btn btn-outline-secondary">
                Already registered?
              </a>
              <button type="submit" class="btn btn-brand">
                <i class="bi bi-person-check-fill me-1"></i> Register
              </button>
            </div>
          </form>

          <div class="small small-muted mt-3">
            By creating an account, you’ll be set as a <b>student</b> by default. Admin/Staff can be added via Tinker.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
