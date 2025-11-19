@extends('layouts.app')

@section('title', 'Admin Dashboard')

@push('head')
<style>

body {
    background: linear-gradient(to bottom right, #e8eefc, #f9fbff);
}

.page-title {
    font-weight: 800;
    letter-spacing: -0.03em;
    font-size: 32px;
    color: #0f172a;
}

.section-block {
    margin-top: 35px;
}

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

.form-control, .form-select {
    height: 44px;
    border-radius: 10px;
}

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

.inline-edit-row {
    background: #f3f7ff !important;
    border-left: 4px solid #3b82f6;
}

/* ---------------------------------------
   FIXED HEIGHT TABLE WRAPPER
---------------------------------------- */
.student-table-wrapper {
    max-height: 480px;
    overflow-y: auto;
    border-radius: 12px;
    background: rgba(255,255,255,0.45);
    backdrop-filter: blur(6px);
    box-shadow: inset 0 0 10px rgba(0,0,0,0.05);
}

.student-table-wrapper thead th {
    position: sticky;
    top: 0;
    z-index: 5;
    background: #e6edff;
}

/* Scrollbar */
.student-table-wrapper::-webkit-scrollbar {
    width: 8px;
}
.student-table-wrapper::-webkit-scrollbar-thumb {
    background: #b7c4ff;
    border-radius: 6px;
}

/* ---------------------------------------
   SIMPLE PAGINATION (Option A)
---------------------------------------- */

/* SIMPLE PAGINATION (No Icons) */
.simple-pagination {
    display: flex;
    gap: 10px;
    justify-content: center;
    margin-top: 20px;
}

.simple-pagination a,
.simple-pagination span {
    padding: 8px 16px;
    border: 1px solid #cbd5e1;
    background: white;
    color: #1e3a8a;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
}

.simple-pagination a:hover {
    background: #eef3ff;
}

.simple-pagination .disabled {
    opacity: 0.45;
    cursor: not-allowed;
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

        {{-- ======================================
            COLUMN 1: DEPARTMENTS
        ======================================= --}}
        <div class="col-lg-4">
            <div class="card h-100">

                <h5 class="fw-bold mb-3">Departments</h5>

                <form method="POST" action="{{ route('admin.departments.store') }}">
                    @csrf
                    <input class="form-control mb-2" name="name" placeholder="Department Name" required>
                    <button class="btn btn-primary btn-wow w-100">Add Department</button>
                </form>

                <hr>

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
                        <li class="list-group-item">No departments yet.</li>
                    @endforelse
                </ul>

            </div>
        </div>

        {{-- ======================================
            COLUMN 2: ROOMS
        ======================================= --}}
        <div class="col-lg-4">
            <div class="card h-100">

                <h5 class="fw-bold mb-3">Rooms</h5>

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

                <div class="table-responsive" style="max-height:300px; overflow-y:auto;">
                    <table class="table stylish-table table-sm align-middle">
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
                                <tr>
                                    <td>{{ $r->room_no }}</td>
                                    <td>{{ $r->department->name }}</td>
                                    <td>{{ $r->capacity }}</td>
                                    <td>{{ $r->invigilator ?? '-' }}</td>

                                    <td>
                                        <button class="btn btn-sm action-btn"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#editRoom{{ $r->id }}">
                                            Edit
                                        </button>
                                    </td>
                                </tr>

                                <tr id="editRoom{{ $r->id }}" class="collapse inline-edit-row">
                                    <td colspan="6">
                                        <form method="POST" action="{{ route('admin.rooms.update', $r) }}"
                                              class="row g-2 p-3 small">
                                            @csrf
                                            @method('PUT')

                                            <div class="col-md-3">
                                                <label class="small fw-bold">Department</label>
                                                <select name="department_id" class="form-select form-select-sm">
                                                    @foreach ($departments as $d)
                                                        <option value="{{ $d->id }}" @selected($r->department_id == $d->id)>
                                                            {{ $d->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="small fw-bold">Room No</label>
                                                <input class="form-control form-control-sm"
                                                       name="room_no"
                                                       value="{{ $r->room_no }}">
                                            </div>

                                            <div class="col-md-2">
                                                <label class="small fw-bold">Capacity</label>
                                                <input class="form-control form-control-sm"
                                                       type="number"
                                                       name="capacity"
                                                       value="{{ $r->capacity }}">
                                            </div>

                                            <div class="col-md-3">
                                                <label class="small fw-bold">Invigilator</label>
                                                <input class="form-control form-control-sm"
                                                       name="invigilator"
                                                       value="{{ $r->invigilator }}">
                                            </div>

                                            <div class="col-md-2 d-flex align-items-end gap-2">
                                                <button class="btn btn-primary btn-sm">Save</button>

                                                <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#editRoom{{ $r->id }}">
                                                    Cancel
                                                </button>

                                                <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="if(confirm('Delete room?')) document.getElementById('delete-room-{{ $r->id }}').submit();">
                                                    Delete
                                                </button>
                                            </div>
                                        </form>

                                        <form id="delete-room-{{ $r->id }}" method="POST"
                                              action="{{ route('admin.rooms.destroy', $r) }}" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        {{-- ======================================
            COLUMN 3: ADD STUDENTS
        ======================================= --}}
        <div class="col-lg-4">
            <div class="card h-100">

                <h5 class="fw-bold mb-3">Add Student</h5>

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

                    <select class="form-select mb-2 room-select" name="room_id">
                        <option value="">Room</option>
                        @foreach ($rooms as $r)
                            <option value="{{ $r->id }}">{{ $r->room_no }}</option>
                        @endforeach
                    </select>

                    {{-- DYNAMIC SEAT DROPDOWN --}}
                    <select class="form-select mb-2 seat-select" name="seat_no">
                        <option value="">Seat No</option>
                    </select>

                    <button class="btn btn-primary btn-wow w-100">Add Student</button>
                </form>

            </div>
        </div>

    </div>



    {{-- ======================================
        STUDENTS TABLE
    ======================================= --}}
    <div class="card section-block">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">Students</h4>

                <div class="d-flex align-items-center gap-3">
                    <span class="small text-muted">Total: {{ $students->total() }}</span>

                    <form action="{{ route('admin.generate.random') }}" method="POST">
                        @csrf
                        <button class="btn btn-warning btn-wow">
                            Generate Random Plan
                        </button>
                    </form>

                    <a href="{{ route('admin.export.pdf') }}" class="btn btn-danger btn-wow">
                        Export Seating Plan PDF
                    </a>
                </div>
            </div>

            {{-- FIXED HEIGHT WRAPPER --}}
            <div class="student-table-wrapper table-responsive">
                <table class="table stylish-table align-middle">

                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>CMD</th>
                            <th>Dept</th>
                            <th>Sem</th>
                            <th>Room</th>
                            <th>Seat</th>
                            <th>Inv.</th>
                            <th width="70">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($students as $s)

                        @php
                            $takenSeats = \App\Models\Student::where('room_id', $s->room_id)->pluck('seat_no')->toArray();
                            $capacity = $s->room?->capacity ?? 0;
                        @endphp

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
                            <td>{{ $s->seat_no ?? '-' }}</td>
                            <td>{{ $s->room->invigilator ?? '-' }}</td>

                            <td>
                                <button class="btn btn-sm action-btn"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#editStudent{{ $s->id }}">
                                    Edit
                                </button>
                            </td>
                        </tr>


                        {{-- EDIT STUDENT FORM --}}
                        <tr id="editStudent{{ $s->id }}" class="collapse inline-edit-row">
                            <td colspan="8">

                                <form method="POST" action="{{ route('admin.students.update', $s) }}"
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
                                        <select class="form-select form-select-sm room-select-edit"
                                                data-student="{{ $s->id }}"
                                                name="room_id">

                                            <option value="">None</option>

                                            @foreach ($rooms as $r)
                                                <option value="{{ $r->id }}" @selected($s->room_id == $r->id)>
                                                    {{ $r->room_no }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-1">
                                        <label class="small fw-bold">Seat</label>

                                        <select name="seat_no"
                                                id="seatSelect{{ $s->id }}"
                                                class="form-select form-select-sm">

                                            <option value="">Seat</option>

                                            @if ($s->room)
                                                @for ($i = 1; $i <= $capacity; $i++)
                                                    <option value="{{ $i }}"
                                                        @if($i == $s->seat_no) selected
                                                        @elseif(in_array($i, $takenSeats)) disabled
                                                        @endif>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            @endif

                                        </select>

                                    </div>

                                    <div class="col-md-2 d-flex align-items-end gap-2">
                                        <button class="btn btn-primary btn-sm">Save</button>

                                        <button type="button" class="btn btn-secondary btn-sm"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#editStudent{{ $s->id }}">
                                            Cancel
                                        </button>
                                    </div>
                                </form>

                                <form method="POST" action="{{ route('admin.students.destroy', $s) }}"
                                      onsubmit="return confirm('Delete student?')" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete Student</button>
                                </form>

                            </td>
                        </tr>

                        @endforeach
                    </tbody>

                </table>
            </div>

            {{-- PAGINATION --}}
           
<div class="simple-pagination">

    {{-- Previous --}}
    @if ($students->onFirstPage())
        <span class="disabled">Previous</span>
    @else
        <a href="{{ $students->previousPageUrl() }}">Previous</a>
    @endif

    {{-- Next --}}
    @if ($students->hasMorePages())
        <a href="{{ $students->nextPageUrl() }}">Next</a>
    @else
        <span class="disabled">Next</span>
    @endif

</div>


        </div>
    </div>

</div>

{{-- SEAT LOGIC JS --}}
<script>

const rooms = @json($rooms);
const seatsTaken = @json(
    \App\Models\Student::select('room_id','seat_no')->get()
);

function getTakenSeats(roomId) {
    return seatsTaken
        .filter(s => s.room_id == roomId)
        .map(s => Number(s.seat_no));
}

document.querySelectorAll('.room-select').forEach(select => {
    select.addEventListener('change', function() {

        const roomId = this.value;
        const seatDropdown = this.parentElement.querySelector('.seat-select');

        seatDropdown.innerHTML = `<option value="">Seat No</option>`;

        if (!roomId) return;

        const room = rooms.find(r => r.id == roomId);
        const taken = getTakenSeats(roomId);

        for (let i = 1; i <= room.capacity; i++) {
            seatDropdown.innerHTML +=
                `<option value="${i}" ${taken.includes(i) ? 'disabled' : ''}>${i}</option>`;
        }
    });
});


document.querySelectorAll('.room-select-edit').forEach(select => {

    select.addEventListener('change', function() {

        const studentId = this.dataset.student;
        const roomId = this.value;

        const seatDropdown = document.querySelector(`#seatSelect${studentId}`);
        seatDropdown.innerHTML = `<option value="">Seat</option>`;

        if (!roomId) return;

        const room = rooms.find(r => r.id == roomId);
        const taken = getTakenSeats(roomId);

        for (let i = 1; i <= room.capacity; i++) {
            seatDropdown.innerHTML +=
                `<option value="${i}" ${taken.includes(i) ? 'disabled' : ''}>${i}</option>`;
        }
    });
});

</script>

@endsection
