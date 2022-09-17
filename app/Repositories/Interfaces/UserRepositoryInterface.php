<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    public function createSeller(array $user_data, array $profile_data) : ?Model;

    public function sellersWithPagination();

    public function show(string $uuid) : \Illuminate\Database\Eloquent\Builder|Model;

}
