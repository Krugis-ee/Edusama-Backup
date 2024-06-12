<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\User;
use App\Models\SuspensionBranches;
use DB;

class BranchController extends Controller
{
    public function index_branches()
    {
        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $branches = DB::table('branches')
            ->join('organizations', 'branches.organization_id', '=', 'organizations.id')
            ->select('branches.branch_name as branch_name', 'organizations.name as org_name', 'branches.id as id', 'branches.type as type', 'branches.suspend_msg as suspend_msg')
            ->where("branches.organization_id", $org_get_id)
            ->get();

        return view('branch.list', ['branches' => $branches]);
    }
    public function suspended_list_branches_index()
    {
        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $branches = DB::table('branches')
            ->join('organizations', 'branches.organization_id', '=', 'organizations.id')
            ->select('branches.branch_name as branch_name', 'branches.suspend_msg as suspend_msg', 'organizations.name as org_name', 'branches.id as id')
            ->where("branches.organization_id", $org_get_id)->where('branches.type', 2)
            ->get();

        return view('branch.suspended_list', ['branches' => $branches]);
    }
    public function add_branch()
    {

        return view('branch.add_new');
    }
    public function add_new_branch(Request $request)
    {
        $request->validate([
            'branch_name' => 'required',
        ]);


        $branch = new Branch;
        $branch->branch_name = $request->branch_name;
        $branch->organization_id = $request->organization_id;
        $branch->type = 1;
        $branch->admin_id = $request->admin_id;


        $branch->save();
        return redirect(route('branch_index'))->with('success', 'Branch created successfully!');
    }
    public function edit_branch($id)
    {
        $branch = Branch::find($id);
        $suspensions = SuspensionBranches::where('branch_id', $id)->get();
        return view('branch.edit', ['branch' => $branch, 'suspensions' => $suspensions]);
    }
    public function update_branch(Request $request)
    {
        $request->validate([
            'branch_name' => 'required',
        ]);
        $id = $request->id;
        $user = Branch::find($id);

        $user->branch_name = $request->branch_name;
        $user->save();
        return redirect(route('branch_index'))->with('success', 'Branch Name Updated!');
    }
    public function branch_change_status(Request $request)
    {
        $id = $request->id;
        $branch = Branch::find($id);
        if ($request->status == 1) {
            $branch->type = $request->status;
            $branch->suspend_msg = $request->suspend_msg;
            $branch->save();
        }
        //Suspensions Records
        if ($request->status == 2) {
            if (!empty($request->suspend_msg)) {

                $branch->type = $request->status;
                $branch->suspend_msg = $request->suspend_msg;
                $branch->save();

                $suspension = new SuspensionBranches;
                $suspension->branch_id = $id;
                $suspension->suspension_reason = $request->suspend_msg;
                $suspension->suspension_date = date('d-m-Y');
                $suspension->save();
            }else {
                return back()->with('error', 'Suspension reason is mandatory');
            }
        }
        //Suspensions Records
        return back()->with('message', 'Status Changed Successfully!');
        //return back()->with('message', 'Status Changed!');
    }
}
