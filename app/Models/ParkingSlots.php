<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParkingSlots extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'parking_slots';

    protected $fillable = ['zone', 'section', 'parking_slot', 'name', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at', 'parking_id'];

}
