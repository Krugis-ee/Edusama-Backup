<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code'
    ];
  
    public static function getCountryNameAndCodeById($id)
    {
        if (!empty($id))
            return Country::where('id', $id)->pluck('name')->first() . '-' . Country::where('id', $id)->pluck('shortname')->first();
        else
            return ('');
    }
}
