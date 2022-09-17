<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSellerRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use App\Services\SellerService;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    protected $seller_service;

    public function __construct(SellerService $seller_service)
    {
        $this->seller_service = $seller_service;
    }

    public function index(){
        $sellers=$this->seller_service->listWithPaginate();
       return UserResource::collection($sellers);
    }

    public function store(StoreSellerRequest $request)
    {
        $data = $request->validated();
        $user_data = $data['user'];
        $profile_data = $data['profile'];
        $this->seller_service->create($user_data, $profile_data);
        return $this->responseInserted();
    }

    public function show($uuid){
        $sellers=$this->seller_service->show($uuid);
        return UserResource::make($sellers);
    }
}
