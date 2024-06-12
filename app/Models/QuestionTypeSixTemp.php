<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTypeSixTemp extends Model
{
    use HasFactory;
	protected $table = 'question_type_six_temp';
	protected $fillable = [
		'branch_id',
		'subject_id',
		'lesson_id',
        'question_name',
        'complexity',
        'answer'
    ];
}
