<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'states';
    
    protected $fillable = ['name', 'country_id' ,'status', 'created_at', 'updated_at', 'deleted_at', 'deleted_by', 'created_by' , 'updated_by'];

    public function country()
    {
        return $this->hasone(Country::class, 'id', 'country_id');
    }
}
