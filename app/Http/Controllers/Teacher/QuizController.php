<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\QuizRequest;
use App\Http\Resources\ApiErrorResponseResource;
use App\Http\Resources\ApiResponseResource;
use App\Services\Teacher\QuizServices;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public $QuizServices;
    public function __construct(QuizServices $QuizServices){
        $this->QuizServices = $QuizServices;
    }
    public function index()
    {
        return (new ApiResponseResource($this->QuizServices->allQuizzes()));
    }
    public function store(QuizRequest $request){
        return (new ApiResponseResource($this->QuizServices->saveQuiz($request->toArray())));
    }
    public function update($id,QuizRequest $re)
    {
        if($this->QuizServices->getQuiz($id)) {
            return (new ApiResponseResource($this->QuizServices->saveQuiz($re->toArray(),$id)));
        }else{
            return (new ApiErrorResponseResource('Not Found this quiz'));
        }
    }
    public function show($id)
    {
        if($this->QuizServices->getQuiz($id)) {
            return (new ApiResponseResource($this->QuizServices->getQuiz($id)));
        }else{
            return (new ApiErrorResponseResource('Not Found this quiz'));
        }
    }
    function delete($id)
    {
        if($this->QuizServices->getQuiz($id)) {
            return (new ApiResponseResource($this->QuizServices->deleteQuiz($id)));
        }else{
            return (new ApiErrorResponseResource('Not Found this quiz'));
        }
    }
}
