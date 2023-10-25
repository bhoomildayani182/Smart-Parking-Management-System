<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','slug'
    ];

    public function permissions() {

        return $this->belongsToMany(Permission::class,'roles_permissions');

     }

     public function users() {

        return $this->belongsToMany(User::class,'users_roles');

     }

    //  public function setSlugAttribute(){
    //     $this->attributes['slug'] = Str::slug($this->name);
    // }

    protected static function boot() {
        parent::boot();

        static::creating(function ($attribute) {
            $attribute->slug = Str::slug($attribute->title);
        });
    }
}
