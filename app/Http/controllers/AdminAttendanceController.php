<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAttendanceController extends Controller
{
    //
    public function admin_attendance()
    {
        return view('admin_attendance.admin_attendance');
    }
}
