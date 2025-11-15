@extends('layouts.app')

@section('title', 'Staff Dashboard')

@section('content')

<div class="container py-4">

    <h3 class="mb-3">Welcome to Faulty Section Portal</h3>

    
    {{-- ALL STAFF + THEIR ROOMS --}}
    <div class="card">
        <div class="card-body">
            <h5>All Invigilators & Rooms</h5>
            <p class="text-muted">Complete list of staff invigilators assigned by admin.</p>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Staff Name</th>
                        <th>Total Rooms</th>
                        <th>Room Numbers</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($staffRooms as $staffName => $rooms)
                    <tr>
                        <td>{{ $staffName }}</td>
                        <td><strong>{{ $rooms->count() }}</strong></td>
                        <td>
                            @foreach($rooms as $room)
                                <span class="badge bg-info text-dark">{{ $room->room_no }}</span>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
