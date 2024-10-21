<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\LessonRequest;
use App\Http\Resources\ApiErrorResponseResource;
use App\Http\Resources\ApiResponseResource;
use App\Services\Teacher\LessonServices;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public $LessonServices;
    public function __construct(LessonServices $LessonServices){
        $this->LessonServices = $LessonServices;
    }
    public function index()
    {
        return (new ApiResponseResource($this->LessonServices->allLessons()));
    }
    public function store(LessonRequest $request){
        return (new ApiResponseResource($this->LessonServices->createLesson($request)));
    }
    public function update($id,LessonRequest $re)
    {
        if($this->LessonServices->getLesson($id)) {
            return (new ApiResponseResource($this->LessonServices->updateLesson($re,$id)));
        }else{
            return (new ApiErrorResponseResource('Not Found this lesson'));
        }
    }
    public function show($id)
    {
        if($this->LessonServices->getLesson($id)) {
            return (new ApiResponseResource($this->LessonServices->getLesson($id)));
        }else{
            return (new ApiErrorResponseResource('Not Found this lesson'));
        }
    }
    function delete($id)
    {
        if($this->LessonServices->getLesson($id)) {
            return (new ApiResponseResource($this->LessonServices->deleteLesson($id)));
        }else{
            return (new ApiErrorResponseResource('Not Found this lesson'));
        }
    }
}
