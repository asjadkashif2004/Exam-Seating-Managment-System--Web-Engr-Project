<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentViewController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::with(['department','room','invigilator'])
            ->orderBy('department_id')
            ->orderBy('semester')
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('staff.students.index', compact('students'));
    }
}
