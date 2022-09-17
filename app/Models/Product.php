<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Hash;

class Product extends Model
{
    use HasFactory,UuidTrait;

    protected $fillable = [
        'title',
        'count',
        'price',
        'discount',
        'image',
    ];

    public function seller() : BelongsTo
    {
        return $this->belongsTo(SellerProfile::class,'seller_profile_id');
    }
    public function getFinalPriceAttribute()
    {
        return $this->price - round(($this->price * $this->discount)/100);
    }

    public function orders() : BelongsToMany
    {
        return $this->belongsToMany(Order::class,'order_product');
    }
}
