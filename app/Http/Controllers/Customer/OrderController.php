<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreOrderRequest;
use App\Models\Order;
use App\Models\SellerProfile;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreOrderRequest $request, SellerProfile $sellerProfile)
    {
        $data = $request->validated();
        $address = $data['address_uuid'];
        $products = $data['products'];
        $this->service->create($address, $products);
        return $this->responseInserted();
    }
}

