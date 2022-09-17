<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $service;

    public function __construct(AuthService $auth_service)
    {
        $this->service = $auth_service;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $user_data = $data['user'];
        $profile_data = $data['profile'];
        $user = $this->service->sellerRegister($user_data, $profile_data);
        return LoginResource::make($user);
    }
}
