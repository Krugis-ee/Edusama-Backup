<?php

namespace App\Imports;

use App\Models\QuestionTypeSixTemp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionTypeSixImport implements ToModel,WithHeadingRow
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
		
		return new QuestionTypeSixTemp([
			'branch_id'=>$branch_id,
			'subject_id'=>$subject_id,
			'lesson_id'=>$lesson_id,
            'question_name'=>$row['question_name'],
			'complexity'=>$row['complexity'],
			'answer'=>$row['answer']
        ]);
    }
}
