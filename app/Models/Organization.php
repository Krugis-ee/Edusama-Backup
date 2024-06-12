<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $table = 'organizations';
    protected $fillable = [
        "name",
        "email",
        "url",
        "color",
        "logo",
    ];

    protected $casts = [
        'start_date' => 'datetime:Y-m-d',
        'end_date'   => 'datetime:Y-m-d',
        'is_active'  => 'boolean',
    ];
    public static function getOrgNameByID($id){
        return Organization::where('id', $id)->pluck('name')->first();
    }
    public static function getOrgColorByID($id){
        return Organization::where('id', $id)->pluck('color')->first();
    }
    public static function getOrgLogoByID($id){
        return Organization::where('id', $id)->pluck('logo')->first();
    }
}
