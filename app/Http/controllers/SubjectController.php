<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\SuspensionSubjects;
use App\Models\Branch;
use App\Models\ClassRoomSubjectTeachers;
use DB;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    //
    public function add_subject()
    {
        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $branches = Branch::where('branches.organization_id', $org_get_id)->where('type', 1)->get();
        return view('subject.add', ['branches' => $branches]);
    }

    public function add_new_subject(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
            'subject_name' => 'required',
            'short_code' => 'required',
        ]);


        $subject = new Subject;
        $subject->subject_name = $request->subject_name;
        $subject->organization_id = $request->organization_id;
        $subject->branch_id = $request->branch_id;
        $subject->short_code = $request->short_code;
        $subject->type = 1;


        $subject->save();
        return redirect(route('subject_index'))->with('success', 'Subject created successfully!');
    }

    public function index_subjects()
    {
        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $branch_id = User::getBranchID($user_id);
        if (!empty($branch_id)) {
            $subjects = DB::table('subjects')
                ->join('organizations', 'subjects.organization_id', '=', 'organizations.id')
                ->select('subjects.subject_name as subject_name', 'subjects.suspend_msg as suspend_msg', 'subjects.branch_id as branch_id', 'subjects.type as type', 'organizations.name as org_name', 'subjects.id as id')
                ->where("subjects.organization_id", $org_get_id)
                ->where("subjects.branch_id", $branch_id)
                ->get();
        }else{
            $subjects = DB::table('subjects')
                ->join('organizations', 'subjects.organization_id', '=', 'organizations.id')
                ->select('subjects.subject_name as subject_name', 'subjects.suspend_msg as suspend_msg', 'subjects.branch_id as branch_id', 'subjects.type as type', 'organizations.name as org_name', 'subjects.id as id')
                ->where("subjects.organization_id", $org_get_id)
                ->get();
        }

        return view('subject.list', ['subjects' => $subjects]);
    }

    public function suspended_list_subjects_index()
    {
        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $subjects = DB::table('subjects')
            ->join('organizations', 'subjects.organization_id', '=', 'organizations.id')
            ->select('subjects.subject_name as subject_name', 'subjects.suspend_msg as suspend_msg', 'organizations.name as org_name', 'subjects.id as id')
            ->where("subjects.organization_id", $org_get_id)->where('subjects.type', 2)
            ->get();

        return view('subject.suspended_list', ['subjects' => $subjects]);
    }

    public function edit_subject($id)
    {
        $subject = Subject::find($id);
        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $branches = Branch::where('branches.organization_id', $org_get_id)->where('type', 1)->get();
        $suspensions = SuspensionSubjects::where('subject_id', $id)->get();

        return view('subject.edit', ['subject' => $subject, 'branches' => $branches, 'suspensions' => $suspensions]);
    }

    public function update_subject(Request $request)
    {
        $request->validate([
            'subject_name' => 'required',
            'short_code' => 'required',
        ]);
        $id = $request->id;
        $user = Subject::find($id);
        $user->branch_id = $request->branch_id;
        $user->subject_name = $request->subject_name;
        $user->short_code = $request->short_code;
        $user->save();
        return redirect(route('subject_index'))->with('success', 'subject Name Updated!');
    }

    public function subject_change_status(Request $request)
    {
        $id = $request->id;
        $subject = Subject::find($id);
        $class_room_subject = ClassRoomSubjectTeachers::where('subject_id', $id)->first();
        if ($request->status == 2) {
            if (!empty($request->suspend_msg)) {
                $subject->type = $request->status;
                $subject->suspend_msg = $request->suspend_msg;
                $subject->save();
                //Suspensions Records

                $suspension = new SuspensionSubjects;
                $suspension->subject_id = $id;
                $suspension->suspension_reason = $request->suspend_msg;
                $suspension->suspension_date = date('d-m-Y');
                $suspension->save();
                if ($class_room_subject) {
                    $class_room_subject->subject_suspended_status = $request->status;
                    $class_room_subject->save();
                }
                return back()->with('message', 'Status Changed Successfully!');
            } else {
                return back()->with('error', 'Suspension reason is mandatory');
            }
        } else if ($request->status == 1) {
            $subject->type = $request->status;
            $subject->suspend_msg = $request->suspend_msg;
            $subject->save();
            if ($class_room_subject) {
                $class_room_subject->subject_suspended_status = $request->status;
                $class_room_subject->save();
                //$class_room_subject->subject_suspended_status = $request->status;
                //$class_room_subject->save();
            }
            return back()->with('message', 'Status Changed Successfully!');
            //$class_room_subject->subject_suspended_status = $request->status;
            //$class_room_subject->save();
            //Suspensions Records
            // return response()->json(['success' => 'Status changed successfully.']);
            //return back()->with('message', 'Status Changed!');
        }
    }
}
