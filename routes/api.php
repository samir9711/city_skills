<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Admin PUBLIC ROUTES
/*
Route::prefix('admin')->group(function () {
    Route::get('/all/paginated', [\App\Http\Controllers\Admin\AdminController::class, 'allPaginated']);
    Route::get('/all',           [\App\Http\Controllers\Admin\AdminController::class, 'all']);
    Route::post('/show',         [\App\Http\Controllers\Admin\AdminController::class, 'show']);
    Route::post('/create',       [\App\Http\Controllers\Admin\AdminController::class, 'store']);
    Route::post('/update',       [\App\Http\Controllers\Admin\AdminController::class, 'update']);
    Route::post('/activate',     [\App\Http\Controllers\Admin\AdminController::class, 'activate']);
    Route::post('/deactivate',   [\App\Http\Controllers\Admin\AdminController::class, 'deactivate']);
});

// Question PUBLIC ROUTES
Route::prefix('question')->group(function () {
    Route::get('/all/paginated', [\App\Http\Controllers\Question\QuestionController::class, 'allPaginated']);
    Route::get('/all',           [\App\Http\Controllers\Question\QuestionController::class, 'all']);
    Route::post('/show',         [\App\Http\Controllers\Question\QuestionController::class, 'show']);
    Route::post('/create',       [\App\Http\Controllers\Question\QuestionController::class, 'store']);
    Route::post('/update',       [\App\Http\Controllers\Question\QuestionController::class, 'update']);
    Route::post('/activate',     [\App\Http\Controllers\Question\QuestionController::class, 'activate']);
    Route::post('/deactivate',   [\App\Http\Controllers\Question\QuestionController::class, 'deactivate']);
});

// QuestionOption PUBLIC ROUTES
Route::prefix('question-option')->group(function () {
    Route::get('/all/paginated', [\App\Http\Controllers\QuestionOption\QuestionOptionController::class, 'allPaginated']);
    Route::get('/all',           [\App\Http\Controllers\QuestionOption\QuestionOptionController::class, 'all']);
    Route::post('/show',         [\App\Http\Controllers\QuestionOption\QuestionOptionController::class, 'show']);
    Route::post('/create',       [\App\Http\Controllers\QuestionOption\QuestionOptionController::class, 'store']);
    Route::post('/update',       [\App\Http\Controllers\QuestionOption\QuestionOptionController::class, 'update']);
    Route::post('/activate',     [\App\Http\Controllers\QuestionOption\QuestionOptionController::class, 'activate']);
    Route::post('/deactivate',   [\App\Http\Controllers\QuestionOption\QuestionOptionController::class, 'deactivate']);
});

// User PUBLIC ROUTES
Route::prefix('user')->group(function () {
    Route::get('/all/paginated', [\App\Http\Controllers\User\UserController::class, 'allPaginated']);
    Route::get('/all',           [\App\Http\Controllers\User\UserController::class, 'all']);
    Route::post('/show',         [\App\Http\Controllers\User\UserController::class, 'show']);
    Route::post('/create',       [\App\Http\Controllers\User\UserController::class, 'store']);
    Route::post('/update',       [\App\Http\Controllers\User\UserController::class, 'update']);
    Route::post('/activate',     [\App\Http\Controllers\User\UserController::class, 'activate']);
    Route::post('/deactivate',   [\App\Http\Controllers\User\UserController::class, 'deactivate']);
});

// UserAnswer PUBLIC ROUTES
Route::prefix('user-answer')->group(function () {
    Route::get('/all/paginated', [\App\Http\Controllers\UserAnswer\UserAnswerController::class, 'allPaginated']);
    Route::get('/all',           [\App\Http\Controllers\UserAnswer\UserAnswerController::class, 'all']);
    Route::post('/show',         [\App\Http\Controllers\UserAnswer\UserAnswerController::class, 'show']);
    Route::post('/create',       [\App\Http\Controllers\UserAnswer\UserAnswerController::class, 'store']);
    Route::post('/update',       [\App\Http\Controllers\UserAnswer\UserAnswerController::class, 'update']);
    Route::post('/activate',     [\App\Http\Controllers\UserAnswer\UserAnswerController::class, 'activate']);
    Route::post('/deactivate',   [\App\Http\Controllers\UserAnswer\UserAnswerController::class, 'deactivate']);
});
*/
