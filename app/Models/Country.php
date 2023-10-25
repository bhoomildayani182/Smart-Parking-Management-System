<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'countries';
    
    protected $fillable = ['name', 'status', 'created_at', 'updated_at', 'deleted_at', 'deleted_by', 'created_by', 'updated_by'];
}
