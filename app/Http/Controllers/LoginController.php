<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Services\AuthService;
use App\Services\LoginService;

class LoginController extends Controller
{
    protected $service;
    public function __construct(AuthService $auth_service)
    {
        $this->service=$auth_service;
    }

    public function login(LoginRequest $request)
    {
        $data=$request->validated();
        $login_res=$this->service->login($data['email'],$data['password']);
        if (isset($login_res['success']) && $login_res['success'] == false){
            return $this->responseError($login_res['errors']);
        }
        return LoginResource::make($login_res['user']);
    }
}
