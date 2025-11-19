@extends('layouts.app')

@section('title', 'Room Seating View')

@push('head')
<style>

    body {
        background: #f1f5f9;
    }

    .room-header {
        background: #ffffff;
        padding: 20px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 6px 18px rgba(0,0,0,0.05);
        margin-bottom: 25px;
    }

    .room-title {
        font-size: 1.6rem;
        font-weight: 800;
        color: #1e293b;
    }

    .room-sub {
        font-size: .9rem;
        color: #64748b;
    }

    .seating-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 18px;
    }

    .seat-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 15px 18px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        transition: .25s ease;
    }

    .seat-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 24px rgba(0,0,0,0.12);
        border-color: #2563eb;
    }

    .roll-text {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0f172a;
    }

    .student-name {
        font-size: .9rem;
        color: #334155;
        margin-top: 4px;
    }

    .dept-badge {
        display: inline-block;
        padding: 3px 10px;
        font-size: .75rem;
        border-radius: 8px;
        margin-top: 10px;
        font-weight: 600;
    }

    /* Department Colors */
    .dept-CS  { background: #dbeafe; color: #1e40af; }
    .dept-CE  { background: #dcfce7; color: #166534; }
    .dept-EE  { background: #fef3c7; color: #92400e; }
    .dept-BBA { background: #fee2e2; color: #b91c1c; }

    .empty-box {
        opacity: .45;
        text-align: center;
        color: #64748b;
        font-size: .85rem;
        font-weight: 600;
        padding-top: 10px;
    }

</style>
@endpush

@section('content')

<div class="container">

    {{-- Header --}}
    <div class="room-header">
        <div class="room-title">
            Room: {{ $room->room_no ?? 'Room' }}
        </div>
        <div class="room-sub">
            Total Rows: {{ $room->rows }} |
            Total Columns: {{ $room->cols }} |
            Capacity: {{ $room->rows * $room->cols }}
        </div>
    </div>

    {{-- Seating Grid --}}
    <div class="seating-grid">

        @for ($r = 1; $r <= $room->rows; $r++)
            @for ($c = 1; $c <= $room->cols; $c++)

                  @php
                    $seat = $seats->firstWhere('seat_row', $r)
                                   ?->firstWhere('seat_col', $c);
                @endphp

                @if ($seat && $seat->student)

                    @php
                        $dept = strtoupper($seat->student->department->name);
                        $deptClass = "dept-" . $dept;
                    @endphp

                    <div class="seat-box">
                        <div class="roll-text">{{ $seat->student->cmd_id }}</div>
                        <div class="student-name">{{ $seat->student->name }}</div>

                        <div class="dept-badge {{ $deptClass }}">
                            {{ $dept }}
                        </div>

                        <div class="mt-2" style="font-size: .75rem; color:#64748b;">
                            Row {{ $r }} — Col {{ $c }}
                        </div>
                    </div>

                @else
                    <div class="seat-box empty-box">
                        EMPTY <br>
                        Row {{ $r }} — Col {{ $c }}
                    </div>
                @endif

            @endfor
        @endfor

    </div>

</div>

@endsection
