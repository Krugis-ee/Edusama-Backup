<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\ClassRoomSubjectTeachers;
use App\Models\ClassRooms;
use App\Models\Subject;
use Illuminate\Http\Request;

class TeacherAttendanceController extends Controller
{
    //
    public function teacher_attendance(Request $request)
    {
        $teacher_id = session()->get('loginId');
        $class_rooms = ClassRoomSubjectTeachers::where('teacher_id', $teacher_id)->get();
        return view('teacher_attendance.teacher_attendance', ['class_rooms' => $class_rooms, 'teacher_id' => $teacher_id]);
    }
    public function get_subjects_by_classroom_id_teacher(Request $request)
    {
        if (!empty($request->class_room_id) && $request->class_room_id != 'all') {
            $subject_list = ClassRoomSubjectTeachers::where('class_room_id', $request->class_room_id)->where('teacher_id', $request->teacher_id)->get();
        } else if (!empty($request->class_room_id) && $request->class_room_id == 'all') {
            $subject_list = ClassRoomSubjectTeachers::where('teacher_id', $request->teacher_id)->get();
        }
        $subjects = [];
        if ($subject_list) {
            foreach ($subject_list as $subject) {
                $subject_id = $subject->subject_id;
                $subject = Subject::find($subject_id);
                $subjects[] = array(
                    'subject_id' => $subject_id,
                    'subject_name' => $subject->subject_name
                );
            }
        }
        return response()->json(['subjects' => $subjects]);
    }
    public function list_classroom(Request $request)
    {
        $teacher_id = session()->get('loginId');
        if (!empty($request->class_room_id) && !empty($request->subject_id) && $request->class_room_id == 'all' && $request->subject_id == 'all') {
            $class_room_list = ClassRoomSubjectTeachers::join('class_rooms', 'class_rooms.id', '=', 'class_room_subject_teachers.class_room_id')
                ->join('subjects', 'subjects.id', '=', 'class_room_subject_teachers.subject_id')
                ->join('branches', 'branches.id', '=', 'class_rooms.branch_id')
                ->where('class_room_subject_teachers.teacher_id', $teacher_id)->get();
        }
        if (!empty($request->class_room_id) && !empty($request->subject_id) && $request->class_room_id == 'all' && $request->subject_id != 'all') {
            $class_room_list = ClassRoomSubjectTeachers::join('class_rooms', 'class_rooms.id', '=', 'class_room_subject_teachers.class_room_id')
                ->join('subjects', 'subjects.id', '=', 'class_room_subject_teachers.subject_id')
                ->join('branches', 'branches.id', '=', 'class_rooms.branch_id')
                ->where('class_room_subject_teachers.teacher_id', $teacher_id)->where('class_room_subject_teachers.subject_id', $request->subject_id)->get();
        }
        if (!empty($request->class_room_id) && !empty($request->subject_id) && $request->class_room_id != 'all' && $request->subject_id == 'all') {
            $class_room_list = ClassRoomSubjectTeachers::join('class_rooms', 'class_rooms.id', '=', 'class_room_subject_teachers.class_room_id')
                ->join('subjects', 'subjects.id', '=', 'class_room_subject_teachers.subject_id')
                ->join('branches', 'branches.id', '=', 'class_rooms.branch_id')
                ->where('class_room_subject_teachers.teacher_id', $teacher_id)->where('class_room_subject_teachers.class_room_id', $request->class_room_id)->get();
        }
        if (!empty($request->class_room_id) && !empty($request->subject_id) && $request->class_room_id != 'all' && $request->subject_id != 'all') {
            $class_room_list = ClassRoomSubjectTeachers::join('class_rooms', 'class_rooms.id', '=', 'class_room_subject_teachers.class_room_id')
                ->join('subjects', 'subjects.id', '=', 'class_room_subject_teachers.subject_id')
                ->join('branches', 'branches.id', '=', 'class_rooms.branch_id')
                ->where('class_room_subject_teachers.teacher_id', $teacher_id)->where('class_room_subject_teachers.class_room_id', $request->class_room_id)->where('subject_id', $request->subject_id)->get();
        }

        return response()->json(['class_room_list' => $class_room_list]);
    }
    public function teacher_add_attendance($c_id, $su_id, $st_id, $t_id)
    {
        return view('teacher_attendance.teacher_add_attendance', ['class_room_id' => $c_id, 'subject_id' => $su_id, 'students_id' => $st_id, 'teacher_id' => $t_id]);
    }
    public function teacher_add_attendance_process(Request $request)
    {
        if ($request->students_id != null) {
            $students_id = explode(",", $request->students_id);
            $count = count($students_id);
            for ($i = 0; $i < $count; $i++) {
                $attendance = new Attendance;
                $attendance->class_room_id = $request->class_room_id;
                $attendance->teacher_id = $request->teacher_id;
                $attendance->subject_id = $request->subject_id;
                $attendance->attendance_score = $request->attendance[$i];
                $attendance->student_id = $students_id[$i];
                $date = strtotime($request->date);
                $mysql_date = date('Y-m-d H:i:s', $date);
                $attendance->attendance_date = $mysql_date;
                $attendance->save();
            }
        }
        return back()->with('success', 'Attendance marked Successfully!');
    }

    public function teacher_edit_attendance($c_id, $su_id, $st_id, $t_id)
    {
        return view('teacher_attendance.teacher_edit_attendance', ['class_room_id' => $c_id, 'subject_id' => $su_id, 'students_id' => $st_id, 'teacher_id' => $t_id]);
    }

    public function teacher_list_attendance(Request $request)
    {
        $student_arr = explode(',', $request->students_id);
        $date = strtotime($request->attendance_date);
        $mysql_date = date('Y-m-d H:i:s', $date);
        $attendance = Attendance::join('class_rooms', 'class_rooms.id', '=', 'attendance.class_room_id')
            ->join('subjects', 'subjects.id', '=', 'attendance.subject_id')->join('users', 'users.id', '=', 'attendance.student_id')
            ->where('attendance.class_room_id', $request->class_room_id)->where('subject_id', $request->subject_id)
            ->where('teacher_id', $request->teacher_id)->where('attendance_date', $mysql_date)->whereIn('student_id', $student_arr)->get();
        return response()->Json(['attendance' => $attendance]);
    }

    public function teacher_edit_attendance_process(Request $request)
    {
        if ($request->students_id != null) {
            $students_arr = explode(',', $request->students_id);
            $count = count($students_arr);
            // print_r($count);
            // die();
            for ($i = 0; $i < $count; $i++) {
                $attendance = Attendance::where('class_room_id', $request->class_room_id)->where('subject_id', $request->subject_id)
                    ->where('student_id', $students_arr[$i])->where('teacher_id', $request->teacher_id)->first();

                $attendance->attendance_score = $request->attendance[$i];
                $attendance->student_id = $students_arr[$i];
                $attendance->save();
            }
        }
        return back()->with('success', 'Attendance Updated Successfully!');
    }
}