<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPrivilege extends Model
{
    use HasFactory;
    protected $table = 'user_privileges';

    public static function getPrivilegesByUserId($user_id){
        return UserPrivilege::where('user_id', $user_id)->pluck('privileges')->first();
    }
}
