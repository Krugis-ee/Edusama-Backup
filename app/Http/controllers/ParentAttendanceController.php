<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParentAttendanceController extends Controller
{
    //
    public function parent_attendance()
    {
        return view('parent_attendance.parent_attendance');
    }
}
