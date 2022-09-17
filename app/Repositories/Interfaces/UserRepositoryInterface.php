<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    public function createSeller(array $user_data, array $profile_data): ?Model;
}
