<?php

namespace App\Imports;

use App\Models\QuestionTypeFiveTemp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionTypeFiveImport implements ToModel,WithHeadingRow
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
		if (!empty($row['question_type_five']) && $row['question_type_five'] == 5) {

            $branch_id = $this->branch_id;
            $subject_id = $this->subject_id;
            $lesson_id = $this->lesson_id;

            $answer = '';
            if ($row['answer'])
                $answer = 'TRUE';
            else
                $answer = 'FALSE';

            return new QuestionTypeFiveTemp([
                'branch_id' => $branch_id,
                'subject_id' => $subject_id,
                'lesson_id' => $lesson_id,
                'question_name' => $row['question_name'],
                'option_a' => 'TRUE',
                'option_b' => 'FALSE',
                'complexity' => $row['complexity'],
                'answer' => $answer
            ]);
        } else {
            return '';
        }
    }
}
