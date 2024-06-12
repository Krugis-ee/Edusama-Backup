<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTypeSeven extends Model
{
    use HasFactory;
	protected $table = 'question_type_seven';
	protected $fillable = [
		'branch_id',
		'subject_id',
		'lesson_id',
        'question_name',
        'option_a',
        'option_b',
      	'option_c',
        'option_d',
		'option_1',
        'option_2',
      	'option_3',
        'option_4',
		'complexity',
        'answer'
    ];
}
