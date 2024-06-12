<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Department;
use App\Models\SuspensionDepartments;
use App\Models\Branch;
use DB;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    //
    public function add_department()
    {
        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $branches = Branch::where('branches.organization_id', $org_get_id)->where('type', 1)->get();
        return view('department.add', ['branches' => $branches]);
    }

    public function add_new_department(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
            'department_name' => 'required',
            'short_code' => 'required',
        ]);


        $department = new Department;
        $department->department_name = $request->department_name;
        $department->organization_id = $request->organization_id;
        $department->branch_id = $request->branch_id;
        $department->short_code = $request->short_code;
        $department->type = 1;


        $department->save();
        return redirect(route('department_index'))->with('success', 'Department created successfully!');
    }

    public function index_departments()
    {
        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $branch_id = User::getBranchID($user_id);
        if (!empty($branch_id)) {
            $departments = DB::table('departments')
                ->join('organizations', 'departments.organization_id', '=', 'organizations.id')
                ->select('departments.department_name as department_name', 'departments.suspend_msg as suspend_msg', 'departments.branch_id as branch_id', 'departments.type as type', 'organizations.name as org_name', 'departments.id as id')
                ->where("departments.organization_id", $org_get_id)
                ->where("departments.branch_id", $branch_id)
                ->get();
        }else{
            $departments = DB::table('departments')
                ->join('organizations', 'departments.organization_id', '=', 'organizations.id')
                ->select('departments.department_name as department_name', 'departments.suspend_msg as suspend_msg', 'departments.branch_id as branch_id', 'departments.type as type', 'organizations.name as org_name', 'departments.id as id')
                ->where("departments.organization_id", $org_get_id)
                ->get();
        }

        return view('department.list', ['departments' => $departments]);
    }
    public function edit_department($id)
    {
        $department = Department::find($id);
        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $branches = Branch::where('branches.organization_id', $org_get_id)->where('type', 1)->get();
        $suspensions = SuspensionDepartments::where('department_id', $id)->get();

        return view('department.edit', ['department' => $department, 'branches' => $branches, 'suspensions' => $suspensions]);
    }

    public function update_department(Request $request)
    {
        $request->validate([
            'department_name' => 'required',
            'short_code' => 'required',
        ]);
        $id = $request->id;
        $department = Department::find($id);
        $department->branch_id = $request->branch_id;
        $department->department_name = $request->department_name;
        $department->short_code = $request->short_code;
        $department->save();
        return redirect(route('department_index'))->with('success', 'Department Updated Successfully!');
    }

    public function department_change_status(Request $request)
    {
        $id = $request->id;
        $department = Department::find($id);
        // $class_room_department = ClassRoomdepartmentTeachers::where('department_id', $id)->first();
        if ($request->status == 2) {
            if (!empty($request->suspend_msg)) {
                $department->type = $request->status;
                $department->suspend_msg = $request->suspend_msg;
                $department->save();
                //Suspensions Records

                $suspension = new SuspensionDepartments;
                $suspension->department_id = $id;
                $suspension->suspension_reason = $request->suspend_msg;
                $suspension->suspension_date = date('d-m-Y');
                $suspension->save();
                // if ($class_room_department) {
                //     $class_room_department->department_suspended_status = $request->status;
                //     $class_room_department->save();
                // }
                return back()->with('message', 'Status Changed Successfully!');
            } else {
                return back()->with('error', 'Suspension reason is mandatory');
            }
        } else if ($request->status == 1) {
            $department->type = $request->status;
            $department->suspend_msg = $request->suspend_msg;
            $department->save();
            // if ($class_room_department) {
            //     $class_room_department->department_suspended_status = $request->status;
            //     $class_room_department->save();
            // }
            return back()->with('message', 'Status Changed Successfully!');
        }
    }
}
