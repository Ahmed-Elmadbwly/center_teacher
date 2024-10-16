<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Resources\ApiErrorResponseResource;
use App\Http\Resources\ApiResponseResource;
use App\Services\Admin\UserServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $UserServices;
    public function __construct(UserServices $userServices){
        $this->UserServices = $userServices;
    }

    public function index($role)
    {
        return (new ApiResponseResource($this->UserServices->getUsers($role)));
    }
    public function store(UserRequest $request, $role){
        return (new ApiResponseResource( $this->UserServices->createUser($request,$role)));
    }
    public function update($role,$id,UserRequest $re)
    {
        if($this->UserServices->getUserById($id)) {
            return (new ApiResponseResource($this->UserServices->updateUser($id,$re)));
        }else{
            return (new ApiErrorResponseResource('Not Found this student'));
        }
    }
    public function show($role,$id)
    {
        if($this->UserServices->getUserById($id)) {
            return (new ApiResponseResource($this->UserServices->getUserById($id)));
        }else{
            return (new ApiErrorResponseResource('Not Found this student'));
        }
    }
    function delete($role,$id)
    {
        if($this->UserServices->getUserById($id)) {
            return (new ApiResponseResource($this->UserServices->deleteUser($id)));
        }else{
            return (new ApiErrorResponseResource('Not Found this student'));
        }
    }
}
