<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $fillable=[
        'status',
        'customer_address_id'
    ];
    use HasFactory,UuidTrait;

    public function address() : BelongsTo
    {
        return $this->belongsTo(CustomerAddresses::class,'customer_address_id');
    }

    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class,'order_product');
    }
}
