<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $table = 'branches';
    
    public static function getBranchNameByBranchId($id){
        return Branch::where('id', $id)->pluck('branch_name')->first();
    }
}
