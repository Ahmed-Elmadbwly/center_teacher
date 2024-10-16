<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Resources\ApiErrorResponseResource;
use App\Http\Resources\ApiResponseResource;
use App\Services\AuthServices;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public $AuthServices;
    public function __construct(AuthServices $AuthServices){
        $this->AuthServices = $AuthServices;
    }

    public function login(Request $request){
        $data = $this->AuthServices->login($request);
        if(is_array($data)){
            return (new ApiResponseResource($data));
        }else{
            return (new ApiErrorResponseResource('Email and password  wrong'));
        }
    }
    public function register(AuthRequest $request)
    {
        return (new ApiResponseResource($this->AuthServices->register($request)));
    }
    public function logout(Request $request)
    {
        $this->AuthServices->logout($request);
        return (new ApiResponseResource('Successfully logged out'));
    }

    public function me(Request $request)
    {
        return (new ApiResponseResource($this->AuthServices->me()));
    }
}
