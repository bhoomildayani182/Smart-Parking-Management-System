<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vehicle';
    
    protected $fillable = ['vehicle_model_id', 'vehicle_number', 'driver_id', 'cleaner_id', 'city', 'state', 'country', 'pincode', 'created_by', 'updated_by', 'deleted_by', 'deleted_at', 'created_at', 'updated_at'];

    public function driver(){
        return $this->hasOne(DriverAndCleaner::class, 'id', 'driver_id')->where('designation', "DRIVER");
    }
}
