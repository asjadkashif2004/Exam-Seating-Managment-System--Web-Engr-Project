<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table {
            width: 100%; border-collapse: collapse; margin-top: 20px;
        }
        th, td {
            border: 1px solid #999; padding: 6px; text-align: left;
        }
        th {
            background: #f0f0f0;
            font-weight: bold;
        }
        h2 { text-align: center; margin-bottom: -10px; }
    </style>
</head>
<body>

<h2>Exam Seating Plan – ESE System</h2>
<p style="text-align:center;">Generated on {{ date('d M Y') }}</p>

<table>
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
        @foreach($students as $s)
        <tr>
            <td>{{ $s->name }}</td>
            <td>{{ $s->cmd_id }}</td>
            <td>{{ $s->department->name ?? '-' }}</td>
            <td>{{ $s->semester }}</td>
            <td>{{ $s->room->room_no ?? '-' }}</td>
            <td>{{ $s->room->invigilator ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
