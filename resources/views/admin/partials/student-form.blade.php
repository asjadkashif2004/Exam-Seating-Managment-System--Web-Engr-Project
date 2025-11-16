@php 
  $val = fn($k,$d='') => old($k, $student->$k ?? $d);
@endphp

@push('head')
<style>

/* FORM CONTAINER */
.student-form-box {
    padding: 24px;
    background: rgba(255,255,255,0.78);
    backdrop-filter: blur(12px);
    border-radius: 18px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.08);
    animation: fadeSlide .45s ease;
    transition: .25s ease;
}
.student-form-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 38px rgba(0,0,0,0.12);
}

/* LABEL */
.form-label {
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 6px;
    font-size: 14px;
}

/* INPUTS */
.form-control, .form-select {
    height: 48px;
    border-radius: 12px;
    border: 1px solid #d4dbe6;
    padding-left: 14px;
    transition: .25s ease;
    background: #ffffffcc;
}
.form-control:focus, .form-select:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 4px rgba(59,130,246,.25);
}

/* HOVER EFFECT */
.form-control:hover,
.form-select:hover {
    border-color: #93c5fd;
}

/* ANIMATION */
@keyframes fadeSlide {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
}

</style>
@endpush



<div class="student-form-box">

    <div class="row g-3">

        {{-- NAME --}}
        <div class="col-md-6">
            <label class="form-label">Student Name</label>
            <input name="name"
                   value="{{ $val('name') }}"
                   class="form-control"
                   placeholder="Enter full name"
                   required>
        </div>

        {{-- CMD ID --}}
        <div class="col-md-6">
            <label class="form-label">CMD ID / Roll No.</label>
            <input name="cmd_id"
                   value="{{ $val('cmd_id') }}"
                   class="form-control"
                   placeholder="e.g., CMD12345"
                   required>
        </div>

        {{-- DEPARTMENT --}}
        <div class="col-md-6">
            <label class="form-label">Department</label>
            <select name="department_id" class="form-select" required>
                <option value="">Select Department</option>
                @foreach($departments as $d)
                    <option value="{{ $d->id }}" @selected($val('department_id')==$d->id)>
                        {{ $d->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- SEMESTER --}}
        <div class="col-md-3">
            <label class="form-label">Semester</label>
            <input type="number"
                   min="1" max="8"
                   name="semester"
                   value="{{ $val('semester',1) }}"
                   class="form-control"
                   required>
        </div>

        {{-- ROOM --}}
        <div class="col-md-3">
            <label class="form-label">Room</label>
            <select name="room_id" class="form-select">
                <option value="">Not Assigned</option>
                @foreach($rooms as $r)
                    <option value="{{ $r->id }}" @selected($val('room_id')==$r->id)>
                        {{ $r->room_no ?? $r->number }}
                    </option>
                @endforeach
            </select>
        </div>

    </div>

</div>
