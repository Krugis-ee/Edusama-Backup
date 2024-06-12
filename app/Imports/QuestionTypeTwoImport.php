<?php

namespace App\Imports;

use App\Models\QuestionTypeTwoTemp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionTypeTwoImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
	protected $branch_id;
	protected $subject_id;
	protected $lesson_id;


public function __construct($branch_id,$subject_id, $lesson_id)
{
	$this->branch_id = $branch_id;
    $this->subject_id = $subject_id;
    $this->lesson_id = $lesson_id;
}
    public function model(array $row)
    {
		$branch_id = $this->branch_id;
		$subject_id = $this->subject_id;
		$lesson_id = $this->lesson_id;
		
		$answer='';
		$final_answer_arr=[];
		$answer_array=explode(',',$row['answer']);
		if (in_array("A", $answer_array))
			array_push($final_answer_arr,$row['option_a']);
		if (in_array("B", $answer_array))
			array_push($final_answer_arr,$row['option_b']);
		if (in_array("C", $answer_array))
			array_push($final_answer_arr,$row['option_c']);
		if (in_array("D", $answer_array))
			array_push($final_answer_arr,$row['option_d']);
		$answer=implode(',',$final_answer_arr);
		
		
		
        return new QuestionTypeTwoTemp([
			'branch_id'=>$branch_id,
			'subject_id'=>$subject_id,
			'lesson_id'=>$lesson_id,
            'question_name'=>$row['question_name'],
			'option_a'=>$row['option_a'],
			'option_b'=>$row['option_b'],
			'option_c'=>$row['option_c'],
			'option_d'=>$row['option_d'],
			'complexity'=>$row['complexity'],
			'answer'=>$answer
        ]);
    }
}
