<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\SellerProfile;
use App\Models\User;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function createProduct(User $seller, array $data)
    {
        $seller_profile=$seller->sellerProfile;
        $seller_profile->products()->create($data);
    }
    public function sellerProductsWithPagination(User $seller)
    {
        $seller_profile=$seller->sellerProfile;
        return $this->model->query()
            ->where('seller_profile_id',$seller_profile->id)
            ->orderBy('id', 'DESC')->paginate('20');
    }
}
