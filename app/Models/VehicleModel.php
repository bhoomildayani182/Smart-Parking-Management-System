<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'vehicle_model';

    protected $fillable = [
        "maker_name",
        "model_number",
        "company_name",
        "type",
        "year",
        "description",
        "status"
    ];


}
