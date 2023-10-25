<?php

namespace App\Models;

use App\Constants\IBDConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class EntryBooking extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'booking';

    protected $fillable = ['slot_id', 'slot_pricing_id', 'price', 'vehicle_id', 'vehicle_model_id', 'driver_id', 'payment_mode', 'payment_id', 'driver_name', 'parking_space_id', 'date', 'number_of_peron', 'extra_amount', 'status', 'total_amount', 'created_by', 'updated_by', 'deleted_by', 'deleted_at', 'created_at', 'updated_at', 'entry_time', 'exit_time', 'parking_id'];

    public function vehicle(){
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id');
    }
    public function slot(){
        return $this->hasOne(Slot::class, 'id', 'slot_id');
    }

    public function driver(){
        return $this->hasOne(DriverAndCleaner::class, 'id', 'driver_id')->where('designation', "DRIVER");
    }

    public function vehicleModel(){
        return $this->hasOne(VehicleModel::class, 'id', 'vehicle_model_id');
    }

    public function parkingSpace() {
        return $this->hasOne(ParkingSlotDetails::class, 'id', 'parking_space_id');
    }

}