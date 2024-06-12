<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_role'
    ];
    public static function getRoleNameByID($id){
        return UserRole::where('id', $id)->pluck('role_name')->first();
    }
    public static function getUsersByRoleID($id){
      
    $user_id = session()->get('loginId');
    $org_id = User::getOrganizationId($user_id);  
    return User::where('user_role_id', $id)->where('organization_id',$org_id)->where('type',1)->get();
    }
}
