@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<style>
  .student-card{border:1px solid var(--divider);border-radius:14px;background:var(--card);padding:1.25rem;transition:.25s}
  .student-card:hover{transform:translateY(-2px);box-shadow:0 10px 24px rgba(16,24,40,.06)}
  .lookup{display:flex;gap:.5rem;align-items:center}
  .lookup input{max-width:260px}
</style>

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h1 class="h4 mb-1 text-dark">Welcome, {{ auth()->user()->name ?? 'Student' }}</h1>
      <div class="small text-muted">See your room & seat for upcoming exams.</div>
    </div>
    <span class="badge rounded-pill badge-soft">Role: student</span>
  </div>

  <div class="student-card">
    <div class="d-flex align-items-center mb-2">
      <div class="feature-icon me-2"><i class="bi bi-geo-alt"></i></div>
      <div class="fw-semibold text-dark">Your Room & Seat</div>
    </div>
    <p class="small text-muted">Once the seating plan is finalized, your allocation will appear here.</p>

    <div class="lookup mt-2">
      <input class="form-control" placeholder="Search by your roll/CMD ID" disabled>
      <button class="btn btn-brand" disabled><i class="bi bi-search me-1"></i>Find</button>
    </div>

    <div class="alert alert-info mt-3 mb-0">
      <i class="bi bi-info-circle me-1"></i> This section will activate when Admin publishes a plan.
    </div>
  </div>
</div>
@endsection
