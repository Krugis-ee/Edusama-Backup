<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\TemplateTiming;
use App\Models\ClassRoomTimings;
use App\Models\User;
use App\Models\Branch;
use DB;

class TemplateController extends Controller
{
    public function index_templates()
    {
        $user_id = session()->get('loginId');
		$org_get_id = User::getOrganizationId($user_id);
      
        $branch_id = User::getBranchID($user_id);
        if (!empty($branch_id)) {
            $templates=Template::where('type',1)->where('organisation_id',$org_get_id)->where('branch_id',$branch_id)->get();
        }else{
            $templates=Template::where('type',1)->where('organisation_id',$org_get_id)->get();
        }

	  $branches=Branch::where('branches.organization_id',$org_get_id)->where('type', 1)->get();
        /*$templates=DB::table('templates')
        ->join('template_timings','templates.id','=','template_timings.template_id')
        ->select('templates.template_name as template_name','templates.id as template_id')
        ->where('templates.organisation_id',$org_get_id)
        ->get();*/
        return view('template.list',['templates'=>$templates,'branches'=>$branches]);
       // return view('template.list', ['branches' => $branches]);
    }

    public function add_template()
    {
        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $branches=Branch::where('branches.organization_id',$org_get_id)->where('type', 1)->get();

        return view('template.add_new',['branches'=>$branches]);
    }
    public function add_new_template(Request $request)
    {
       $request->validate([
			'branch_id' => 'required',
            'template_name' => 'required',
            'start_date' => 'required',
			'end_date' => 'required',
            'duration' => 'required',
			'offline_course_module' => 'required',
            'quiz_exam_module' => 'required',
            'assessment_course_module' => 'required',
			'library_module' => 'required',
            'attendance_module' => 'required',
            'online_course_module' => 'required',
			'week_days_status'=>'required'
        ]);
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);

        $template = new Template;
		$template->branch_id = $request->branch_id;
        $template->template_name = $request->template_name;
        $template->start_date = $request->start_date;
        $date = strtotime($request->start_date);
        $template->start_date = date('Y-m-d', $date);
        $date1 = strtotime($request->end_date);
        $template->end_date = date('Y-m-d', $date1);
        $template->duration = $request->duration;

        $template->offline_course_module = $request->offline_course_module;
        $template->quiz_exam_module = $request->quiz_exam_module;
        $template->assessment_course_module	 = $request->assessment_course_module	;
        $template->library_module = $request->library_module;
        $template->attendance_module = $request->attendance_module;
        $template->online_course_module = $request->online_course_module;

        $template->organisation_id	 = $org_id;
		$template->type	 = 1;
       // $template->type = 1;

        $template->save();
        $template_id=$template->id;

        $weak_days=$request->weak_days;
        $start=$request->start;
        $end=$request->end;
        $week_days_status=$request->week_days_status;

        $i=0;

        foreach($weak_days as $weak_day)
        {
            $j=$i+1;
              if(in_array($j,$week_days_status))
              {

            $template_timing = new TemplateTiming;
            $template_timing->template_id=$template_id;
            $template_timing->weekday=$weak_day;
            $template_timing->from_time=$start[$i];
            $template_timing->to_time=$end[$i];
            $template_timing->save();
              }
             $i++;
        }
		//return $request;
        //return $template_id;
      return redirect(route('template_index'))->with('success', 'Template created successfully!');
    }
	public function edit_template($id)
	{
		$template=Template::find($id);
		$template_id=$template->id;
		$template_timing=TemplateTiming::where('template_id',$template_id)->get();
		$template_arr=[
		'branch_id'=>$template->branch_id,
		'template_id'=>$template->id,
		'template_name'=>$template->template_name,
		'start_date'=>$template->start_date,
		'end_date'=>$template->end_date,
		'duration'=>$template->duration,
		'offline_course_module'=>$template->offline_course_module,
		'quiz_exam_module'=>$template->quiz_exam_module,
		'assessment_course_module'=>$template->assessment_course_module,
		'library_module'=>$template->library_module,
		'attendance_module'=>$template->attendance_module,
		'online_course_module'=>$template->online_course_module,
		'template_timings'=>$template_timing
		];

		return $template_arr;
	}
	/*public function jp()
	{
		$template_id=1;
		$class_room_ids=ClassRoomTimings::where('template_id',$template_id)->select('class_room_id')->groupBy('class_room_id')->get();
		$class_room_ids_arr=[];
		foreach($class_room_ids as $class_room_id)
		{
			array_push($class_room_ids_arr,$class_room_id->class_room_id);
		}
		print_r($class_room_ids_arr);
		//return $res;
	}*/
	public function update_template(Request $request)
	{
		$template_id = $request->template_id;

        $template = Template::find($template_id);
		$template->branch_id = $request->branch_id;
		$template->template_name = $request->template_name;
		$template->duration = $request->duration;
        $template->start_date = $request->start_date;
        $date = strtotime($request->start_date);
        $template->start_date = date('Y-m-d', $date);
        $date1 = strtotime($request->end_date);
        $template->end_date = date('Y-m-d', $date1);

        $template->offline_course_module = $request->offline_course_module;
        $template->quiz_exam_module = $request->quiz_exam_module;
        $template->assessment_course_module	 = $request->assessment_course_module	;
        $template->library_module = $request->library_module;
        $template->attendance_module = $request->attendance_module;
        $template->online_course_module = $request->online_course_module;
        $template->save();

		$weak_days=$request->weak_days;
        $start=$request->start;
        $end=$request->end;
        $week_days_status=$request->week_days_status;
       $res=TemplateTiming::where('template_id',$template_id)->delete();
        $i=0;
       if($week_days_status)
	   {
        foreach($weak_days as $weak_day)
        {
            $j=$i+1;
              if(in_array($j,$week_days_status))
              {

            $template_timing = new TemplateTiming;
            $template_timing->template_id=$template_id;
            $template_timing->weekday=$weak_day;
            $template_timing->from_time=$start[$i];
            $template_timing->to_time=$end[$i];
            $template_timing->save();
              }
             $i++;
        }
		//update class room timing

		$class_room_ids=ClassRoomTimings::where('template_id',$template_id)->select('class_room_id')->groupBy('class_room_id')->get();
		$class_room_ids_arr=[];
		$rese=ClassRoomTimings::where('template_id',$template_id)->delete();

		foreach($class_room_ids as $class_room_id)
		{
			$class_id=$class_room_id->class_room_id;
			$i=0;
			foreach($weak_days as $weak_day)
			{
            $j=$i+1;
              if(in_array($j,$week_days_status))
              {

            $class_timing = new ClassRoomTimings;
			$class_timing->class_room_id=$class_id;
            $class_timing->template_id=$template_id;
            $class_timing->weakday=$weak_day;
            $class_timing->from_time=$start[$i];
            $class_timing->to_time=$end[$i];
            $class_timing->save();
              }
             $i++;
			}
		}
		//update class room timing
		//return $weak_days;

        //return $template_id;
      return redirect(route('template_index'))->with('success', 'Template updated successfully!');
	   }
	   else
		 return redirect(route('template_index'))->with('fail', 'Timings not mentioned!');
	}
}
