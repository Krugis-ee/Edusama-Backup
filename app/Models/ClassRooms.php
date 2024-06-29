<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRooms extends Model
{
    use HasFactory;
	protected $table = 'class_rooms';

    public static function getBranchIDByClassRoomId($id){
        return ClassRooms::where('id',$id)->pluck('branch_id')->first();
    }
	public static function getClassRoomDetail($id){
        return ClassRooms::find($id);
    }
    public static function getClassRoomNameById($id){
        return ClassRooms::where('id',$id)->pluck('class_room_name')->first();
    }
}