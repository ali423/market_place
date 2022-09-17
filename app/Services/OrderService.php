<?php

namespace App\Services;

use App\Repositories\OrderRepository;

class OrderService
{
    protected $repository;
    public function __construct(OrderRepository $repository)
    {
        $this->repository=$repository;
    }

    public function create($address_uuid,$products){
        $this->repository->createOrder($address_uuid,$products);
    }
}
