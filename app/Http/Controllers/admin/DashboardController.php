<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Department;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    // Students
    public function studentsStore(Request $request)
    {
        $data = $request->validate([
            'name'          => ['required','string','max:120'],
            'cmd_id'        => ['required','string','max:50','unique:students,cmd_id'],
            'department_id' => ['required','exists:departments,id'],
            'semester'      => ['required','integer','between:1,8'],
            'room_id'       => ['nullable','exists:rooms,id'],
        ]);

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

        $student->update($data);
        return back()->with('ok','Student updated.');
    }

    public function studentsDestroy(Student $student)
    {
        $student->delete();
        return back()->with('ok','Student deleted.');
    }

    // Departments
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

    // Rooms
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
