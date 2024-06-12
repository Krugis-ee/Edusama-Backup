<?php

namespace App\Imports;

use App\Models\QuestionTypeOneTemp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionTypeOneImport implements ToModel,WithHeadingRow
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
		if($row['answer']=='A')
			$answer=$row['option_a'];
		if($row['answer']=='B')
			$answer=$row['option_b'];
		if($row['answer']=='C')
			$answer=$row['option_c'];
		if($row['answer']=='D')
			$answer=$row['option_d'];
		
        return new QuestionTypeOneTemp([
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
