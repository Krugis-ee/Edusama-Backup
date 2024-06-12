<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTypeTwoTemp extends Model
{
    use HasFactory;
	protected $table = 'question_type_two_temp';
	protected $fillable = [
		'branch_id',
		'subject_id',
		'lesson_id',
        'question_name',
        'option_a',
        'option_b',
      	'option_c',
        'option_d',
        'complexity',
        'answer'
    ];
}
