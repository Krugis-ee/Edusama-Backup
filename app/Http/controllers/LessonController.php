<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use App\Models\SuspensionLessons;
use App\Models\Branch;
use App\Models\Lesson;
use App\Models\ClassRoomSubjectTeachers;
use DB;

class LessonController extends Controller
{
    //
    public function manage_subject($subj_id)
    {
        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $branch_id = User::getBranchID($user_id);
        $subject_id = $subj_id;
        if (!empty($branch_id)) {
            $lessons = Lesson::where('organization_id', $org_get_id)->where('branch_id', $branch_id)->where('subject_id', $subject_id)->get();
        } else {
            $lessons = Lesson::where('organization_id', $org_get_id)->where('subject_id', $subject_id)->get();
        }

        return view('lesson.list', ['lessons' => $lessons, 'subject_id' => $subject_id]);
    }
    public function add_lesson($subj_id)
    {
        $subject_id = $subj_id;
        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $branch_id = User::getBranchID($user_id);
        return view('lesson.add', ['subject_id' => $subject_id]);
    }

    public function add_new_lesson(Request $request)
    {

        $request->validate([
            'lesson_name' => 'required',
        ]);

        $lesson = new Lesson;
        $lesson->lesson_name = $request->lesson_name;
        $lesson->organization_id = $request->organization_id;
        if (!empty($request->branch_id)) {
            $lesson->branch_id = $request->branch_id;
        } else {
            $lesson->branch_id = NULL;
        }
        if(!empty($request->subject_id)){
            $lesson->subject_id = $request->subject_id;
        }
        $lesson->type = 1;


        $lesson->save();
        return redirect(route('manage_subject', $request->subject_id))->with('success', 'Lesson created successfully!');
    }

    public function edit_lesson($id)
    {
        $lesson = Lesson::find($id);
        $subject_id=$lesson->subject_id;
        // $user_id = session()->get('loginId');
        // $org_get_id = User::getOrganizationId($user_id);
        // $branch_id = User::getBranchID($user_id);
        // $branches = Branch::where('branches.organization_id', $org_get_id)->where('type', 1)->get();
        $suspensions = SuspensionLessons::where('lesson_id', $id)->get();

        return view('lesson.edit', ['lesson' => $lesson, 'suspensions' => $suspensions,'subject_id' => $subject_id]);
    }

    public function update_lesson(Request $request)
    {

        $request->validate([
            'lesson_name' => 'required',
        ]);

        $id = $request->id;
        $lesson = Lesson::find($id);
        $lesson->lesson_name = $request->lesson_name;
        $subject_id=$lesson->subject_id;

        $lesson->save();
        return redirect(route('manage_subject', $subject_id))->with('success', 'Lesson Updated successfully!');
    }

    public function lesson_change_status(Request $request)
    {
        $id = $request->id;
        $lesson = Lesson::find($id);
        if ($request->status == 2) {
            if (!empty($request->suspend_msg)) {
                $lesson->type = $request->status;
                $lesson->suspend_msg = $request->suspend_msg;
                $lesson->save();
                //Suspensions Records

                $suspension = new SuspensionLessons;
                $suspension->lesson_id = $id;
                $suspension->suspension_reason = $request->suspend_msg;
                $suspension->suspension_date = date('d-m-Y');
                $suspension->save();

                return back()->with('message', 'Status Changed Successfully!');
            } else {
                return back()->with('error', 'Suspension reason is mandatory');
            }
        } else if ($request->status == 1) {
            $lesson->type = $request->status;
            $lesson->suspend_msg = $request->suspend_msg;
            $lesson->save();
            return back()->with('message', 'Status Changed Successfully!');
        }
    }
}
