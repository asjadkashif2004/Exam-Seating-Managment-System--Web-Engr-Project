<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 12px;
            color: #1a1a1a;
        }

        h1 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 5px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        h4 {
            text-align: center;
            margin-top: 0;
            margin-bottom: 15px;
            font-weight: normal;
            color: #444;
        }

        .meta {
            text-align: center;
            font-size: 12px;
            color: #555;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        thead th {
            background: #e8ecf7;
            color: #0d1b3f;
            padding: 8px;
            border: 1px solid #b5c1d9;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px;
        }

        tbody td {
            padding: 7px;
            border: 1px solid #c3cce0;
        }

        tbody tr:nth-child(even) {
            background: #f9faff;
        }

        .room-header {
            background: #dfe6fb;
            font-weight: bold;
            text-align: left;
            padding: 8px;
            margin-top: 20px;
            border: 1px solid #b5c1d9;
            page-break-inside: avoid;
        }

        .footer-note {
            margin-top: 25px;
            text-align: center;
            font-size: 11px;
            color: #777;
        }
    </style>
</head>

<body>

<h1>Exam Seating Plan</h1>
<h4>End Semester Examination – ESE System</h4>

<div class="meta">
    Generated on <strong>{{ date('d M Y, h:i A') }}</strong>
</div>

@php
    // Group students room-wise
    $byRoom = $students->groupBy('room_id');
@endphp

@foreach ($byRoom as $roomId => $group)

    {{-- ROOM HEADER --}}
    <div class="room-header">
        Room: <strong>{{ $group->first()->room->room_no ?? 'Unassigned' }}</strong> &nbsp;&nbsp; |
        Invigilator: <strong>{{ $group->first()->room->invigilator ?? 'N/A' }}</strong> &nbsp;&nbsp; |
        Total Students: <strong>{{ $group->count() }}</strong>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 22%;">Student Name</th>
                <th style="width: 12%;">CMD</th>
                <th style="width: 18%;">Department</th>
                <th style="width: 10%;">Sem</th>
                <th style="width: 10%;">Seat No</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($group as $s)
            <tr>
                <td>{{ $s->name }}</td>
                <td>{{ $s->cmd_id }}</td>
                <td>{{ $s->department->name ?? '-' }}</td>
                <td>{{ $s->semester }}</td>
                <td><strong>{{ $s->seat_no ?? '-' }}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endforeach

<div class="footer-note">
    This seating plan is system-generated and does not require a manual signature. Developed by Asjad And Umar.
</div>

</body>
</html>
