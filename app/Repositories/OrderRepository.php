<?php

namespace App\Repositories;

use App\Enum\OrderStatus;
use App\Models\CustomerAddresses;
use App\Models\Order;
use App\Models\Product;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Order $model
     */
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function createOrder($address_uuid,$products){
        $address=CustomerAddresses::query()->where('uuid',$address_uuid)->firstOrFail();
        return DB::transaction(function () use ($address, $products) {
            $order = $this->model->create([
                'customer_address_id' => $address->id,
                'status' => OrderStatus::WAITING,
            ]);
            $this->attachOnUuid($order,$products);
        });
    }

    protected function attachOnUuid(Order $order,array $products){
        array_map(function ($product_uuid) use ($order){
            $product=Product::query()->where('uuid',$product_uuid)->firstOrFail();
            $order->products()->attach($product->id);
        },$products);
    }
}
