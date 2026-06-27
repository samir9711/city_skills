<?php



use App\Http\Controllers\Auth\AdminAuthController;

use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\QuestionOption\QuestionOptionController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\UserAnswer\UserAnswerController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::get('/ping', function () {
    return response()->json(['status' => 'ok']);
    });

    Route::post('login', [AdminAuthController::class, 'login']);

    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [AdminAuthController::class, 'logout']);
    });


    Route::prefix('question')->middleware('auth:admin')->group(function () {
        Route::get('/all/paginated', [QuestionController::class, 'allPaginated']);
        Route::get('/all',           [QuestionController::class, 'all']);
        Route::post('/show',         [QuestionController::class, 'show']);
        Route::post('/create',       [QuestionController::class, 'store']);
        Route::post('/update',       [QuestionController::class, 'update']);
        Route::post('/activate',     [QuestionController::class, 'activate']);
        Route::post('/deactivate',   [QuestionController::class, 'deactivate']);
    });

    // QuestionOption PUBLIC ROUTES
    Route::prefix('question-option')->middleware('auth:admin')->group(function () {
        Route::get('/all/paginated', [QuestionOptionController::class, 'allPaginated']);
        Route::get('/all',           [QuestionOptionController::class, 'all']);
        Route::post('/show',         [QuestionOptionController::class, 'show']);
        Route::post('/create',       [QuestionOptionController::class, 'store']);
        Route::post('/update',       [QuestionOptionController::class, 'update']);
        Route::post('/activate',     [QuestionOptionController::class, 'activate']);
        Route::post('/deactivate',   [QuestionOptionController::class, 'deactivate']);
    });

    // User PUBLIC ROUTES
    Route::prefix('user')->middleware('auth:admin')->group(function () {
        Route::get('/all/paginated', [UserController::class, 'allPaginated']);
        Route::get('/all',           [UserController::class, 'all']);
        Route::post('/show',         [UserController::class, 'show']);
        Route::post('/create',       [UserController::class, 'store']);
        Route::post('/update',       [UserController::class, 'update']);
        Route::post('/activate',     [UserController::class, 'activate']);
        Route::post('/deactivate',   [UserController::class, 'deactivate']);
    });

    // UserAnswer PUBLIC ROUTES
    Route::prefix('user-answer')->middleware('auth:admin')->group(function () {
        Route::get('/all/paginated', [UserAnswerController::class, 'allPaginated']);
        Route::get('/all',           [UserAnswerController::class, 'all']);
        Route::post('/show',         [UserAnswerController::class, 'show']);
        Route::post('/create',       [UserAnswerController::class, 'store']);
        Route::post('/update',       [UserAnswerController::class, 'update']);
        Route::post('/activate',     [UserAnswerController::class, 'activate']);
        Route::post('/deactivate',   [UserAnswerController::class, 'deactivate']);
    });




});

