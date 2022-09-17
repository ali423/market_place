<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class AuthService
{
    protected $user_repository;
    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository=$user_repository;
    }

    public function login($email, $password)
    {
        $login_data = [
            'email' => $email,
            'password' => $password,
        ];
        if (auth()->attempt($login_data)) {
            $user = User::query()->where('email', '=', request('email'))->firstOrFail();
            auth()->login($user);
            return [
                'user' => $user,
                'success' => true,
            ];
        } else {
            return [
                'success' => false,
                'errors' => [
                    'نام کاربری یا رمز عبور اشتباه است.'
                ]
            ];
        }
    }

    public function sellerRegister($user_data,$profile_data){
        $user= $this->user_repository->createSeller($user_data,$profile_data);
        auth()->login($user);
        return $user;
    }

    public function customerRegister($user_data,$addresses){
        $user= $this->user_repository->createCustomer($user_data,$addresses);
        auth()->login($user);
        return $user;
    }
}
