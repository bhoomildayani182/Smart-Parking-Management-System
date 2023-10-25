<?php

namespace App\Models;

use App\Constants\IBDConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class DriverAndCleaner extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'driver_and_cleaner';

    protected $fillable = ['name', 'mobile', 'email_ID', 'Gender', 'address', 'city', 'state', 'country', 'pincode', 'document_type', 'document_number', 'document_file_id', 'designation', 'is_active', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];

    public function vehicle(){
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id');
    }
    public function slot(){
        return $this->hasOne(Slot::class, 'id', 'slot_id');
    }

    public function driver(){
        return $this->hasOne(Slot::class, 'id', 'driver_id');
    }

    // public function cleaners(){
    //     return $this->hasOne(Slot::class, 'id')->where('designation', "DRIVER");
    // }
}