@extends('layouts.app')

@section('title', 'Admin Dashboard')

@push('head')
<style>

body {
    background: linear-gradient(to bottom right, #e8eefc, #f9fbff);
}

/* ======= GLOBAL UI ENHANCEMENTS ======= */

.page-title {
    font-weight: 800;
    letter-spacing: -0.03em;
    font-size: 32px;
    color: #0f172a;
}

/* Spacing between big sections */
.section-block {
    margin-top: 35px;
}

/* Premium Card */
.card {
    border: none;
    border-radius: 18px;
    background: rgba(255,255,255,0.75);
    backdrop-filter: blur(12px);
    padding: 18px 20px !important;
    box-shadow: 0 10px 35px rgba(0,0,0,0.08);
    transition: .25s ease;
}
.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 38px rgba(0,0,0,0.12);
}

/* Modern form spacing */
.form-control, .form-select {
    height: 44px;
    border-radius: 10px;
}

/* Buttons */
.btn-wow {
    border-radius: 10px;
    padding: 10px 20px;
    font-weight: 600;
    transition: .22s ease;
}
.btn-wow:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 28px rgba(37, 99, 235, 0.3);
}

/* Table */
.stylish-table thead th {
    background: #e6edff;
    font-weight: 700;
    padding: 14px;
}

.stylish-table tbody tr {
    background: #ffffffd6;
    transition: .18s ease;
}
.stylish-table tbody tr:hover {
    background: #eef3ff !important;
    transform: scale(1.005);
}

/* Action Buttons */
.action-btn {
    width: 38px;
    height: 38px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    transition: .2s;
}
.action-btn:hover {
    background: #e6ecff;
    transform: translateY(-2px);
}

/* Inline Edit Row */
.inline-edit-row {
    background: #f3f7ff !important;
    border-left: 4px solid #3b82f6;
    animation: fadeIn .35s ease;
}

/* Fade Animation */
.fade-in {
    animation: fadeIn .45s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
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
            <div class="small text-muted">Effortlessly manage Departments, Rooms, and Students.</div>
        </div>

        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold">Admin</span>
    </div>


    {{-- FLASH MESSAGES --}}
    @if (session('ok'))
        <div class="alert alert-success fade-in">{{ session('ok') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger fade-in">{{ session('error') }}</div>
    @endif


    <div class="row g-4">

        {{-- =========================
            COLUMN 1: DEPARTMENTS
        ========================== --}}
        <div class="col-lg-4">
            <div class="card h-100">

                <h5 class="fw-bold mb-3"><i class="bi bi-building text-primary me-1"></i> Departments</h5>

                {{-- ADD FORM --}}
                <form method="POST" action="{{ route('admin.departments.store') }}">
                    @csrf
                    <input class="form-control mb-2" name="name" placeholder="Department Name" required>
                    <button class="btn btn-primary btn-wow w-100">Add Department</button>
                </form>

                <hr>

                {{-- LIST --}}
                <ul class="list-group mt-2">
                    @forelse ($departments as $dept)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
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



        {{-- =========================
            COLUMN 2: ROOMS
        ========================== --}}
        <div class="col-lg-4">
            <div class="card h-100">

                <h5 class="fw-bold mb-3"><i class="bi bi-door-open text-primary me-1"></i> Rooms</h5>

                {{-- ADD FORM --}}
                <form method="POST" action="{{ route('admin.rooms.store') }}">
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

                    <button class="btn btn-primary btn-wow w-100">Add Room</button>
                </form>

                <hr>

                <h6 class="text-muted">Manage Rooms</h6>

                <div class="table-responsive" style="max-height: 300px; overflow-y:auto;">
                    <table class="table table-sm stylish-table align-middle">

                        <thead>
                            <tr>
                                <th>Room</th>
                                <th>Dept</th>
                                <th>Cap</th>
                                <th>Invigilator</th>
                                <th>Edit</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($rooms as $r)
                                {{-- Normal Row --}}
                                <tr>
                                    <td>{{ $r->room_no }}</td>
                                    <td>{{ $r->department->name }}</td>
                                    <td>{{ $r->capacity }}</td>
                                    <td>{{ $r->invigilator ?? '-' }}</td>

                                    <td>
                                        <button class="btn btn-sm action-btn"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#editRoom{{ $r->id }}">
                                            <i class="bi bi-pencil text-primary"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{-- Inline Edit --}}
                                <tr id="editRoom{{ $r->id }}" class="collapse inline-edit-row">
                                    <td colspan="5">
                                        <form method="POST" action="{{ route('admin.rooms.update', $r) }}"
                                              class="row g-2 p-3 small">
                                            @csrf @method('PUT')

                                            <div class="col-md-3">
                                                <label class="small fw-bold">Room No</label>
                                                <input class="form-control form-control-sm" name="room_no" value="{{ $r->room_no }}">
                                            </div>

                                            <div class="col-md-3">
                                                <label class="small fw-bold">Capacity</label>
                                                <input class="form-control form-control-sm" type="number" name="capacity"
                                                        value="{{ $r->capacity }}">
                                            </div>

                                            <div class="col-md-3">
                                                <label class="small fw-bold">Invigilator</label>
                                                <input class="form-control form-control-sm" name="invigilator"
                                                        value="{{ $r->invigilator }}">
                                            </div>

                                            <div class="col-md-3 d-flex align-items-end gap-2">

                                                <button class="btn btn-primary btn-sm">Save</button>

                                                <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#editRoom{{ $r->id }}">
                                                    Cancel
                                                </button>

                                                {{-- DELETE --}}
                                                <form method="POST" action="{{ route('admin.rooms.destroy', $r) }}"
                                                      onsubmit="return confirm('Delete room?')">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </div>

                                        </form>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>



        {{-- =========================
            COLUMN 3: ADD STUDENTS
        ========================== --}}
        <div class="col-lg-4">
            <div class="card h-100">

                <h5 class="fw-bold mb-3"><i class="bi bi-person-plus text-primary me-1"></i> Add Student</h5>

                <form method="POST" action="{{ route('admin.students.store') }}">
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

    </div> {{-- END ROW --}}



    {{-- =========================
        STUDENTS TABLE
    ========================== --}}
    <div class="card section-block fade-in">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">Students</h4>

                <div class="d-flex align-items-center gap-3">
                    <span class="small text-muted">Total: {{ $students->total() }}</span>

                    <form action="{{ route('admin.generate.random') }}" method="POST">
                        @csrf
                        <button class="btn btn-warning btn-wow">
                            <i class="bi bi-shuffle me-1"></i> Generate Random Plan
                        </button>
                    </form>

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
                            <th width="70">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($students as $s)

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

                            <td>
                                <button class="btn btn-sm action-btn"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#editStudent{{ $s->id }}">
                                    <i class="bi bi-pencil text-primary"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- Inline Edit --}}
                        <tr id="editStudent{{ $s->id }}" class="collapse inline-edit-row">
                            <td colspan="7">
                                <form method="POST"
                                      action="{{ route('admin.students.update', $s) }}"
                                      class="row g-3 p-3 small">
                                    @csrf
                                    @method('PUT')

                                    <div class="col-md-3">
                                        <label class="small fw-bold">Name</label>
                                        <input name="name" value="{{ $s->name }}" class="form-control form-control-sm">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="small fw-bold">CMD ID</label>
                                        <input name="cmd_id" value="{{ $s->cmd_id }}" class="form-control form-control-sm">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="small fw-bold">Department</label>
                                        <select name="department_id" class="form-select form-select-sm">
                                            @foreach ($departments as $d)
                                                <option value="{{ $d->id }}" @selected($s->department_id == $d->id)>
                                                    {{ $d->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-1">
                                        <label class="small fw-bold">Sem</label>
                                        <input type="number" name="semester" min="1" max="8"
                                               class="form-control form-control-sm"
                                               value="{{ $s->semester }}">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="small fw-bold">Room</label>
                                        <select name="room_id" class="form-select form-select-sm">
                                            <option value="">None</option>
                                            @foreach ($rooms as $r)
                                                <option value="{{ $r->id }}" @selected($s->room_id == $r->id)>
                                                    {{ $r->room_no }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2 d-flex align-items-end gap-2">

                                        <button class="btn btn-primary btn-sm">Save</button>

                                        <button type="button" class="btn btn-secondary btn-sm"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#editStudent{{ $s->id }}">
                                            Cancel
                                        </button>

                                        {{-- DELETE --}}
                                        <form method="POST"
                                              action="{{ route('admin.students.destroy', $s) }}"
                                              onsubmit="return confirm('Delete student?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>

                                    </div>

                                </form>
                            </td>
                        </tr>

                        @endforeach

                    </tbody>

                </table>
            </div>

            <div class="mt-4">
                {{ $students->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
