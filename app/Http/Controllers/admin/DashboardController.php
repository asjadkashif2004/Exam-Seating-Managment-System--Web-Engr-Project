<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Department;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'departments' => Department::orderBy('name')->get(),
            'rooms'       => Room::with('department')->orderBy('room_no')->get(),
            'students'    => Student::with(['department','room'])->latest()->paginate(10),
        ]);
    }

    // =======================================================
    //  EXPORT CURRENT PLAN (No random)
    // =======================================================
    public function exportPlanPdf()
    {
        $students = Student::with(['department', 'room'])
                    ->orderBy('created_at', 'asc')
                    ->get();

        $pdf = Pdf::loadView('admin.export.plan_pdf', compact('students'))
                  ->setPaper('A4', 'landscape');

        return $pdf->download('Exam_Seating_Plan.pdf');
    }

    // =======================================================
    //  GENERATE RANDOM PLAN (Shuffle Students)
    // =======================================================
    
public function generateRandomPlan()
{
    // Get all students in REAL random order
    $students = Student::inRandomOrder()->get();

    // Get all rooms with their capacities
    $rooms = Room::withCount('students')->get();

    // Clear all previous room assignments
    Student::query()->update(['room_id' => null]);

    foreach ($rooms as $room) {
        $capacity = $room->capacity;

        // Take "capacity" number of students from random list
        $assigned = $students->splice(0, $capacity);

        foreach ($assigned as $s) {
            $s->room_id = $room->id;
            $s->save();
        }
    }

    return back()->with('ok', 'Random seating plan generated successfully!');
}


    // =======================================================
    // STUDENTS CRUD
    // =======================================================
    public function studentsStore(Request $request)
    {
        $data = $request->validate([
            'name'          => ['required','string','max:120'],
            'cmd_id'        => ['required','string','max:50','unique:students,cmd_id'],
            'department_id' => ['required','exists:departments,id'],
            'semester'      => ['required','integer','between:1,8'],
            'room_id'       => ['nullable','exists:rooms,id'],
        ]);

        if (!empty($data['room_id'])) {
            $room = Room::withCount('students')->find($data['room_id']);

            if ($room->students_count >= $room->capacity) {
                return back()->with('error', "Room {$room->room_no} is full.");
            }
        }

        Student::create($data);
        return back()->with('ok','Student added.');
    }

    public function studentsUpdate(Request $request, Student $student)
    {
        $data = $request->validate([
            'name'          => ['required','string','max:120'],
            'cmd_id'        => ['required','string','max:50', Rule::unique('students','cmd_id')->ignore($student->id)],
            'department_id' => ['required','exists:departments,id'],
            'semester'      => ['required','integer','between:1,8'],
            'room_id'       => ['nullable','exists:rooms,id'],
        ]);

        if (!empty($data['room_id']) && $data['room_id'] != $student->room_id) {
            $room = Room::withCount('students')->find($data['room_id']);

            if ($room->students_count >= $room->capacity) {
                return back()->with('error', "Room {$room->room_no} is full.");
            }
        }

        $student->update($data);
        return back()->with('ok','Student updated.');
    }

    public function studentsDestroy(Student $student)
    {
        $student->delete();
        return back()->with('ok','Student deleted.');
    }

    // =======================================================
    // DEPARTMENTS
    // =======================================================
    public function departmentsStore(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','max:120','unique:departments,name'],
        ]);

        Department::create($data);
        return back()->with('ok','Department added.');
    }

    public function departmentsDestroy(Department $department)
    {
        $department->delete();
        return back()->with('ok','Department deleted.');
    }


    // =======================================================
    // ROOMS
    // =======================================================
    public function roomsStore(Request $request)
    {
        $data = $request->validate([
            'department_id' => ['required','exists:departments,id'],
            'room_no'       => ['required','max:50'],
            'capacity'      => ['required','integer','min:1'],
            'invigilator'   => ['nullable','string','max:120'],
        ]);

        Room::create($data);
        return back()->with('ok','Room added.');
    }

    public function roomsUpdate(Request $request, Room $room)
    {
        $data = $request->validate([
            'department_id' => ['required','exists:departments,id'],
            'room_no'       => ['required','max:50'],
            'capacity'      => ['required','integer','min:1'],
            'invigilator'   => ['nullable','string','max:120'],
        ]);

        $room->update($data);
        return back()->with('ok','Room updated.');
    }

    public function roomsDestroy(Room $room)
    {
        $room->delete();
        return back()->with('ok','Room deleted.');
    }
}
