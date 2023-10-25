<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumberPlate extends Model
{
    use HasFactory;

    protected $table = 'number_plate';

    protected $fillable = [
        'group_of_letter',
        'state_id',
        'state_name',
        'city_id',
        'city_name',
        'city_number',
        'created_by',
    ];


}
