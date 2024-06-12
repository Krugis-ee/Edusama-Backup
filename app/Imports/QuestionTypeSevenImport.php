<?php

namespace App\Imports;

use App\Models\QuestionTypeSevenTemp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionTypeSevenImport implements ToModel,WithHeadingRow
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
		
		if($row['question_name']!=Null)
		{
        return new QuestionTypeSevenTemp([
			'branch_id'=>$branch_id,
			'subject_id'=>$subject_id,
			'lesson_id'=>$lesson_id,
            'question_name'=>$row['question_name'],
			'option_a'=>$row['option_a'],
			'option_b'=>$row['option_b'],
			'option_c'=>$row['option_c'],
			'option_d'=>$row['option_d'],
			'option_1'=>$row['option_1'],
			'option_2'=>$row['option_2'],
			'option_3'=>$row['option_3'],
			'option_4'=>$row['option_4'],			
			'complexity'=>$row['complexity'],
			'answer'=>$row['answer']
        ]);
		}
    }
}
