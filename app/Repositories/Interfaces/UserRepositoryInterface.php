<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    public function createSeller(array $user_data, array $profile_data) : User;

    public function createCustomer(array $user_data, array $addresses_data) : User;

    public function sellersWithPagination();

    public function sellerProfileWithProducts(string $customer_address_uuid);

    public function show(string $uuid) : \Illuminate\Database\Eloquent\Builder|Model;

}
