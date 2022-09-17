<?php

namespace App\Repositories;

use App\Enum\SellerStatus;
use App\Enum\UserRole;
use App\Enum\UserStatus;
use App\Models\CustomerAddresses;
use App\Models\Role;
use App\Models\SellerProfile;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function createSeller(array $user_data, array $profile_data): User
    {
        $seller_role = Role::query()->where('title', UserRole::SELLER)->firstOrFail();
        $user_data['role_id'] = $seller_role->id;
        $user_data['status'] = UserStatus::ACTIVATE;
        $profile_data['status'] = SellerStatus::ACTIVATE;
        return DB::transaction(function () use ($user_data, $profile_data) {
            $user = $this->model->create($user_data);
            $user->sellerProfile()->create($profile_data);
            return $user;
        });
    }

    public function sellersWithPagination()
    {
        $seller_role = $this->findRoleByTitle(UserRole::SELLER);
        return $this->model->query()
            ->where('role_id', $seller_role->id)
            ->with('sellerProfile')
            ->orderBy('id', 'DESC')->paginate('20');
    }

    public function show(string $uuid): \Illuminate\Database\Eloquent\Builder|Model
    {
        $seller_role = Role::query()->where('title', UserRole::SELLER)->firstOrFail();
        return $this->model->query()
            ->where('uuid', $uuid)
            ->where('role_id', $seller_role->id)
            ->with('sellerProfile')
            ->firstOrFail();
    }

    public function createCustomer(array $user_data, array $addresses_data) : User
    {
        $customer_role = $this->findRoleByTitle(UserRole::CUSTOMER);
        $user_data['role_id'] = $customer_role->id;
        $user_data['status'] = UserStatus::ACTIVATE;
        return DB::transaction(function () use ($user_data, $addresses_data) {
            $user = $this->model->create($user_data);
            $user->addresses()->createMany($addresses_data);
            return $user;
        });
    }

    public function sellerProfileWithProducts(string $customer_address_uuid)
    {
        $address=CustomerAddresses::query()->where('uuid',$customer_address_uuid)->firstOrFail();
        return SellerProfile::query()
            ->where('status',SellerStatus::ACTIVATE)
            ->with('products')
            ->orderBy(DB::raw("3959 * acos( cos( radians({$address->lat}) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(-{$address->lng}) ) + sin( radians({$address->lat}) ) * sin(radians(lat)) )"), 'ASC')
           ->paginate('20');
    }


}
