<?php

namespace App\Services;

use App\Repositories\UserRepository;

class SellerService
{
    protected $user_repository;
    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository=$user_repository;
    }

    public function create($user_data,$profile_data){
        $this->user_repository->createSeller($user_data,$profile_data);
    }
}