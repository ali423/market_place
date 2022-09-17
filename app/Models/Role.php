<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory,UuidTrait;

    protected $fillable = ['title'];

    public function permissions() : BelongsToMany
    {
        return $this->belongsToMany(Permission::class,'role_permissions')->withTimestamps();
    }
    public function havePermission($permission) : bool
    {
        return $this->permissions()->where('title',$permission)->exists();
    }

    public function users() : HasMany
    {
        return $this->hasMany(User::class);
    }
}
