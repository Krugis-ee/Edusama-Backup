<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentProgress extends Model
{
    use HasFactory;
	protected $table = 'assignments_progress';
  
    public static function getAssignmentDownloadStatusByAssignmentId($ass_id,$stud_id){
        return AssignmentProgress::where('assignment_id', $ass_id)->where('student_id',$stud_id)->pluck('assignment_download_status')->first();
    }
    public static function getAnswerPdfByAssignmentId($ass_id,$stud_id){
        return AssignmentProgress::where('assignment_id', $ass_id)->where('student_id',$stud_id)->pluck('answer_pdf')->first();
    }
    public static function getAnswerResponseStatusByAssignmentId($ass_id,$stud_id){
        return AssignmentProgress::where('assignment_id', $ass_id)->where('student_id',$stud_id)->pluck('answer_response_status')->first();
    }

    public static function getAnswerScore($ass_id,$stud_id){
        return AssignmentProgress::where('assignment_id', $ass_id)->where('student_id',$stud_id)->pluck('score')->first();
    }

    public static function getAnswerScoreComment($ass_id,$stud_id){
        return AssignmentProgress::where('assignment_id', $ass_id)->where('student_id',$stud_id)->pluck('score_comment')->first();
    }

    public static function getAssignmentSubmittedDate($ass_id,$stud_id){
        return AssignmentProgress::where('assignment_id', $ass_id)->where('student_id',$stud_id)->pluck('answer_submitted_date')->first();
    }
    public static function getStudentIdByAssignmentId($ass_id){
        return AssignmentProgress::where('assignment_id', $ass_id)->pluck('student_id')->first();
    }
}
