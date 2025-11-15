@extends('layouts.app')

@section('title', 'Student Directory')

@section('content')
<div class="container py-4">

    <h2 class="mb-3">Student Directory</h2>

    <form method="GET" action="{{ route('student.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by CMD..." value="{{ $search }}">
            <button class="btn btn-primary">Search</button>
        </div>
    </form>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>CMD</th>
                        <th>Department</th>
                        <th>Semester</th>
                        <th>Room</th>
                        <th>Invigilator</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $s)
                        <tr>
                            <td>{{ $s->name }}</td>
                            <td>{{ $s->cmd_id }}</td>
                            <td>{{ $s->department->name ?? '-' }}</td>
                            <td>{{ $s->semester }}</td>
                            <td>{{ $s->room->room_no ?? '-' }}</td>
                            <td>{{ $s->invigilator ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-3">No students found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
