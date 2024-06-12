<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoomTimings extends Model
{
    use HasFactory;
	protected $table = 'class_room_timings';
  
  public static function getTimings($id){
        return ClassRoomTimings::where('class_room_id', $id)->get();
    }
}
