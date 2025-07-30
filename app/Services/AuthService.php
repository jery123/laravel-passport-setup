<?php

namespace App\Services;

use App\Repository\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $authRepository;

    /**
     * Create a new class instance.
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * Summary of authRegister
     * @param $request
     * @return $response
     */
    public function authRegister($request)
    {
        $request = $request->all();
        $request['password'] = Hash::make($request['password']);

        # Register user
        return $this->authRepository->registerUser($request);
    }


    /**
     * Function: userLogin
     * @param $request
     * @return $response
     */
    public function userLogin($request)
    {
        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return false;
        }

        $authUser = Auth::user();
        $token = $authUser->createToken('cv-forge')->accessToken;

        return [
            'email' => $authUser->email,
            'token' => $token
        ];

    }

    /**
     * Function: userProfile
     * @return \App\Models\User
     */
    public function userProfile(){
        return Auth::user();
    }

    
    /**
     * Function: logout
     * @return boolean
     */
    public function logout(){
        $authUser = Auth::user();
        if($authUser){
            $authUser->token()->revoke();
            return true;
        }
        return false;
    }
}
