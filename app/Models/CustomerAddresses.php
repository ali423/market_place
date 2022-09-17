<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomerAddresses extends Model
{
    use HasFactory,UuidTrait;

    protected $fillable = [
        'address',
        'lat',
        'lng',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function orders() : HasMany
    {
        return  $this->hasMany(Order::class);
    }
}
