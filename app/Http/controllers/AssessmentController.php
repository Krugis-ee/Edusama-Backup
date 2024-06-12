<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
use App\Models\Country;
use App\Models\UserRole;
use App\Models\ClassRooms;
use App\Models\Subject;
use App\Models\Lesson;
use App\Models\Branch;
use App\Models\QuestionTypeOneTemp;
use App\Models\QuestionTypeOne;
use App\Models\QuestionTypeTwoTemp;
use App\Models\QuestionTypeTwo;
use App\Models\QuestionTypeThreeTemp;
use App\Models\QuestionTypeThree;
use App\Models\QuestionTypeFourTemp;
use App\Models\QuestionTypeFour;
use App\Models\QuestionTypeFiveTemp;
use App\Models\QuestionTypeFive;
use App\Models\QuestionTypeSixTemp;
use App\Models\QuestionTypeSix;
use App\Models\QuestionTypeSevenTemp;
use App\Models\QuestionTypeSeven;
use App\Models\ClassRoomSubjectTeachers;
use App\Models\Assessment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Imports\QuestionTypeOneImport;
use App\Imports\QuestionTypeTwoImport;
use App\Imports\QuestionTypeThreeImport;
use App\Imports\QuestionTypeFourImport;
use App\Imports\QuestionTypeFiveImport;
use App\Imports\QuestionTypeSixImport;
use App\Imports\QuestionTypeSevenImport;
use Session;
use Excel;

class AssessmentController extends Controller
{
	public function assessment()
    {
		$user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $branch_id = User::getBranchID($user_id);
        if (!empty($branch_id)) {
			$subjects=Subject::where('type',1)->where('organization_id',1)->where('branch_id',1)->get();
		}
		else{
			$subjects=Subject::where('type',1)->where('organization_id',1)->get();
		}
        return view('assessment.admin_assessment',['subjects'=>$subjects]);
    }
	public function question_bank($slug)
	{
		$subjects='';
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $branch_id = User::getBranchID($user_id);
        $user_role_id = User::getUserRoleIdByUserId($user_id);
        $branches = Branch::where('organization_id', $org_id)->where('type', 1)->get();
        if (!empty($branch_id)) {
            $subjects = Subject::where('organization_id', $org_id)->where('branch_id', $branch_id)->where('type', 1)->get();
        }
        return view('assessment.question_bank', ['branches' => $branches, 'subjects' => $subjects,'user_role_id' => $user_role_id,'slug'=>$slug]);
        //return view('assessment.question_bank',['subjects'=>$subjects,'slug'=>$slug]);
	}	
	public function ExcelpreviewUpdate(Request $request)
	{
		$subjects='';
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
		$slug=$request->slug;
		$user_role_id = User::getUserRoleIdByUserId($user_id);
        //$branch_id = User::getBranchID($user_id);
		$branch_id=$request->branch_id;
        $user_role_id = User::getUserRoleIdByUserId($user_id);
        $branches = Branch::where('organization_id', $org_id)->where('type', 1)->get();
        if (!empty($branch_id)) {
            $subjects = Subject::where('branch_id', $branch_id)->where('type', 1)->get();
        }
		if($request->filter_type_new=='mcq_1')
		{
			$total=$request->total;
			$branch_id=$request->branch_id;
			$subject_id=$request->subject_id;
			$lesson_id=$request->lesson_id;
			
			$question_name=$request->question_name;
			$option_a=$request->option_a;
			$option_b=$request->option_b;
			$option_c=$request->option_c;
			$option_d=$request->option_d;
			
			$complexity=$request->complexity;
			$qid=$request->qid;
			
			for($i=0;$i<$total;$i++)
			{
				if(isset($branch_id[$i]))
				{
				$ques=new QuestionTypeOne();
				$ques->branch_id=$branch_id[$i];
				$ques->subject_id=$subject_id[$i];
				$ques->lesson_id=$lesson_id[$i];
				$jp_ans='inlineRadioOption_'.$qid[$i];
				
				if($request->$jp_ans=='a')
					$answer=$option_a[$i];
				if($request->$jp_ans=='b')
					$answer=$option_b[$i];
				if($request->$jp_ans=='c')
					$answer=$option_c[$i];
				if($request->$jp_ans=='d')
					$answer=$option_d[$i];
				
				$ques->answer=$answer;
				
				$ques->question_name=$question_name[$i];
				$ques->option_a=$option_a[$i];
				$ques->option_b=$option_b[$i];
				$ques->option_c=$option_c[$i];
				$ques->option_d=$option_d[$i];
				
				$ques->complexity=$complexity[$i];
				$ques->save();
				
				//$res=QuestionTypeOneTemp::where('id',$qid[$i])->delete();
				
				}
			}
			$res1=QuestionTypeOneTemp::truncate();
			$success_msg='Multiple Choice Single Answer Questions imported Successfully!';
		}
		if($request->filter_type_new=='mcq_2')
		{
			$total=$request->total;
			$branch_id=$request->branch_id;
			$subject_id=$request->subject_id;
			$lesson_id=$request->lesson_id;
			
			$question_name=$request->question_name;
			$option_a=$request->option_a;
			$option_b=$request->option_b;
			$option_c=$request->option_c;
			$option_d=$request->option_d;
			
			$complexity=$request->complexity;
			$qid=$request->qid;
			
			for($i=0;$i<$total;$i++)
			{
				if(isset($branch_id[$i]))
				{
				$ques=new QuestionTypeTwo();
				$ques->branch_id=$branch_id[$i];
				$ques->subject_id=$subject_id[$i];
				$ques->lesson_id=$lesson_id[$i];
				$jp_ans='inlineCheckBox_'.$qid[$i];
				
				$answer_array=[];
				if(in_array('a',$request->$jp_ans))
					array_push($answer_array,$option_a[$i]);
				if(in_array('b',$request->$jp_ans))
					array_push($answer_array,$option_b[$i]);
				if(in_array('c',$request->$jp_ans))
					array_push($answer_array,$option_c[$i]);
				if(in_array('d',$request->$jp_ans))
					array_push($answer_array,$option_d[$i]);
				
				$ques->answer=implode(',',$answer_array);
				$ques->question_name=$question_name[$i];
				$ques->option_a=$option_a[$i];
				$ques->option_b=$option_b[$i];
				$ques->option_c=$option_c[$i];
				$ques->option_d=$option_d[$i];
				
				$ques->complexity=$complexity[$i];
				$ques->save();
				
				//$res=QuestionTypeTwoTemp::where('id',$qid[$i])->delete();
				
				}
			}
			$res2=QuestionTypeTwoTemp::truncate();
			$success_msg='Multiple Choice Multiple Answer Questions imported Successfully!';
		}
		if($request->filter_type_new=='match_following')
		{
			$total=$request->total;
			$branch_id=$request->branch_id;
			$subject_id=$request->subject_id;
			$lesson_id=$request->lesson_id;
			
			
			$option_a=$request->option_a;
			$option_b=$request->option_b;
			$option_c=$request->option_c;
			$option_d=$request->option_d;
			
			$option_1=$request->option_1;
			$option_2=$request->option_2;
			$option_3=$request->option_3;
			$option_4=$request->option_4;
			
			$choice_1=$request->choice_1;
			$choice_2=$request->choice_2;
			$choice_3=$request->choice_3;
			$choice_4=$request->choice_4;
			
			$complexity=$request->complexity;
			$qid=$request->qid;
			
			for($i=0;$i<$total;$i++)
			{
				if(isset($branch_id[$i]))
				{
				$ques=new QuestionTypeThree();
				$ques->branch_id=$branch_id[$i];
				$ques->subject_id=$subject_id[$i];
				$ques->lesson_id=$lesson_id[$i];
				$jp_ans='inlineRadioOptions_match_'.$qid[$i];
				
				$answer='';
				if($request->$jp_ans=='a')
					$answer=$choice_1[$i];
				if($request->$jp_ans=='b')
					$answer=$choice_2[$i];
				if($request->$jp_ans=='c')
					$answer=$choice_3[$i];
				if($request->$jp_ans=='d')
					$answer=$choice_4[$i];
				$ques->answer=$answer;
				
				$ques->option_a=$option_a[$i];
				$ques->option_b=$option_b[$i];
				$ques->option_c=$option_c[$i];
				$ques->option_d=$option_d[$i];
				
				$ques->option_1=$option_1[$i];
				$ques->option_2=$option_2[$i];
				$ques->option_3=$option_3[$i];
				$ques->option_4=$option_4[$i];
				
				$ques->choice_1=$choice_1[$i];
				$ques->choice_2=$choice_2[$i];
				$ques->choice_3=$choice_3[$i];
				$ques->choice_4=$choice_4[$i];
				
				$ques->complexity=$complexity[$i];
				$ques->save();
				
				}
			}
			$res1=QuestionTypeThreeTemp::truncate();
			$success_msg='Match the following Questions imported Successfully!';
		}
		if($request->filter_type_new=='fill_blanks')
		{
			$total=$request->total;
			$branch_id=$request->branch_id;
			$subject_id=$request->subject_id;
			$lesson_id=$request->lesson_id;
			
			$question_name=$request->question_name;
			$option_a=$request->option_a;
			$option_b=$request->option_b;
			$option_c=$request->option_c;
			$option_d=$request->option_d;
			
			$complexity=$request->complexity;
			$qid=$request->qid;
			
			for($i=0;$i<$total;$i++)
			{
				if(isset($branch_id[$i]))
				{
				$ques=new QuestionTypeFour();
				$ques->branch_id=$branch_id[$i];
				$ques->subject_id=$subject_id[$i];
				$ques->lesson_id=$lesson_id[$i];
				$jp_ans='inlineRadioOption_'.$qid[$i];
				//$ques->answer=$request->$jp_ans;
				$answer='';
				if($request->$jp_ans=='a')
					$answer=$option_a[$i];
				if($request->$jp_ans=='b')
					$answer=$option_b[$i];
				if($request->$jp_ans=='c')
					$answer=$option_c[$i];
				if($request->$jp_ans=='d')
					$answer=$option_d[$i];
				$ques->answer=$answer;
				
				$ques->question_name=$question_name[$i];
				$ques->option_a=$option_a[$i];
				$ques->option_b=$option_b[$i];
				$ques->option_c=$option_c[$i];
				$ques->option_d=$option_d[$i];
				
				$ques->complexity=$complexity[$i];
				$ques->save();
				
				//$res=QuestionTypeOneTemp::where('id',$qid[$i])->delete();
				
				}
			}
			$res1=QuestionTypeFourTemp::truncate();
			$success_msg='Fill in the Blanks Questions imported Successfully!';
		}
		if($request->filter_type_new=='true_false')
		{
			$total=$request->total;
			$branch_id=$request->branch_id;
			$subject_id=$request->subject_id;
			$lesson_id=$request->lesson_id;
			
			$question_name=$request->question_name;
			$option_a=$request->option_a;
			$option_b=$request->option_b;
			
			
			$complexity=$request->complexity;
			$qid=$request->qid;
			
			for($i=0;$i<$total;$i++)
			{
				if(isset($branch_id[$i]))
				{
				$ques=new QuestionTypeFive();
				$ques->branch_id=$branch_id[$i];
				$ques->subject_id=$subject_id[$i];
				$ques->lesson_id=$lesson_id[$i];
				$jp_ans='inlineRadioOption_'.$qid[$i];
				$ques->answer=$request->$jp_ans;
				
				$ques->question_name=$question_name[$i];
				$ques->option_a=$option_a[$i];
				$ques->option_b=$option_b[$i];
				
				$ques->complexity=$complexity[$i];
				$ques->save();
				
				//$res=QuestionTypeOneTemp::where('id',$qid[$i])->delete();
				
				}
			}
			$res1=QuestionTypeFiveTemp::truncate();
			$success_msg='True or False Questions imported Successfully!';
		}
		if($request->filter_type_new=='short_answer')
		{
			$total=$request->total;
			$branch_id=$request->branch_id;
			$subject_id=$request->subject_id;
			$lesson_id=$request->lesson_id;
			
			$question_name=$request->question_name;
			$answer=$request->answer;
			$complexity=$request->complexity;
			$qid=$request->qid;
			
			for($i=0;$i<$total;$i++)
			{
				if(isset($branch_id[$i]))
				{
				$ques=new QuestionTypeSix();
				$ques->branch_id=$branch_id[$i];
				$ques->subject_id=$subject_id[$i];
				$ques->lesson_id=$lesson_id[$i];
				
				$ques->answer=$answer[$i];
				
				$ques->question_name=$question_name[$i];
				
				$ques->complexity=$complexity[$i];
				$ques->save();
				
				//$res=QuestionTypeOneTemp::where('id',$qid[$i])->delete();
				
				}
			}
			$res1=QuestionTypeSixTemp::truncate();
			$success_msg='Short Answer - Questions imported Successfully!';
		}
		if($request->filter_type_new=='order_sequence')
		{
			$total=$request->total;
			$branch_id=$request->branch_id;
			$subject_id=$request->subject_id;
			$lesson_id=$request->lesson_id;
			$question_name=$request->question_name;
			
			$option_a=$request->option_a;
			$option_b=$request->option_b;
			$option_c=$request->option_c;
			$option_d=$request->option_d;
			
			$option_1=$request->option_1;
			$option_2=$request->option_2;
			$option_3=$request->option_3;
			$option_4=$request->option_4;
			
		
			
			$complexity=$request->complexity;
			$qid=$request->qid;
			
			for($i=0;$i<$total;$i++)
			{
				if(isset($branch_id[$i]))
				{
				$ques=new QuestionTypeSeven();
				$ques->branch_id=$branch_id[$i];
				$ques->subject_id=$subject_id[$i];
				$ques->lesson_id=$lesson_id[$i];
				$jp_ans='inlineRadio_orderOptions_'.$qid[$i];
				//$ques->answer=$request->$jp_ans;
				$answer='';
				if($request->$jp_ans=='a')
					$answer=$option_1[$i];
				if($request->$jp_ans=='b')
					$answer=$option_2[$i];
				if($request->$jp_ans=='c')
					$answer=$option_3[$i];
				if($request->$jp_ans=='d')
					$answer=$option_4[$i];
				$ques->answer=$answer;
				
				$ques->question_name=$question_name[$i];
				
				$ques->option_a=$option_a[$i];
				$ques->option_b=$option_b[$i];
				$ques->option_c=$option_c[$i];
				$ques->option_d=$option_d[$i];
				
				$ques->option_1=$option_1[$i];
				$ques->option_2=$option_2[$i];
				$ques->option_3=$option_3[$i];
				$ques->option_4=$option_4[$i];
				
		        $ques->complexity=$complexity[$i];
				$ques->save();
				
				}
			}
			$res1=QuestionTypeSevenTemp::truncate();
			$success_msg='Order & Sequencing Questions imported Successfully!';
		}
		
		return redirect()->back()->withInput(['branches'=>$branches,'subjects' => $subjects,'user_role_id' => $user_role_id,'slug'=>$slug])->withInput($request->all())->with('success', $success_msg);
	}
	public function add_question_paper_import_post(Request $request)
	{
		$request->validate([
            'branch_id' =>'required',
            'subject_id' => 'required',
            'lesson_id' => 'required',
			'filter_type'=>'required',
			'file'=>'required|mimes:xlsx'
            
        ]);
		$subjects='';
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
		$slug=$request->slug;
		$user_role_id = User::getUserRoleIdByUserId($user_id);
        //$branch_id = User::getBranchID($user_id);
		$branch_id=$request->branch_id;
        $user_role_id = User::getUserRoleIdByUserId($user_id);
        $branches = Branch::where('organization_id', $org_id)->where('type', 1)->get();
        if (!empty($branch_id)) {
            $subjects = Subject::where('branch_id', $branch_id)->where('type', 1)->get();
        }
		
		if($request->filter_type=='mcq_1')
		{
		Excel::import(new QuestionTypeOneImport($request->branch_id,$request->subject_id,$request->lesson_id),$request->file);
        }
		if($request->filter_type=='mcq_2')
		{
		Excel::import(new QuestionTypeTwoImport($request->branch_id,$request->subject_id,$request->lesson_id),$request->file);
        }
		if($request->filter_type=='match_following')
		{
		Excel::import(new QuestionTypeThreeImport($request->branch_id,$request->subject_id,$request->lesson_id),$request->file);
        }
		if($request->filter_type=='fill_blanks')
		{
		Excel::import(new QuestionTypeFourImport($request->branch_id,$request->subject_id,$request->lesson_id),$request->file);
        }
		if($request->filter_type=='true_false')
		{
		Excel::import(new QuestionTypeFiveImport($request->branch_id,$request->subject_id,$request->lesson_id),$request->file);
        }
		if($request->filter_type=='short_answer')
		{
		Excel::import(new QuestionTypeSixImport($request->branch_id,$request->subject_id,$request->lesson_id),$request->file);
        }
		if($request->filter_type=='order_sequence')
		{
		Excel::import(new QuestionTypeSevenImport($request->branch_id,$request->subject_id,$request->lesson_id),$request->file);
        }
		//return view('assessment.question_bank')->with('branches', $branches)->with('subjects', $subjects)->with('user_role_id', $user_role_id)->with('all_questions', $all_questions)->with('slug', $slug)->with('success','Data Imported!');
		return redirect()->back()->withInput(['branches'=>$branches,'subjects' => $subjects,'user_role_id' => $user_role_id,'slug'=>$slug])->withInput($request->all())->with('success', 'Questions are Successfully uploaded!');
	}
	public function clear_temp()
	{
		$res1=QuestionTypeOneTemp::truncate();
		$res2=QuestionTypeTwoTemp::truncate();
		$res3=QuestionTypeThreeTemp::truncate();
		$res4=QuestionTypeFourTemp::truncate();
		$res5=QuestionTypeFiveTemp::truncate();
		$res6=QuestionTypeSixTemp::truncate();
		$res7=QuestionTypeSevenTemp::truncate();
		return response()->json([
			'status'=>true,
			'message'=>'Temp Questions Cleared!'
			]);
	}
	public function add_question_manual_creation(Request $request)
	{
		$subjects='';
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
		$slug=$request->slug;
		$user_role_id = User::getUserRoleIdByUserId($user_id);
        //$branch_id = User::getBranchID($user_id);
		$branch_id=$request->branch_id;
        $user_role_id = User::getUserRoleIdByUserId($user_id);
        $branches = Branch::where('organization_id', $org_id)->where('type', 1)->get();
        if (!empty($branch_id)) {
            $subjects = Subject::where('branch_id', $branch_id)->where('type', 1)->get();
        }
		
		if($request->filter_type=='mcq_1')
		{
		//dd($request->all());
		 $total=count($request->questions);
			$branch_id=$request->id_branch;
			$subject_id=$request->id_subject;
			$lesson_id=$request->id_lesson;
			
			$question_name=$request->questions;
			$option_a=$request->option_a;
			$option_b=$request->option_b;
			$option_c=$request->option_c;
			$option_d=$request->option_d;
			
			$complexity=$request->complexity;
			
			
			for($i=0;$i<$total;$i++)
			{
				$ques=new QuestionTypeOne();
				$ques->branch_id=$branch_id;
				$ques->subject_id=$subject_id;
				$ques->lesson_id=$lesson_id;
				$j=$i+1;
				$jp_ans='radio_option_'.$j;
				
				if($request->$jp_ans=='a')
					$ques->answer=$option_a[$i];
				if($request->$jp_ans=='b')
					$ques->answer=$option_b[$i];
				if($request->$jp_ans=='c')
					$ques->answer=$option_c[$i];
				if($request->$jp_ans=='d')
					$ques->answer=$option_d[$i];
				
				$ques->question_name=$question_name[$i];
				$ques->option_a=$option_a[$i];
				$ques->option_b=$option_b[$i];
				$ques->option_c=$option_c[$i];
				$ques->option_d=$option_d[$i];
				
				$ques->complexity=$complexity[$i];
				$ques->save();			
				
			}
        }	
		if($request->filter_type=='mcq_2')
		{
		//dd($request->all());
			echo $total=count($request->questions);
			$branch_id=$request->id_branch;
			$subject_id=$request->id_subject;
			$lesson_id=$request->id_lesson;
			
			$question_name=$request->questions;
			$option_a=$request->option_a;
			$option_b=$request->option_b;
			$option_c=$request->option_c;
			$option_d=$request->option_d;
			
			$complexity=$request->complexity;
			
			
			for($i=0;$i<$total;$i++)
			{
				$ques=new QuestionTypeTwo();
				$ques->branch_id=$branch_id;
				$ques->subject_id=$subject_id;
				$ques->lesson_id=$lesson_id;
				$j=$i+1;
				$jp_ans='check_box_option_'.$j;
				
				$ans_arr=[];
				if(in_array('a',$request->$jp_ans))
					array_push($ans_arr,$option_a[$i]);
				if(in_array('b',$request->$jp_ans))
					array_push($ans_arr,$option_b[$i]);
				if(in_array('c',$request->$jp_ans))
					array_push($ans_arr,$option_c[$i]);
				if(in_array('d',$request->$jp_ans))
					array_push($ans_arr,$option_d[$i]);
				
				$ques->question_name=$question_name[$i];
				$ques->option_a=$option_a[$i];
				$ques->option_b=$option_b[$i];
				$ques->option_c=$option_c[$i];
				$ques->option_d=$option_d[$i];
				$ques->answer=implode(',',$ans_arr);
				$ques->complexity=$complexity[$i];
				$ques->save();			
				
			}
        }		
		if($request->filter_type=='match_following')
		{
		//dd($request->all());
		 $total=count($request->option_a);
			$branch_id=$request->id_branch;
			$subject_id=$request->id_subject;
			$lesson_id=$request->id_lesson;
			
			
			$option_a=$request->option_a;
			$option_b=$request->option_b;
			$option_c=$request->option_c;
			$option_d=$request->option_d;
			
			$option_1=$request->option_1;
			$option_2=$request->option_2;
			$option_3=$request->option_3;
			$option_4=$request->option_4;
			
			$choice_1=$request->choice_1;
			$choice_2=$request->choice_2;
			$choice_3=$request->choice_3;
			$choice_4=$request->choice_4;
			
			$complexity=$request->complexity;
			
			
			for($i=0;$i<$total;$i++)
			{
				$ques=new QuestionTypeThree();
				$ques->branch_id=$branch_id;
				$ques->subject_id=$subject_id;
				$ques->lesson_id=$lesson_id;
				$j=$i+1;
				$jp_ans='inlineRadioOptions_match_'.$j;
				
				if($request->$jp_ans=='a')
					$ques->answer=$choice_1[$i];
				if($request->$jp_ans=='b')
					$ques->answer=$choice_2[$i];
				if($request->$jp_ans=='c')
					$ques->answer=$choice_3[$i];
				if($request->$jp_ans=='d')
					$ques->answer=$choice_4[$i];				
				
				$ques->option_a=$option_a[$i];
				$ques->option_b=$option_b[$i];
				$ques->option_c=$option_c[$i];
				$ques->option_d=$option_d[$i];
				
				$ques->option_1=$option_1[$i];
				$ques->option_2=$option_2[$i];
				$ques->option_3=$option_3[$i];
				$ques->option_4=$option_4[$i];
				
				$ques->choice_1=$choice_1[$i];
				$ques->choice_2=$choice_2[$i];
				$ques->choice_3=$choice_3[$i];
				$ques->choice_4=$choice_4[$i];
				
				$ques->complexity=$complexity[$i];
				$ques->save();			
				
			}
        }	
		if($request->filter_type=='fill_blanks')
		{
		//dd($request->all());
		 $total=count($request->questions);
			$branch_id=$request->id_branch;
			$subject_id=$request->id_subject;
			$lesson_id=$request->id_lesson;
			
			$question_name=$request->questions;
			$option_a=$request->option_a;
			$option_b=$request->option_b;
			$option_c=$request->option_c;
			$option_d=$request->option_d;
			
			$complexity=$request->complexity;
			
			
			for($i=0;$i<$total;$i++)
			{
				$ques=new QuestionTypeFour();
				$ques->branch_id=$branch_id;
				$ques->subject_id=$subject_id;
				$ques->lesson_id=$lesson_id;
				$j=$i+1;
				$jp_ans='radio_option_'.$j;
				
				if($request->$jp_ans=='a')
					$ques->answer=$option_a[$i];
				if($request->$jp_ans=='b')
					$ques->answer=$option_b[$i];
				if($request->$jp_ans=='c')
					$ques->answer=$option_c[$i];
				if($request->$jp_ans=='d')
					$ques->answer=$option_d[$i];
				
				$ques->question_name=$question_name[$i];
				$ques->option_a=$option_a[$i];
				$ques->option_b=$option_b[$i];
				$ques->option_c=$option_c[$i];
				$ques->option_d=$option_d[$i];
				
				$ques->complexity=$complexity[$i];
				$ques->save();			
				
			}
        }	
		if($request->filter_type=='true_false')
		{
		//dd($request->all());
		 $total=count($request->questions);
			$branch_id=$request->id_branch;
			$subject_id=$request->id_subject;
			$lesson_id=$request->id_lesson;
			
			$question_name=$request->questions;
			$option_a=$request->option_a;
			$option_b=$request->option_b;
			
			
			$complexity=$request->complexity;
			
			
			for($i=0;$i<$total;$i++)
			{
				$ques=new QuestionTypeFive();
				$ques->branch_id=$branch_id;
				$ques->subject_id=$subject_id;
				$ques->lesson_id=$lesson_id;
				$j=$i+1;
				$jp_ans='radio_option_'.$j;
				
				if($request->$jp_ans=='a')
					$ques->answer=$option_a[$i];
				if($request->$jp_ans=='b')
					$ques->answer=$option_b[$i];
			
				
				$ques->question_name=$question_name[$i];
				$ques->option_a=$option_a[$i];
				$ques->option_b=$option_b[$i];
				
				
				$ques->complexity=$complexity[$i];
				$ques->save();			
				
			}
        }	
		if($request->filter_type=='short_answer')
		{
		//dd($request->all());
		 $total=count($request->questions);
			$branch_id=$request->id_branch;
			$subject_id=$request->id_subject;
			$lesson_id=$request->id_lesson;
			
			$question_name=$request->questions;
			$answer=$request->answers;
			$complexity=$request->complexity;
			
			
			for($i=0;$i<$total;$i++)
			{
				$ques=new QuestionTypeSix();
				$ques->branch_id=$branch_id;
				$ques->subject_id=$subject_id;
				$ques->lesson_id=$lesson_id;
				
				$ques->question_name=$question_name[$i];
				$ques->answer=$answer[$i];
				$ques->complexity=$complexity[$i];
				$ques->save();			
				
			}
        }	
		if($request->filter_type=='order_sequence')
		{
		//dd($request->all());
		 $total=count($request->option_a);
			$branch_id=$request->id_branch;
			$subject_id=$request->id_subject;
			$lesson_id=$request->id_lesson;
			
			$question_name=$request->question_name;
			$option_a=$request->option_a;
			$option_b=$request->option_b;
			$option_c=$request->option_c;
			$option_d=$request->option_d;
			
			$option_1=$request->option_1;
			$option_2=$request->option_2;
			$option_3=$request->option_3;
			$option_4=$request->option_4;
			$complexity=$request->complexity;
			
			for($i=0;$i<$total;$i++)
			{
				$ques=new QuestionTypeSeven();
				$ques->branch_id=$branch_id;
				$ques->subject_id=$subject_id;
				$ques->lesson_id=$lesson_id;
				$j=$i+1;
				$jp_ans='inlineRadio_orderOptions_'.$j;
				if($request->$jp_ans=='a')
					$ques->answer=$option_1[$i];
				if($request->$jp_ans=='b')
					$ques->answer=$option_2[$i];
				if($request->$jp_ans=='c')
					$ques->answer=$option_3[$i];
				if($request->$jp_ans=='d')
					$ques->answer=$option_4[$i];
				
				$ques->question_name=$question_name[$i];				
				
				$ques->option_a=$option_a[$i];
				$ques->option_b=$option_b[$i];
				$ques->option_c=$option_c[$i];
				$ques->option_d=$option_d[$i];
				
				$ques->option_1=$option_1[$i];
				$ques->option_2=$option_2[$i];
				$ques->option_3=$option_3[$i];
				$ques->option_4=$option_4[$i];
				
				$ques->complexity=$complexity[$i];
				$ques->save();			
				
			}
        }	
				
		return redirect()->back()->withInput(['branches'=>$branches,'subjects' => $subjects,'user_role_id' => $user_role_id,'slug'=>$slug])->withInput($request->all())->with('success', 'Questions Added!');
	}
	public function get_subjects_by_branch_id(Request $request)
	{
		$branch_id=$request->branch_id;
		$subjects=[];
		if(is_numeric($branch_id))
		{
			
		$subject_list=Subject::where('branch_id',$branch_id)->where('type',1)->get();
		$subjects=[];
		if($subject_list)
		{
			foreach($subject_list as $subject)
			{
				$subject_id=$subject->id;
				$subject=Subject::find($subject_id);
				$subjects[]=array(
				'subject_id'=>$subject_id,
				'subject_name'=>$subject->subject_name
				);
			}

		}
		}
		return response()->json(['subjects'=>$subjects]);
	}
	public function create_exam()
    {
		$user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $branch_id = User::getBranchID($user_id);
        if (!empty($branch_id)) {
            $class_rooms = ClassRooms::where('type',1)->where('organisation_id', $org_id)->where('branch_id',$branch_id)->orderBy('created_at', 'DESC')->get();
        } else {
            $class_rooms = ClassRooms::where('type',1)->where('organisation_id', $org_id)->orderBy('created_at', 'DESC')->get();
        }
        return view('assessment.add_exam',["class_rooms" => $class_rooms]);
    }
	public function get_lessons_by_subjects_id(Request $request)
	{
		$subject_id=$request->subject_id;
		$lessons=Lesson::where('subject_id',$subject_id)->where('type',1)->get();
		return response()->json(['lessons'=>$lessons]);
	}	
	/*public function clear_one_question_temp(Request $request)
	{
		$id=$request->id;
		$type=$request->type;
		if($type=='mcq_1')
		$res=QuestionTypeOneTemp::where('id',$id)->delete();
		if($type=='mcq_2')
		$res=QuestionTypeTwoTemp::where('id',$id)->delete();
		return response()->json(['status'=>true,'message'=>'Question Deleted']);
	}  */
	public function post_exam_one(Request $request)
	{
		dd($request);
	}
  
    public function list_question(Request $request)
    {
        $subjects = '';
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $branch_id = User::getBranchID($user_id);
        $user_role_id = User::getUserRoleIdByUserId($user_id);
        $branches = Branch::where('organization_id', $org_id)->where('type', 1)->get();
        if (!empty($branch_id)) {
            $subjects = Subject::where('organization_id', $org_id)->where('branch_id', $branch_id)->where('type', 1);
        }


        if ($request->question_type == 'mcq_1') {
            if (!empty($request->branch_id)) {
                $list_question_type_one = QuestionTypeOne::where('branch_id', $request->branch_id)->where('subject_id', $request->subject_id)
                    ->where('lesson_id', $request->lesson_id)->where('complexity', $request->complexity)->where('type',1)->get();
                    return response()->json(['list_question_type_one' => $list_question_type_one,'question_type' => $request->question_type]);
            }else{
                $list_question_type_one = QuestionTypeOne::where('subject_id', $request->subject_id)
                    ->where('lesson_id', $request->lesson_id)->where('complexity', $request->complexity)->where('type',1)->get();
                    return response()->json(['list_question_type_one' => $list_question_type_one,'question_type' => $request->question_type]);
            }
        }

        if ($request->question_type == 'mcq_2') {
            if (!empty($request->branch_id)) {
                $list_question_type_two = QuestionTypeTwo::where('branch_id', $request->branch_id)->where('subject_id', $request->subject_id)
                    ->where('lesson_id', $request->lesson_id)->where('complexity', $request->complexity)->where('type',1)->get();
                    return response()->json(['list_question_type_two'=> $list_question_type_two,'question_type' => $request->question_type]);
            }else{
                $list_question_type_two = QuestionTypeTwo::where('subject_id', $request->subject_id)
                    ->where('lesson_id', $request->lesson_id)->where('complexity', $request->complexity)->where('type',1)->get();
                return response()->json(['list_question_type_two'=> $list_question_type_two,'question_type' => $request->question_type]);
            }
        }

        if ($request->question_type == 'match_following') {
            if (!empty($request->branch_id)) {
                $list_question_type_Three = QuestionTypeThree::where('branch_id', $request->branch_id)->where('subject_id', $request->subject_id)
                    ->where('lesson_id', $request->lesson_id)->where('complexity', $request->complexity)->where('type',1)->get();
					return response()->json(['list_question_type_three'=> $list_question_type_Three,'question_type' => $request->question_type]);
            }else{
                $list_question_type_Three = QuestionTypeThree::where('subject_id', $request->subject_id)
                    ->where('lesson_id', $request->lesson_id)->where('complexity', $request->complexity)->where('type',1)->get();
                return response()->json(['list_question_type_three'=> $list_question_type_Three,'question_type' => $request->question_type]);
            }
        }

        if ($request->question_type == 'fill_blanks') {
            if (!empty($request->branch_id)) {
                $list_question_type_four = QuestionTypeFour::where('branch_id', $request->branch_id)->where('subject_id', $request->subject_id)
                    ->where('lesson_id', $request->lesson_id)->where('complexity', $request->complexity)->where('type',1)->get();
					return response()->json(['list_question_type_four'=> $list_question_type_four,'question_type' => $request->question_type]);
            }else{
                $list_question_type_four = QuestionTypeFour::where('subject_id', $request->subject_id)
                    ->where('lesson_id', $request->lesson_id)->where('complexity', $request->complexity)->where('type',1)->get();
                return response()->json(['list_question_type_four'=> $list_question_type_four,'question_type' => $request->question_type]);
            }
        }

        if ($request->question_type == 'true_false') {
            if (!empty($request->branch_id)) {
                $list_question_type_five = QuestionTypeFive::where('branch_id', $request->branch_id)->where('subject_id', $request->subject_id)
                    ->where('lesson_id', $request->lesson_id)->where('complexity', $request->complexity)->where('type',1)->get();
					return response()->json(['list_question_type_five'=> $list_question_type_five,'question_type' => $request->question_type]);
            }else{
                $list_question_type_five = QuestionTypeFive::where('subject_id', $request->subject_id)
                    ->where('lesson_id', $request->lesson_id)->where('complexity', $request->complexity)->where('type',1)->get();
                return response()->json(['list_question_type_five'=> $list_question_type_five,'question_type' => $request->question_type]);
            }
        }

    }
    public function edit_question_type_one(Request $request){
        $question = QuestionTypeOne::find($request->question_id);
        $question->question_name=$request->question;
        $question->option_a=$request->option_a;
        $question->option_b=$request->option_b;
        $question->option_c=$request->option_c;
        $question->option_d=$request->option_d;

        if($request->inlineRadioOptions == 'a'){
            $question->answer = $request->option_a;
        }
        if($request->inlineRadioOptions == 'b'){
            $question->answer = $request->option_b;
        }
        if($request->inlineRadioOptions == 'c'){
            $question->answer = $request->option_c;
        }
        if($request->inlineRadioOptions == 'd'){
            $question->answer = $request->option_d;
        }

        $question->complexity = $request->complexity;

        $question->save();
        return back()->with('success','Question updated successfully!');
    }

    public function suspend_question_type_one(Request $request){
        $question = QuestionTypeOne::find($request->question_id);
        if($question->type == 1){
            $question->type = 2;
            $question->save();
            return back()->with('success','Question deleted successfully!');
        }
    }

    public function edit_question_type_two(Request $request){

        $question = QuestionTypeTwo::find($request->question_id);
        $question->question_name=$request->question;
        $question->option_a=$request->option_a;
        $question->option_b=$request->option_b;
        $question->option_c=$request->option_c;
        $question->option_d=$request->option_d;


        $ans_arr=[];
				if($request->check1 == 'a')
					array_push($ans_arr,$request->option_a);
				if($request->check2 == 'b')
                array_push($ans_arr,$request->option_b);
				if($request->check3 == 'c')
                array_push($ans_arr,$request->option_c);
				if($request->check4 == 'd')
                array_push($ans_arr,$request->option_d);

        $question->answer=implode(',',$ans_arr);
        $question->complexity = $request->complexity;

        $question->save();
        return back()->with('success','Question updated successfully!');
    }

    public function suspend_question_type_two(Request $request){
        $question = QuestionTypeTwo::find($request->question_id);
        if($question->type == 1){
            $question->type = 2;
            $question->save();
            return back()->with('success','Question deleted successfully!');
        }
    }

    public function edit_question_type_three(Request $request){
        $question = QuestionTypeThree::find($request->question_id);

        $question->option_a=$request->option_a;
        $question->option_b=$request->option_b;
        $question->option_c=$request->option_c;
        $question->option_d=$request->option_d;

        $question->option_1=$request->option_1;
        $question->option_2=$request->option_2;
        $question->option_3=$request->option_3;
        $question->option_4=$request->option_4;

        $question->choice_1=$request->choice_1;
        $question->choice_2=$request->choice_2;
        $question->choice_3=$request->choice_3;
        $question->choice_4=$request->choice_4;

        if($request->inlineRadioOptions == 'a'){
            $question->answer = $request->choice_1;
        }
        if($request->inlineRadioOptions == 'b'){
            $question->answer = $request->choice_2;
        }
        if($request->inlineRadioOptions == 'c'){
            $question->answer = $request->choice_3;
        }
        if($request->inlineRadioOptions == 'd'){
            $question->answer = $request->choice_4;
        }

        $question->complexity = $request->complexity;

        $question->save();
        return back()->with('success','Question updated successfully!');
    }

    public function suspend_question_type_three(Request $request){
        $question = QuestionTypeThree::find($request->question_id);
        if($question->type == 1){
            $question->type = 2;
            $question->save();
            return back()->with('success','Question deleted successfully!');
        }
    }

    public function edit_question_type_four(Request $request){
        $question = QuestionTypeFour::find($request->question_id);
        $question->question_name=$request->question;
        $question->option_a=$request->option_a;
        $question->option_b=$request->option_b;
        $question->option_c=$request->option_c;
        $question->option_d=$request->option_d;

        if($request->inlineRadioOptions == 'a'){
            $question->answer = $request->option_a;
        }
        if($request->inlineRadioOptions == 'b'){
            $question->answer = $request->option_b;
        }
        if($request->inlineRadioOptions == 'c'){
            $question->answer = $request->option_c;
        }
        if($request->inlineRadioOptions == 'd'){
            $question->answer = $request->option_d;
        }

        $question->complexity = $request->complexity;

        $question->save();
        return back()->with('success','Question updated successfully!');
    }

    public function suspend_question_type_four(Request $request){
        $question = QuestionTypeFour::find($request->question_id);
        if($question->type == 1){
            $question->type = 2;
            $question->save();
            return back()->with('success','Question deleted successfully!');
        }
    }

    public function edit_question_type_five(Request $request){
        $question = QuestionTypeFive::find($request->question_id);

        $question->question_name=$request->question;
        $question->option_a=$request->option_a;
        $question->option_b=$request->option_b;

        if($request->inlineRadioOptions == 'a'){
            $question->answer = $request->option_a;
        }
        if($request->inlineRadioOptions == 'b'){
            $question->answer = $request->option_b;
        }

        $question->complexity = $request->complexity;

        $question->save();
        return back()->with('success','Question updated successfully!');
    }

    public function suspend_question_type_five(Request $request){
        $question = QuestionTypeFive::find($request->question_id);
        if($question->type == 1){
            $question->type = 2;
            $question->save();
            return back()->with('success','Question deleted successfully!');
        }
    }
}