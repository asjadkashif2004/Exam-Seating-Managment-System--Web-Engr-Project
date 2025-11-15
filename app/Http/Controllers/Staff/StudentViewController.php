<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Room;

class StudentViewController extends Controller
{
    // Staff Dashboard (Option A)
    public function dashboard()
    {
        // Fetch ALL staff names (distinct invigilator names)
        $allStaff = Room::whereNotNull('invigilator')
                        ->where('invigilator', '!=', '')
                        ->select('invigilator')
                        ->distinct()
                        ->get();

        // Fetch rooms grouped by staff
        $staffRooms = Room::whereNotNull('invigilator')
                          ->where('invigilator', '!=', '')
                          ->orderBy('invigilator')
                          ->get()
                          ->groupBy('invigilator');

        // Logged-in staff’s own rooms
        $myName = auth()->user()->name;

        $myRooms = Room::where('invigilator', $myName)->get();

        return view('staff.index', compact(
            'allStaff',
            'staffRooms',
            'myRooms'
        ));
    }
}
