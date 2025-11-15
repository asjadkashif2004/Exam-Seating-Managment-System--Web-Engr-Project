@extends('layouts.app')

@section('content')

<style>
    /* Fade animation */
    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Hover animation for rows */
    .table-hover tbody tr:hover {
        background: #f1f5ff !important;
        transform: scale(1.01);
        transition: 0.2s ease-in-out;
    }

    /* Search bar styling */
    .search-bar {
        border-radius: 10px;
        padding-left: 40px;
    }

    /* Search icon */
    .search-icon {
        position: absolute;
        top: 8px;
        left: 12px;
        color: #6c757d;
        font-size: 1.2rem;
    }

    /* Back button */
    .btn-back {
        border-radius: 8px;
        transition: 0.3s;
    }

    .btn-back:hover {
        transform: translateX(-3px);
        background: #dbeafe !important;
    }

    /* Table header styling */
    th {
        background: #f8f9fa;
        font-weight: 600;
    }
</style>

<div class="container py-4 fade-in">

    {{-- HEADER CARD --}}
    {{-- HEADER CARD --}}
<div class="card shadow-sm mb-4" style="border-radius: 14px;">
    <div class="card-body d-flex justify-content-between align-items-center">

        <div>
            <h3 class="mb-1">Welcome, {{ auth()->user()->name }}</h3>
            <p class="text-muted mb-0">Browse all students or search by CMD / Roll No.</p>
        </div>

        {{-- Show Back Button ONLY when a search is performed --}}
        @if (!empty($search))
            <a href="{{ route('student.index') }}" class="btn btn-outline-primary btn-back">
                ← Back
            </a>
        @endif

    </div>
</div>


    {{-- SEARCH BAR --}}
    <div class="position-relative mb-3">
        <i class="bi bi-search search-icon"></i>
        <form method="GET" action="{{ route('student.index') }}">
            <input type="text" name="search" class="form-control search-bar"
                   placeholder="Search student by CMD / Roll No..."
                   value="{{ $search }}">
        </form>
    </div>

    {{-- STUDENT TABLE --}}
    @if ($students->count())
        <div class="card shadow-sm fade-in" style="border-radius: 14px;">
            <div class="card-body table-responsive">

                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>CMD ID</th>
                            <th>Department</th>
                            <th>Room</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach ($students as $s)
                        <tr>
                            <td class="fw-semibold">{{ $s->name }}</td>
                            <td>{{ $s->cmd_id }}</td>
                            <td>{{ $s->department->name ?? '-' }}</td>
                            <td>{{ $s->room->room_no ?? '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    @else
        <div class="alert alert-info fade-in mt-3">
            No matching students found.
        </div>
    @endif

</div>
@endsection
