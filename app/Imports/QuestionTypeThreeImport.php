<?php

namespace App\Imports;

use App\Models\QuestionTypeThreeTemp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionTypeThreeImport implements ToModel,WithHeadingRow
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
		if (!empty($row['question_type_three']) && $row['question_type_three'] == 3) {

            $branch_id = $this->branch_id;
            $subject_id = $this->subject_id;
            $lesson_id = $this->lesson_id;
            $answer = '';
            if ($row['answer'] == 'A')
                $answer = $row['choice_1'];
            if ($row['answer'] == 'B')
                $answer = $row['choice_2'];
            if ($row['answer'] == 'C')
                $answer = $row['choice_3'];
            if ($row['answer'] == 'D')
                $answer = $row['choice_4'];

            return new QuestionTypeThreeTemp([
                'branch_id' => $branch_id,
                'subject_id' => $subject_id,
                'lesson_id' => $lesson_id,

                'question_name' => $row['question_name'],

                'option_a' => $row['option_a'],
                'option_b' => $row['option_b'],
                'option_c' => $row['option_c'],
                'option_d' => $row['option_d'],
                'option_1' => $row['option_1'],
                'option_2' => $row['option_2'],
                'option_3' => $row['option_3'],
                'option_4' => $row['option_4'],
                'choice_1' => $row['choice_1'],
                'choice_2' => $row['choice_2'],
                'choice_3' => $row['choice_3'],
                'choice_4' => $row['choice_4'],
                'complexity' => $row['complexity'],
                'answer' => $answer
            ]);
        } else {
            return '';
        }
    }
}
