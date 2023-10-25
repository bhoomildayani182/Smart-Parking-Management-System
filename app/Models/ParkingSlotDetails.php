<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParkingSlotDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'parking_slot_details';

    protected $fillable = ['space_name', 'slot_id', 'is_booked', 'slot_pricing_id', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];

    public function slot()
    {
        return $this->hasone(ParkingSlots::class, 'id', 'slot_id');
    }
}
