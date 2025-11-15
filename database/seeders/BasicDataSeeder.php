<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Room;
use App\Models\Student;

class BasicDataSeeder extends Seeder
{
    public function run(): void
    {
        // --- Departments ---
        $cs  = Department::firstOrCreate(['name' => 'Computer Science']);
        $ee  = Department::firstOrCreate(['name' => 'Electrical Engineering']);
        $me  = Department::firstOrCreate(['name' => 'Mechanical Engineering']);

        // --- Rooms (note: use room_no, not name) ---
        $rooms = [
            ['department_id' => $cs->id, 'room_no' => 'A101', 'capacity' => 30, 'invigilator' => 'Dr. Khan'],
            ['department_id' => $cs->id, 'room_no' => 'A102', 'capacity' => 28, 'invigilator' => 'Ms. Ali'],
            ['department_id' => $ee->id, 'room_no' => 'B201', 'capacity' => 25, 'invigilator' => 'Mr. Singh'],
            ['department_id' => $me->id, 'room_no' => 'C301', 'capacity' => 32, 'invigilator' => 'Dr. Patel'],
        ];

        foreach ($rooms as $r) {
            Room::firstOrCreate(
                ['room_no' => $r['room_no']],   // <-- key column is room_no
                $r
            );
        }

        // --- Students (optional sample data) ---
        $s = [
            ['name' => 'Ayesha Noor',  'cmd_id' => 'CMD001', 'department_id' => $cs->id, 'semester' => 3, 'room_no' => 'A101'],
            ['name' => 'Bilal Ahmed',  'cmd_id' => 'CMD002', 'department_id' => $cs->id, 'semester' => 5, 'room_no' => 'A102'],
            ['name' => 'Chirag Verma', 'cmd_id' => 'CMD003', 'department_id' => $ee->id, 'semester' => 2, 'room_no' => 'B201'],
            ['name' => 'Danish Khan',  'cmd_id' => 'CMD004', 'department_id' => $me->id, 'semester' => 4, 'room_no' => 'C301'],
        ];

        foreach ($s as $row) {
            $room = Room::where('room_no', $row['room_no'])->first();
            Student::firstOrCreate(
                ['cmd_id' => $row['cmd_id']],
                [
                    'name'          => $row['name'],
                    'department_id' => $row['department_id'],
                    'semester'      => $row['semester'],
                    'room_id'       => $room?->id,
                ]
            );
        }
    }
}
