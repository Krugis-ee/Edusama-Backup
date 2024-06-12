<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    use HasFactory;
    public static function getUserNameByID($id){
        return SuperAdmin::where('id', $id)->pluck('name')->first();
    }
}
