<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subjects';
	
	public static function getSubjectNameBySubjectID($id){
        return Subject::where('id', $id)->pluck('subject_name')->first();
    }
}
