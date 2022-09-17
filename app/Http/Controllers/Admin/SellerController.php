<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSellerRequest;
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

    public function store(StoreSellerRequest $request)
    {
        $data = $request->validated();
        $user_data = $data['user'];
        $profile_data = $data['profile'];
        $this->seller_service->create($user_data, $profile_data);
        return $this->responseInserted();
    }
}
