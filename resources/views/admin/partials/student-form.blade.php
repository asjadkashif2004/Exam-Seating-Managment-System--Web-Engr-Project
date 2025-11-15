@php 
  $val = fn($k,$d='') => old($k, $student->$k ?? $d);
@endphp

<style>
  .form-label {
      font-weight: 600;
      color: #1e293b;
      margin-bottom: 6px;
  }
  .form-control, .form-select {
      height: 48px;
      border-radius: 10px;
      border: 1px solid #e2e8f0;
      transition: 0.2s;
      background: #ffffff;
  }
  .form-control:focus,
  .form-select:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px #93c5fd66;
  }
  .form-box {
      padding: 18px;
      background: #ffffffcc;
      backdrop-filter: blur(10px);
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.06);
      transition: all .25s ease;
  }
  .form-box:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 28px rgba(0,0,0,0.1);
  }
</style>

<div class="form-box mt-3">

    <div class="row g-3">

        {{-- Name --}}
        <div class="col-md-6">
            <label class="form-label">Student Name</label>
            <input name="name" 
                   class="form-control" 
                   value="{{ $val('name') }}" 
                   placeholder="Enter full name" 
                   required>
        </div>

        {{-- CMD ID --}}
        <div class="col-md-6">
            <label class="form-label">CMD ID / Roll No.</label>
            <input name="cmd_id" 
                   class="form-control" 
                   value="{{ $val('cmd_id') }}" 
                   placeholder="e.g. CMD12345"
                   required>
        </div>

        {{-- Department --}}
        <div class="col-md-6">
            <label class="form-label">Department</label>
            <select name="department_id" class="form-select" required>
                <option value="">Select a Department</option>
                @foreach($departments as $d)
                  <option value="{{ $d->id }}" 
                          @selected($val('department_id')==$d->id)>
                      {{ $d->name }}
                  </option>
                @endforeach
            </select>
        </div>

        {{-- Semester --}}
        <div class="col-md-3">
            <label class="form-label">Semester</label>
            <input type="number" 
                   min="1" 
                   max="8" 
                   name="semester" 
                   class="form-control" 
                   value="{{ $val('semester',1) }}" 
                   required>
        </div>

        {{-- Room --}}
        <div class="col-md-3">
            <label class="form-label">Room</label>
            <select name="room_id" class="form-select">
                <option value="">Not Assigned</option>
                @foreach($rooms as $r)
                  <option value="{{ $r->id }}" 
                          @selected($val('room_id')==$r->id)>
                      {{ $r->number }}
                  </option>
                @endforeach
            </select>
        </div>

    </div>

</div>
