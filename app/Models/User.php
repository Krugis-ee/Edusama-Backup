<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
      	'first_name',
        'last_name',
        'type',
        'organization_id',
        'branch_id',
        'user_role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
      	'birth_date' =>'datetime'
    ];
    public static function getRoleID($id){
        return User::where('id', $id)->pluck('user_role_id')->first();
    }

    public static function getSiteConfigs($id){
        return User::where('id', $id)->pluck('siteconfig')->first();
    }
    public static function getStatus($id){
        return User::where('id', $id)->pluck('type')->first();
    }
    public static function getUserNameByID($id){
        return User::where('id', $id)->pluck('name')->first();
    }
    public static function getUserRoleNameByID($id){
        $role_id = User::where('id', $id)->pluck('user_role_id')->first();
        $role=UserRole::find($role_id);
        if($role)
        return $role->role_name;
        else
        return '';
    }
    public static function getOrganizationID($id){
        return User::where('id', $id)->pluck('organization_id')->first();
    }
    public static function getBranchID($id){
        return User::where('id', $id)->pluck('branch_id')->first();
    }
    public static function getOrgAdminNameById($id){
        return User::where('id', $id)->pluck('name')->first();
    }
    public static function getParentNameByParentID($id){
        return User::where('id', $id)->pluck('first_name')->first().' '.User::where('id', $id)->pluck('last_name')->first();
    }
	public static function getStudentNameByID($id){
        return User::where('id', $id)->pluck('first_name')->first().' '.User::where('id', $id)->pluck('last_name')->first();
    }
	public static function getUserRoleIdByUserId($id){
        return User::where('id',$id)->pluck('user_role_id')->first();
    }
	public static function getStudentAvatarById($id){
        return User::where('id',$id)->pluck('student_avatar')->first();
    }

    public static function getTeacherAvatarById($id){
        return User::where('id',$id)->pluck('Teacher_avatar')->first();
    }
    public static function getTeacherNameByID($id){
        return User::where('id', $id)->pluck('first_name')->first().' '.User::where('id', $id)->pluck('last_name')->first();
    }
}
