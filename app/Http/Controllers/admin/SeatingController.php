<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SeatingPlan;
use App\Models\Room;
use App\Models\AllocatedSeat;
use Illuminate\Http\Request;

class SeatingController extends Controller
{
    /**
     * Display tile seating view for a room in a seating plan.
     */
 
public function roomTiles(Room $room)
{
    // Students assigned to this room
    $students = $room->students()->orderBy('semester')->orderBy('cmd_id')->get();

    return view('admin.seating.room-tiles', [
        'room' => $room,
        'students' => $students,
    ]);
}

}

    