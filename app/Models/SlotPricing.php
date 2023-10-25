<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SlotPricing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'slot_pricing';

    protected $fillable = [
        "slot_id",
        "vehicle_model_id",
        "price",
        "day"
    ];

    public function vehicle_model()
    {
        return $this->hasone(VehicleModel::class, 'id', 'vehicle_model_id');
    }

    public function slot()
    {
        return $this->hasone(Slot::class, 'id', 'slot_id');
    }
}
