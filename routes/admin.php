<?php


use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::middleware('auth:sanctum')->post('me', 'me');
    Route::middleware('auth:sanctum')->post('logout', 'logout');
});

Route::middleware(['auth:sanctum','can:access-admin-route'])->prefix('admin')->controller(ClassController::class)->group( function () {
    Route::get("/classes", "index");
    Route::post("/classes", "store");
    Route::post("/classes/{id}", "update");
    Route::post("/classes/show/{id}", "show");
    Route::delete("/classes/{id}", "delete");
});

Route::middleware(['auth:sanctum','can:access-admin-route'])->prefix('admin')->controller(UserController::class)->group(function () {
    Route::get("/{role}", "index");
    Route::post("/{role}", "store");
    Route::post("/{role}/{id}", "update");
    Route::post("/{role}/show/{id}", "show");
    Route::delete("/{role}/{id}", "delete");
});
