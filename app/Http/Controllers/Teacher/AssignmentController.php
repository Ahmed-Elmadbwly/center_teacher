<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\AssignmentRequest;
use App\Http\Resources\ApiErrorResponseResource;
use App\Http\Resources\ApiResponseResource;
use App\Services\Teacher\AssignmentServices;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public $AssignmentServices;
    public function __construct(AssignmentServices $AssignmentServices){
        $this->AssignmentServices = $AssignmentServices;
    }
    public function index()
    {
        return (new ApiResponseResource($this->AssignmentServices->allAssignments()));
    }
    public function store(AssignmentRequest $request){
        return (new ApiResponseResource($this->AssignmentServices->createAssignment($request)));
    }
    public function update($id,AssignmentRequest $re)
    {
        if($this->AssignmentServices->getAssignmentById($id)) {
            return (new ApiResponseResource($this->AssignmentServices->updateAssignment($id,$re)));
        }else{
            return (new ApiErrorResponseResource('Not Found this Assignment'));
        }
    }
    public function show($id)
    {
        if($this->AssignmentServices->getAssignmentById($id)) {
            return (new ApiResponseResource($this->AssignmentServices->getAssignmentById($id)));
        }else{
            return (new ApiErrorResponseResource('Not Found this Assignment'));
        }
    }
    function delete($id)
    {
        if($this->AssignmentServices->getAssignmentById($id)) {
            return (new ApiResponseResource($this->AssignmentServices->deleteAssignment($id)));
        }else{
            return (new ApiErrorResponseResource('Not Found this Assignment'));
        }
    }
}
