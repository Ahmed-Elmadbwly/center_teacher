<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClassRequest;
use App\Http\Resources\ApiErrorResponseResource;
use App\Http\Resources\ApiResponseResource;
use App\Services\Admin\ClassesServices;
use Illuminate\Http\Request;

class ClassController extends Controller
{

    public $ClassesServices;
    public function __construct(ClassesServices $ClassesServices){
        $this->ClassesServices = $ClassesServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return (new ApiResponseResource($this->ClassesServices->allClasses()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassRequest $request)
    {
        return (new ApiResponseResource($this->ClassesServices->createClasses($request)));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if($this->ClassesServices->getClassesById($id)) {
            return (new ApiResponseResource($this->ClassesServices->getClassesById($id)));
        }else{
            return (new ApiErrorResponseResource('Not Found this Class'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassRequest $request, string $id)
    {
        if($this->ClassesServices->getClassesById($id)) {
            return (new ApiResponseResource($this->ClassesServices->updateClasses($request,$id)));
        }else{
            return (new ApiErrorResponseResource('Not Found this Class'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        if($this->ClassesServices->getClassesById($id)) {
            return (new ApiResponseResource($this->ClassesServices->deleteClasses($id)));
        }else{
            return (new ApiErrorResponseResource('Not Found this Class'));
        }
    }
}
