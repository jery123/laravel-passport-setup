<?php

namespace App\Http\Controllers\V1\Auth;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLogin;
use App\Http\Requests\AuthRegister;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;
use Log;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Function: register
     * @param Illuminate\Http\Request $request
     */
    public function register(AuthRegister $request){
       
        try{
            $response = $this->authService->authRegister($request);

            if($response){
                return ApiResponse::success(status: self::SUCCESS_STATUS, message: self::SUCCESS_MESSAGE, data: $response, statusCode: self::SUCCESS);
            }
                return ApiResponse::error(status: self::ERROR_STATUS, message: self::FAILED_MESSAGE, statusCode: self::ERROR);
        }catch(Exception $e){
            Log::info("Exception occured while registering user" . $e->getMessage());
            return ApiResponse::error(status: self::ERROR_STATUS, message: self::EXCEPTION_MESSAGE, statusCode: self::ERROR);
        }   
    }

    public function login (AuthLogin $authLogin){
        try {
            $loginResponse = $this->authService->userLogin($authLogin);

            if(! $loginResponse){
                return ApiResponse::error(status: self::ERROR_STATUS, message: self::INVALID_CREDENTIALS, statusCode: self::ERROR);
            }
                return ApiResponse::success(status: self::SUCCESS_STATUS, message: self::SUCCESS_MESSAGE, data: $loginResponse, statusCode: self::SUCCESS);
        } catch (Exception $e) {
            Log::info("Exception occured while registering user" . $e->getMessage());
            return ApiResponse::error(status: self::ERROR_STATUS, message: self::EXCEPTION_MESSAGE, statusCode: self::ERROR);
        }
    }     

    /**
     * Function: userProfile
     */
    public function userProfile(){
        try {
            $authUser = $this->authService->userProfile();
            if(! $authUser ){
                return ApiResponse::error(status: self::ERROR_STATUS, message: self::USER_NOT_FOUND, statusCode: self::ERROR);
            }
                return ApiResponse::success(status: self::SUCCESS_STATUS, message: self::SUCCESS_MESSAGE, data: $authUser, statusCode: self::SUCCESS);
        
        } catch (Exception $e) {
           Log::info("Exception occured while registering user" . $e->getMessage());
            return ApiResponse::error(status: self::ERROR_STATUS, message: self::EXCEPTION_MESSAGE, statusCode: self::ERROR);
        }
    }

    /**
     * Function: logout
     * @param NA
     * @return Illuminate\Http\JsonResponse
     */
    public function logout(){
        try {
            $response = $this->authService->logout();
            if(! $response ){
                return ApiResponse::error(status: self::ERROR_STATUS, message: self::USER_NOT_FOUND, statusCode: self::ERROR);
            }
                return ApiResponse::success(status: self::SUCCESS_STATUS, message: self::USER_LOGGED_OUT, statusCode: self::SUCCESS);
        
        } catch (Exception $e) {
            Log::info("Exception occured while logout user" . $e->getMessage());
            return ApiResponse::error(status: self::ERROR_STATUS, message: self::EXCEPTION_MESSAGE, statusCode: self::ERROR);
        }
    }

}
