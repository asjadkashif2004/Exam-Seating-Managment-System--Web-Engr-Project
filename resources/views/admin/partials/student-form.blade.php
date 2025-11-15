@php $val = fn($k,$d='') => old($k, $student->$k ?? $d); @endphp
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Name</label>
    <input name="name" class="form-control" value="{{ $val('name') }}" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">CMD ID</label>
    <input name="cmd_id" class="form-control" value="{{ $val('cmd_id') }}" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Department</label>
    <select name="department_id" class="form-select" required>
      <option value="">Choose…</option>
      @foreach($departments as $d)
        <option value="{{ $d->id }}" @selected($val('department_id')==$d->id)>{{ $d->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3">
    <label class="form-label">Semester</label>
    <input type="number" min="1" max="8" name="semester" class="form-control" value="{{ $val('semester',1) }}" required>
  </div>
  <div class="col-md-3">
    <label class="form-label">Room</label>
    <select name="room_id" class="form-select">
      <option value="">Unassigned</option>
      @foreach($rooms as $r)
        <option value="{{ $r->id }}" @selected($val('room_id')==$r->id)>{{ $r->number }}</option>
      @endforeach
    </select>
  </div>
</div>
