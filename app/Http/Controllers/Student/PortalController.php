<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class PortalController extends Controller
{
    public function mySeat()
    {
        $user = auth()->user();

        // You may link users to students (students.user_id).
        $student = $user->role === 'student'
            ? $user->has('id') ? $user->loadMissing('id') : null
            : null;

        // If you didn’t link users->students, fetch by email or cmd_id another way.
        $student = \App\Models\Student::where('user_id', $user->id)
                    ->with(['department','room','invigilator'])
                    ->first();

        return view('student.my-seat', compact('student'));
    }
}
