@extends('layouts.app')

@section('title', 'Admin Dashboard')

@push('head')
<style>

/* PAGE BACKGROUND */
body {
    background: #f5f7fb;
}

/* Page Title */
.page-title {
    font-weight: 800;
    letter-spacing: -0.02em;
    color: #0f172a;
}

/* Premium Card Look */
.card {
    border: none;
    border-radius: 16px;
    background: #ffffffd9;
    backdrop-filter: blur(8px);
    box-shadow: 0 8px 28px rgba(0,0,0,0.08);
    transition: all 0.25s ease;
}
.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 32px rgba(0,0,0,0.14);
}

/* Soft Badge */
.badge-soft {
    background: #dbeafe;
    color: #1e40af;
    padding: 6px 14px;
    border-radius: 16px;
    font-weight: 600;
}

/* Buttons */
.btn-wow {
    transition: 0.2s ease-in-out;
    border-radius: 10px;
    padding: 8px 18px;
    font-weight: 600;
}
.btn-wow:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(37, 99, 235, 0.4);
}

/* Stylish Table */
.stylish-table thead th {
    background: #eef3fa;
    font-weight: 700;
    color: #1e293b;
    border-bottom: 2px solid #e3e8ef;
    padding: 12px;
}

.stylish-table tbody tr {
    background: #ffffffc0;
    transition: 0.18s ease-in-out;
}
.stylish-table tbody tr:hover {
    background: #f0f4ff !important;
    transform: scale(1.005);
}

/* Action Buttons */
.action-btn {
    width: 36px; height: 36px;
    display: flex; align-items: center; justify-content: center;
    border-radius: 10px;
    background: #ffffff;
    transition: .2s;
}
.action-btn:hover {
    background: #e8f0ff;
    transform: translateY(-2px);
}

/* Inline Edit Row */
.inline-edit-row {
    background: #f8faff !important;
    border-left: 4px solid #3b82f6;
    animation: fadeIn .3s ease;
}

/* Fade Animation */
.fade-in {
    animation: fadeIn .45s ease-in-out;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}

</style>
@endpush



@section('content')
<div class="container py-4 fade-in">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Admin Dashboard</h1>
            <div class="small text-muted">Manage Departments, Rooms & Students efficiently.</div>
        </div>
        <span class="badge badge-soft">Role: Admin</span>
    </div>


    {{-- FLASH MESSAGES --}}
    @if (session('ok'))
        <div class="alert alert-success fade-in">{{ session('ok') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger fade-in">{{ session('error') }}</div>
    @endif



    <div class="row g-4">

        {{-- ADD DEPARTMENT --}}
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5><i class="bi bi-building-add text-primary me-1"></i> Add Department</h5>

                    <form class="form-mini mt-2" method="POST" action="{{ route('admin.departments.store') }}">
                        @csrf
                        <input class="form-control mb-2" name="name" placeholder="Department Name" required>

                        <button class="btn btn-primary btn-wow w-100">Add</button>
                    </form>

                    <hr>

                    <div class="small text-muted">Departments</div>
                    <ul class="list-group mt-2">
                        @forelse ($departments as $dept)
                            <li class="list-group-item d-flex justify-content-between">
                                {{ $dept->name }}
                                <form method="POST" action="{{ route('admin.departments.destroy', $dept) }}">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </li>
                        @empty
                            <li class="list-group-item">No departments yet</li>
                        @endforelse
                    </ul>

                </div>
            </div>
        </div>


        {{-- ADD ROOM --}}
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5><i class="bi bi-door-open text-primary me-1"></i> Add Room</h5>

                    <form class="form-mini mt-2" method="POST" action="{{ route('admin.rooms.store') }}">
                        @csrf

                        <select class="form-select mb-2" name="department_id" required>
                            <option hidden>Select Department</option>
                            @foreach ($departments as $d)
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                            @endforeach
                        </select>

                        <input class="form-control mb-2" name="room_no" placeholder="Room No" required>
                        <input class="form-control mb-2" type="number" name="capacity" placeholder="Capacity" required>
                        <input class="form-control mb-2" name="invigilator" placeholder="Invigilator (optional)">

                        <button class="btn btn-primary btn-wow w-100">Add</button>
                    </form>

                </div>
            </div>
        </div>


        {{-- ADD STUDENT --}}
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">

                    <h5><i class="bi bi-person-plus text-primary me-1"></i> Add Student</h5>

                    <form class="form-mini mt-2" method="POST" action="{{ route('admin.students.store') }}">
                        @csrf
                        <input class="form-control mb-2" name="name" placeholder="Student Name" required>
                        <input class="form-control mb-2" name="cmd_id" placeholder="CMD ID" required>

                        <select class="form-select mb-2" name="department_id" required>
                            <option hidden>Department</option>
                            @foreach ($departments as $d)
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                            @endforeach
                        </select>

                        <input class="form-control mb-2" type="number" name="semester" min="1" max="8" placeholder="Semester">

                        <select class="form-select mb-2" name="room_id">
                            <option value="">Room (optional)</option>
                            @foreach ($rooms as $r)
                                <option value="{{ $r->id }}">{{ $r->room_no }}</option>
                            @endforeach
                        </select>

                        <button class="btn btn-primary btn-wow w-100">Add Student</button>
                    </form>

                </div>
            </div>
        </div>

    </div>



    {{-- STUDENTS TABLE --}}
    <div class="card mt-4">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Students</h5>

                <div class="d-flex align-items-center gap-3">
                    <span class="small text-muted">Total: {{ $students->total() }}</span>

                    {{-- EXPORT PDF BUTTON --}}
                    <a href="{{ route('admin.export.pdf') }}" class="btn btn-danger btn-wow">
                        <i class="bi bi-filetype-pdf me-1"></i> Export Seating Plan PDF
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table stylish-table align-middle">

                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>CMD</th>
                            <th>Dept</th>
                            <th>Sem</th>
                            <th>Room</th>
                            <th>Invigilator</th>
                            <th class="text-center" width="90">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($students as $s)

                            {{-- NORMAL ROW --}}
                            <tr>
                                <td class="fw-semibold">{{ $s->name }}</td>

                                <td>
                                    <span class="badge bg-light text-dark px-2 py-1 rounded-pill">
                                        {{ $s->cmd_id }}
                                    </span>
                                </td>

                                <td>{{ $s->department->name ?? '-' }}</td>
                                <td>{{ $s->semester }}</td>
                                <td>{{ $s->room->room_no ?? '-' }}</td>
                                <td>{{ $s->room->invigilator ?? '-' }}</td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">

                                        {{-- EDIT COLLAPSE BUTTON --}}
                                        <button class="btn btn-sm action-btn"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#editRow{{ $s->id }}">
                                            <i class="bi bi-pencil text-primary"></i>
                                        </button>

                                        {{-- DELETE --}}
                                        <form method="POST" action="{{ route('admin.students.destroy', $s) }}"
                                              onsubmit="return confirm('Delete student?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm action-btn">
                                                <i class="bi bi-trash text-danger"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>


                            {{-- INLINE EDIT ROW --}}
                            <tr id="editRow{{ $s->id }}" class="collapse inline-edit-row">
                                <td colspan="7">

                                    <form method="POST" action="{{ route('admin.students.update', $s) }}"
                                          class="row g-2 p-3">
                                        @csrf @method('PUT')

                                        <div class="col-md-3">
                                            <label class="small fw-bold">Name</label>
                                            <input name="name" value="{{ $s->name }}"
                                                   class="form-control form-control-sm">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="small fw-bold">CMD ID</label>
                                            <input name="cmd_id" value="{{ $s->cmd_id }}"
                                                   class="form-control form-control-sm">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="small fw-bold">Department</label>
                                            <select name="department_id" class="form-select form-select-sm">
                                                @foreach ($departments as $d)
                                                    <option value="{{ $d->id }}"
                                                        @selected($s->department_id == $d->id)>
                                                        {{ $d->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-1">
                                            <label class="small fw-bold">Sem</label>
                                            <input type="number" name="semester" min="1" max="8"
                                                   value="{{ $s->semester }}"
                                                   class="form-control form-control-sm">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="small fw-bold">Room</label>
                                            <select name="room_id" class="form-select form-select-sm">
                                                <option value="">None</option>
                                                @foreach ($rooms as $r)
                                                    <option value="{{ $r->id }}"
                                                        @selected($s->room_id == $r->id)>
                                                        {{ $r->room_no }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2 d-flex align-items-end justify-content-end gap-2">
                                            <button class="btn btn-primary btn-sm">Save</button>

                                            <button type="button"
                                                    class="btn btn-secondary btn-sm"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#editRow{{ $s->id }}">
                                                Cancel
                                            </button>
                                        </div>

                                    </form>

                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                </table>
            </div>

            <div class="mt-3">
                {{ $students->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
