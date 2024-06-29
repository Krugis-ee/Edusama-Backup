<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{
    //
    public function student_attendance()
    {
        return view('student_attendance.student_attendance');
    }
}
