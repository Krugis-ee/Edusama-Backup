<?php

namespace App\Http\Controllers;

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
        // if (!empty($request->class_room_id) && $request->subject_id != 'all') {
        //     $class_room_details = ClassRooms::where('id', $request->class_room_id)->first();
        // }
        $teacher_id = session()->get('loginId');
        if (!empty($request->class_room_id) && !empty($request->subject_id) && $request->class_room_id == 'all' && $request->subject_id == 'all') {
            $class_room_list = ClassRoomSubjectTeachers::where('teacher_id', $teacher_id)->get();
        }
        if (!empty($request->class_room_id) && !empty($request->subject_id) && $request->class_room_id == 'all' && $request->subject_id != 'all') {
            $class_room_list = ClassRoomSubjectTeachers::where('teacher_id', $teacher_id)->where('subject_id', $request->subject_id)->get();
        }
        if (!empty($request->class_room_id) && !empty($request->subject_id) && $request->class_room_id != 'all' && $request->subject_id == 'all') {
            $class_room_list = ClassRoomSubjectTeachers::where('teacher_id', $teacher_id)->where('class_room_id', $request->class_room_id)->get();
        }
        if (!empty($request->class_room_id) && !empty($request->subject_id) && $request->class_room_id != 'all' && $request->subject_id != 'all') {
            $class_room_list = ClassRoomSubjectTeachers::where('teacher_id', $teacher_id)->where('class_room_id', $request->class_room_id)->where('subject_id', $request->subject_id)->get();
        }
        foreach ($class_room_list as $class_room) {
            $subject_id = $class_room->subject_id;
            $subject = Subject::find($subject_id);
            $subjects[] = array(
                'subject_name' => $subject->subject_name
            );
            $class_room_id = $class_room->class_room_id;
            $class_room = ClassRooms::find($class_room_id);
            $class_rooms[] = array(
                'class_room_name' => $class_room->class_room_name
            );

            $class_room_durations[] = array(
                'class_room_durations' => $class_room->duration
            );

            $students = $class_room->students_id;
        //     $students_array = explode(',', $students);
        //     $no_of_students[] =array('no_of_students' => array_count_values($students_array)
        // );
        }


        return response()->json(['class_room_list' => $class_room_list, 'subject_name' => $subjects, 'classroom_name' => $class_rooms,'class_room_durations' => $class_room_durations,'students' => $students]);
    }
}
