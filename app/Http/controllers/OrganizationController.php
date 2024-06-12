<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon;
use App\Models\SuspensionOrganisations;

class OrganizationController extends Controller
{
    //
    public function add()
    {
        return view("organization.add");
    }
    public function add_new(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|required|unique:organizations,email',

            'start_date' => 'required',
            'end_date' => 'required',
            'address' => 'required',
            'vat_no' => 'required|unique:organizations,vat_no',
            'contact_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            //10240 - 10 mb --> 1024 - 1mb -- 5mb - 5120
            'logo' => 'mimes:jpeg,jpg,png|dimensions:max_width=170,max_height=52|max:5120',
        ]);
        $date = strtotime($request->start_date);
        $start_date = date('Y-m-d',$date);
        $date1 = strtotime($request->end_date);
        $end_date = date('Y-m-d',$date1);
        // print_r($start_date);
        // print_r($end_date);
        // die();

        if($request->start_date<$request->end_date){
            $organization = new Organization;
            $organization->name = $request->name;
            $organization->email = $request->email;
            $organization->start_date =$start_date;
            $organization->end_date =$end_date;
            //$organization->start_date = Carbon\Carbon::createFromFormat('d/m/Y', $request->start_date)->format('d-m-Y') ;
            //$organization->end_date = Carbon\Carbon::createFromFormat('d/m/Y', $request->end_date)->format('d-m-Y') ;

            $organization->color = $request->color;
            $organization->type = $request->type;

            $organization->address = $request->address;
            $organization->vat_no = $request->vat_no;
            $organization->contact_no = $request->contact_no;
            if ($request->hasfile('logo')) {
                $file = $request->file('logo');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extenstion;
                $file->move(public_path('assets/img/organization_logo'), $filename);
                $organization->logo = $filename;
            }
            $organization->save();
            return redirect(route('organization_list'))->with('success', 'Organisation registered!');
           // return redirect()->back()->with('message', 'Organization registration Sucessfull');
        }
        else{
            return redirect()->back()->with('error','Pleace Check The End Date');
        }
    }
    public function list()
    {
        $organizations = Organization::orderBy('created_at', 'DESC')->get();
        return view("organization.list", ["organizations" => $organizations]);
    }
    public function suspended_list_index()
    {
        $organizations = Organization::where('type',2)->orderBy('updated_at', 'DESC')->get();
        return view('organization.suspended_list', ['organizations' => $organizations]);
    }
    public function edit($id)
    {
        $organization = Organization::find($id);
        $suspensions=SuspensionOrganisations::where('organization_id',$id)->get();
        return view("organization.edit", ["data" => $organization,'suspensions'=>$suspensions]);
    }
    public function update(Request $request)
    {

        $id = $request->id;
        $request->validate([
            'name' =>'required',
            'email' => 'email|required|unique:organizations,email,' . $id ,
            'address' => 'required',
            'vat_no' => 'required',
            'contact_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'start_date' => 'required',
            'end_date' => 'required',
            //'logo' => 'mimes:jpeg,jpg,png|dimensions:max_width=170,max_height=52|max:5120',
        ]);

        $organization = Organization::find($id);

        if ($request->start_date < $request->end_date) {
            $organization->name = $request->name;
            $organization->email = $request->email;

            $date = strtotime($request->start_date);
            $start_date = date('Y-m-d',$date);
            $date1 = strtotime($request->end_date);
            $end_date = date('Y-m-d',$date1);

            $organization->start_date = $start_date;
            $organization->end_date = $end_date;

            //$organization->start_date = Carbon\Carbon::createFromFormat('d/m/Y', $request->start_date)->format('d-m-Y') ;
            //$organization->end_date = Carbon\Carbon::createFromFormat('d/m/Y', $request->end_date)->format('d-m-Y') ;
            $organization->color = $request->color;
            $organization->address = $request->address;
            $organization->vat_no = $request->vat_no;
            $organization->contact_no = $request->contact_no;
            if ($request->hasfile('logo')) {
                // $destination = public_path('assets/img/organization_logo').$organization->logo;
                // if(File::exists($destination))
                // {
                //     File::delete($destination);
                // }
                $file = $request->file('logo');
                $extention = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extention;
                $file->move(public_path('assets/img/organization_logo'), $filename);
                $organization->logo = $filename;
            }
            $organization->save();
            return redirect(route('organization_list'))->with('success', 'Organisation Details Updated!');
            //return redirect()->back()->with('message', 'Organization Details Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Pleace Check The End Date');
        }
    }

    public function status($id)
    {
        $organization = Organization::find($id);
        return view('organization.status', ['organization' => $organization]);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $organization = Organization::find($id);
        if ($request->status == 1) {
            $organization->type = $request->status;
            $organization->suspend_msg = $request->suspend_msg;
            $organization->save();
        }
        //Suspensions Records
        if ($request->status == 2) {
            if (!empty($request->suspend_msg)) {

                $organization->type = $request->status;
                $organization->suspend_msg = $request->suspend_msg;
                $organization->save();

                $suspension = new SuspensionOrganisations;
                $suspension->organization_id = $id;
                $suspension->suspension_reason = $request->suspend_msg;
                $suspension->suspension_date = date('d-m-Y');
                $suspension->save();
            }
            else{
                return back()->with('error', 'Suspension reason is mandatory');
            }
        }
        //Suspensions Records
        // return response()->json(['success'=>'Status changed successfully.']);
        return back()->with('message', 'Status Changed Successfully!');
    }
}
