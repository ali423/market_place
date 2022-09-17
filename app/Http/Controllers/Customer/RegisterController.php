<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $auth_service;

    public function __construct(AuthService $auth_service)
    {
        $this->auth_service = $auth_service;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $user_data = $data['user'];
        $addresses_data = $data['address'];
        $user = $this->auth_service->customerRegister($user_data, $addresses_data);
        return LoginResource::make($user);
    }
}
