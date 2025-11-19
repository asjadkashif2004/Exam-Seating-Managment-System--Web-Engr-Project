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
    // EXPORT PDF
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
    // RANDOM PLAN
    // =======================================================
    public function generateRandomPlan()
    {
        $students = Student::inRandomOrder()->get();
        $groups = $students->groupBy('department_id')->values();

        $balanced = collect();
        $max = $groups->map(fn($g) => $g->count())->max();

        for ($i = 0; $i < $max; $i++) {
            foreach ($groups as $group) {
                if (isset($group[$i])) {
                    $balanced->push($group[$i]);
                }
            }
        }

        Student::query()->update([
            'room_id' => null,
            'seat_no' => null,
        ]);

        $rooms = Room::orderBy('room_no')->get();
        $index = 0;

        foreach ($rooms as $room) {
            $capacity = $room->capacity;

            for ($seat = 1; $seat <= $capacity; $seat++) {
                if (!isset($balanced[$index])) break;

                $student = $balanced[$index];
                $student->room_id = $room->id;
                $student->seat_no = $seat;
                $student->save();

                $index++;
            }
        }

        return back()->with('ok', 'Random seating plan generated successfully.');
    }

    // =======================================================
    // STUDENTS STORE
    // =======================================================
    public function studentsStore(Request $request)
    {
        $data = $request->validate([
            'name'          => ['required','string','max:120'],
            'cmd_id'        => ['required','string','max:50','unique:students,cmd_id'],
            'department_id' => ['required','exists:departments,id'],
            'semester'      => ['required','integer','between:1,8'],
            'room_id'       => ['nullable','exists:rooms,id'],
            'seat_no'       => ['nullable','integer','min:1'],
        ]);

        if (!empty($data['room_id']) && !empty($data['seat_no'])) {

            $room = Room::find($data['room_id']);

            if ($data['seat_no'] > $room->capacity) {
                return back()->with('error', "Seat exceeds capacity of room {$room->room_no}.");
            }

            $exists = Student::where('room_id', $data['room_id'])
                             ->where('seat_no', $data['seat_no'])
                             ->exists();

            if ($exists) {
                return back()->with('error', "Seat {$data['seat_no']} already taken in room {$room->room_no}.");
            }
        }

        Student::create($data);
        return back()->with('ok','Student added.');
    }

    // =======================================================
    // STUDENTS UPDATE
    // =======================================================
    public function studentsUpdate(Request $request, Student $student)
    {
        $data = $request->validate([
            'name'          => ['required','string','max:120'],
            'cmd_id'        => ['required','string','max:50', Rule::unique('students','cmd_id')->ignore($student->id)],
            'department_id' => ['required','exists:departments,id'],
            'semester'      => ['required','integer','between:1,8'],
            'room_id'       => ['nullable','exists:rooms,id'],
            'seat_no'       => ['nullable','integer','min:1'],
        ]);

        if (!empty($data['room_id']) && !empty($data['seat_no'])) {

            $room = Room::find($data['room_id']);

            if ($data['seat_no'] > $room->capacity) {
                return back()->with('error', "Seat exceeds room capacity of {$room->capacity}.");
            }

            $exists = Student::where('room_id', $data['room_id'])
                             ->where('seat_no', $data['seat_no'])
                             ->where('id','!=',$student->id)
                             ->exists();

            if ($exists) {
                return back()->with('error', "Seat {$data['seat_no']} already taken in room {$room->room_no}.");
            }
        }

        $student->update($data);
        return back()->with('ok','Student updated.');
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

    // =======================================================
    // STUDENTS DESTROY (DELETE)
    // =======================================================
    public function studentsDestroy(Student $student)
    {
        $student->delete();
        return back()->with('ok', 'Student deleted successfully.');
    }
}
