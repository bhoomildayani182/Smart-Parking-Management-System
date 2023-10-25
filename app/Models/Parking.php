<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parking extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'parking';
    
    protected $fillable = ['parking_name', 'address', 'city', 'state', 'country', 'pincode', 'manager_name', 'manager_mobile_number', 'manager_email', 'document_number', 'document_file_id', 'document_type', 'status', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at'];

}
