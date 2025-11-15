@extends('layouts.app')

@section('title', 'Staff Dashboard')

@section('content')
<style>
  .staff-card{border:1px solid var(--divider);border-radius:14px;background:var(--card);padding:1rem 1.1rem;transition:.25s}
  .staff-card:hover{transform:translateY(-2px);box-shadow:0 10px 24px rgba(16,24,40,.06)}
  .kpi{display:flex;gap:.75rem;align-items:center}
  .kpi .num{font-weight:800;color:var(--ink);font-size:1.25rem}
</style>

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h1 class="h4 mb-1 text-dark">Welcome, Staff</h1>
      <div class="small text-muted">Check invigilator duty, rooms, and student lists.</div>
    </div>
    <span class="badge rounded-pill badge-soft">Role: staff</span>
  </div>

  <div class="row g-3">
    <div class="col-md-6">
      <div class="staff-card">
        <div class="d-flex align-items-center mb-2">
          <div class="feature-icon me-2"><i class="bi bi-person-badge"></i></div>
          <div class="fw-semibold text-dark">My Invigilation</div>
        </div>
        <p class="small text-muted mb-2">Your assigned rooms & time slots (read-only).</p>
        <div class="kpi"><i class="bi bi-clock"></i><span class="num">—</span><span class="small text-muted">Next duty</span></div>
        <div class="mt-2">
          <a href="#" class="btn btn-sm btn-outline-secondary disabled">Schedule (soon)</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="staff-card">
        <div class="d-flex align-items-center mb-2">
          <div class="feature-icon me-2"><i class="bi bi-list-check"></i></div>
          <div class="fw-semibold text-dark">Student Lists by Room</div>
        </div>
        <p class="small text-muted mb-2">View/print student allocations for your rooms.</p>
        <a href="#" class="btn btn-sm btn-outline-secondary disabled">Open list (soon)</a>
      </div>
    </div>
  </div>
</div>
@endsection
