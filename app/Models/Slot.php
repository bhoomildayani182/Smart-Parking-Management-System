<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slot extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'slot';

    protected $fillable = [
        "start_time",
        "end_time",
        "duration",
        "status",
        "parking_id",
    ];

}
