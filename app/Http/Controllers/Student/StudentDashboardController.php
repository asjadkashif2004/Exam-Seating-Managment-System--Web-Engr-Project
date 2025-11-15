<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $students = Student::with(['department', 'room'])
            ->when($search, function ($query) use ($search) {
                return $query->where('cmd_id', 'LIKE', "%$search%");
            })
            ->orderBy('cmd_id')
            ->get();

        return view('student.index', compact('students', 'search'));
    }
}
