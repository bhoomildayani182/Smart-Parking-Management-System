<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'city';

    protected $fillable = ['name', 'country_id','state_id' ,'status', 'created_at', 'updated_at', 'deleted_at', 'deleted_by', 'created_by' , 'updated_by'];

    public function state()
    {
        return $this->hasone(State::class, 'id', 'state_id');
    }
}
