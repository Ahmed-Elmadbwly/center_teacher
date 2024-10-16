<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthServices
{
    public function register($request)
    {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('images', $imageName, 'public');

        $data = $request->toArray();
        $data['image'] = $imageName;

        $user = User::create($data);

        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;

        return $success;
    }
    public function login($request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
            return $success;
        }
        else{
            return'Unauthorised.';
        }
    }
    public function me()
    {
        return Auth::user();
    }
    public function logout($request)
    {
        if (Auth::check()) {
            $request->user()->tokens()->delete();
             return  true;
        }else{
            return  false;
        }
    }
}
