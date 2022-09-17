<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface ProductRepositoryInterface
{
    public function createProduct(User $seller,array $data);
}
