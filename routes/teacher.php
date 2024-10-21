<?php

use App\Http\Controllers\Teacher\AssignmentController;
use App\Http\Controllers\Teacher\LessonController;
use App\Http\Controllers\Teacher\QuizController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum','can:access-teacher-route'])->prefix('teacher')->controller(LessonController::class)->group( function () {
    Route::get("/lessons", "index");
    Route::post("/lessons", "store");
    Route::post("/lessons/{id}", "update");
    Route::post("/lessons/show/{id}", "show");
    Route::delete("/lessons/{id}", "delete");
});

Route::middleware(['auth:sanctum','can:access-teacher-route'])->prefix('teacher')->controller(AssignmentController::class)->group( function () {
    Route::get("/assignments", "index");
    Route::post("/assignments", "store");
    Route::post("/assignments/{id}", "update");
    Route::post("/assignments/show/{id}", "show");
    Route::delete("/assignments/{id}", "delete");
});

Route::middleware(['auth:sanctum','can:access-teacher-route'])->prefix('teacher')->controller(QuizController::class)->group( function () {
    Route::get("/quizs", "index");
    Route::post("/quizs", "store");
    Route::post("/quizs/{id}", "update");
    Route::post("/quizs/show/{id}", "show");
    Route::delete("/quizs/{id}", "delete");
});
