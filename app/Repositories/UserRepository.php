<?php

namespace App\Repositories;

use App\Enum\SellerStatus;
use App\Enum\UserRole;
use App\Enum\UserStatus;
use App\Models\Role;
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

    public function createSeller(array $user_data, array $profile_data): ?Model
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
        $seller_role = Role::query()->where('title', UserRole::SELLER)->firstOrFail();
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


}
