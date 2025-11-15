@extends('layouts.app')

@section('title', 'Admin Dashboard')

@push('head')
<style>
  .page-title{font-weight:800;letter-spacing:-.02em;color:#0f172a}
  .card{border:1px solid #eef2f7;box-shadow:0 6px 18px rgba(16,24,40,.04)}
  .badge-soft{background:#eef7ff;color:#0b5ed7;border:1px solid #e1efff;font-weight:600}
  .table thead th{background:#f8fbff;font-weight:700;border-bottom:1px solid #e9eef5}
  .btn-wow{transition:transform .15s ease, box-shadow .15s ease}
  .btn-wow:hover{transform:translateY(-1px);box-shadow:0 10px 20px rgba(0,0,0,.06)}
  .form-mini .form-control,.form-mini .form-select{height:42px}
</style>
@endpush

@section('content')
<div class="container py-4">
  {{-- Header --}}
  <div class="d-flex align-items-center justify-content-between mb-3">
    <div>
      <h1 class="page-title mb-1">Admin Dashboard</h1>
      <div class="small text-muted">Manage Departments, Rooms, and Students from one place.</div>
    </div>
    <span class="badge badge-soft rounded-pill">Role: Admin</span>
  </div>

  {{-- Flash --}}
  @if (session('ok'))
    <div class="alert alert-success">{{ session('ok') }}</div>
  @endif
  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <div class="row g-4">
    {{-- Quick Create: Department --}}
    <div class="col-lg-4">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="mb-3">Add Department</h5>
          <form class="form-mini" method="POST" action="{{ route('admin.departments.store') }}">
            @csrf
            <div class="mb-2">
              <input type="text" name="name" class="form-control" placeholder="e.g., Computer Science" required>
              @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
             <button class="btn btn-primary btn-wow">Add Department</button>
          </form>

          <hr class="my-3">
          <div class="small text-muted mb-2">Departments</div>
          <ul class="list-group">
            @forelse($departments as $dept)
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $dept->name }} <span class="text-muted">({{ $dept->code }})</span>
                <form method="POST" action="{{ route('admin.departments.destroy', $dept) }}"
                      onsubmit="return confirm('Delete department?')">
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
    </div>

    {{-- Quick Create: Room --}}
    <div class="col-lg-4">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="mb-3">Add Room</h5>
          <form class="form-mini" method="POST" action="{{ route('admin.rooms.store') }}">
            @csrf
            <div class="mb-2">
              <select name="department_id" class="form-select" required>
                <option value="" hidden>Department</option>
                @foreach($departments as $d)
                  <option value="{{ $d->id }}">{{ $d->name }}</option>
                @endforeach
              </select>
              @error('department_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-2">
              <input type="text" name="room_no" class="form-control" placeholder="Room No (e.g., A-101)" required>
              @error('room_no') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-2">
              <input type="number" name="capacity" class="form-control" placeholder="Capacity" min="1" required>
              @error('capacity') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-2">
              <input type="text" name="invigilator" class="form-control" placeholder="Invigilator (optional)">
              @error('invigilator') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <button class="btn btn-primary btn-wow">Add Room</button>
          </form>

          <hr class="my-3">
          <div class="small text-muted mb-2">Rooms</div>
          <ul class="list-group">
            @forelse($rooms as $room)
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                  {{ $room->room_no }}
                  <span class="text-muted">· cap {{ $room->capacity }}</span>
                  @if($room->invigilator) <span class="text-muted">· {{ $room->invigilator }}</span> @endif
                </span>
                <div class="d-flex gap-1 flex-wrap">
                  {{-- Inline edit --}}
                  <form method="POST" action="{{ route('admin.rooms.update', $room) }}" class="d-flex gap-1 flex-wrap">
                    @csrf @method('PUT')
                    <select name="department_id" class="form-select form-select-sm" style="width:140px">
                      @foreach($departments as $d)
                        <option value="{{ $d->id }}" @selected($room->department_id == $d->id)>{{ $d->name }}</option>
                      @endforeach
                    </select>
                    <input type="text"   name="room_no"     value="{{ $room->room_no }}" class="form-control form-control-sm" style="width:110px">
                    <input type="number" name="capacity"    value="{{ $room->capacity }}" class="form-control form-control-sm" style="width:90px">
                    <input type="text"   name="invigilator" value="{{ $room->invigilator }}" class="form-control form-control-sm" style="width:130px">
                    <button class="btn btn-sm btn-outline-secondary">Save</button>
                  </form>
                  <form method="POST" action="{{ route('admin.rooms.destroy', $room) }}"
                        onsubmit="return confirm('Delete room?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                  </form>
                </div>
              </li>
            @empty
              <li class="list-group-item">No rooms yet.</li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>

    {{-- Students: Create --}}
    <div class="col-lg-4">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="mb-3">Add Student</h5>
          <form class="form-mini" method="POST" action="{{ route('admin.students.store') }}">
            @csrf
            <div class="mb-2">
              <input name="name" class="form-control" placeholder="Student name" required>
              @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-2">
              <input name="cmd_id" class="form-control" placeholder="CMD ID / Roll No." required>
              @error('cmd_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-2">
              <select name="department_id" class="form-select" required>
                <option value="" hidden>Department</option>
                @foreach($departments as $d)
                  <option value="{{ $d->id }}">{{ $d->name }}</option>
                @endforeach
              </select>
              @error('department_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-2">
              <input name="semester" type="number" min="1" max="8" class="form-control" placeholder="Semester" required>
              @error('semester') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-2">
              <select name="room_id" class="form-select">
                <option value="">Room (optional)</option>
                @foreach($rooms as $r)
                  <option value="{{ $r->id }}">{{ $r->room_no }} (cap {{ $r->capacity }})</option>
                @endforeach
              </select>
              @error('room_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <button class="btn btn-primary btn-wow w-100">Create Student</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Students table --}}
  <div class="card mt-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="mb-0">Students</h5>
        <span class="text-muted small">Latest first</span>
      </div>
      <div class="table-responsive">
        <table class="table align-middle">
          <thead>
            <tr>
              <th>Name</th>
              <th>CMD ID</th>
              <th>Department</th>
              <th>Semester</th>
              <th>Room</th>
              <th>Invigilator</th>
              <th style="width:200px">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($students as $s)
              <tr>
                <td>{{ $s->name }}</td>
                <td>{{ $s->cmd_id }}</td>
                <td>{{ $s->department?->name ?? '-' }}</td>
                <td>{{ $s->semester }}</td>
                <td>{{ $s->room?->room_no ?? '-' }}</td>
                <td>{{ $s->room?->invigilator ?? '-' }}</td>
                <td>
                  <div class="d-flex gap-2">
                    {{-- Inline update --}}
                    <form method="POST" action="{{ route('admin.students.update', $s) }}" class="d-flex flex-wrap gap-1">
                      @csrf @method('PUT')
                      <input name="name" value="{{ $s->name }}" class="form-control form-control-sm" style="width:120px">
                      <input name="cmd_id" value="{{ $s->cmd_id }}" class="form-control form-control-sm" style="width:100px">
                      <select name="department_id" class="form-select form-select-sm" style="width:140px">
                        @foreach($departments as $d)
                          <option value="{{ $d->id }}" @selected($s->department_id == $d->id)>{{ $d->name }}</option>
                        @endforeach
                      </select>
                      <input name="semester" type="number" min="1" max="8" value="{{ $s->semester }}" class="form-control form-control-sm" style="width:90px">
                      <select name="room_id" class="form-select form-select-sm" style="width:120px">
                        <option value="">-</option>
                        @foreach($rooms as $r)
                          <option value="{{ $r->id }}" @selected($s->room_id == $r->id)>{{ $r->room_no }}</option>
                        @endforeach
                      </select>
                      <button class="btn btn-sm btn-outline-secondary">Save</button>
                    </form>

                    <form method="POST" action="{{ route('admin.students.destroy', $s) }}"
                          onsubmit="return confirm('Delete this student?')">
                      @csrf @method('DELETE')
                      <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr><td colspan="7" class="text-center text-muted">No students found.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-2">
        {{ $students->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
