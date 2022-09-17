<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

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
    public function listWithPaginate(){
        return $this->user_repository->sellersWithPagination();
    }
    public function show($uuid){
        return $this->user_repository->show($uuid);
    }
    public function listWithProducts($address_uuid){
        return $this->user_repository->sellerProfileWithProducts($address_uuid);
    }

}
